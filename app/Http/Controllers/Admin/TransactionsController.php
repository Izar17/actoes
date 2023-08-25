<?php

namespace App\Http\Controllers\Admin;

use App\{Asset, Stock, Transaction, User, Hospital, Doserate, RunNumber, Asset_product};
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Exception;
use Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
/**
 * Class TransactionsController
 * @package App\Http\Controllers\Admin
 */
class TransactionsController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $transactions = Transaction::all()->where("status",1)->where("cancelled",'NO');

        return view('admin.transactions.index', compact('transactions','assets','run_nos'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::orderBy('id', 'asc')->get(["hospital", "id"]);

        $run_nos = RunNumber::all()->pluck('run_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $fromDate = "2023-01-01";
        $toDate = "2023-08-10";

        $counts = Transaction::where("asset_id", 1)
            ->whereRaw(
                "(created_at >= ? AND created_at <= ?)",
                [
                    $fromDate . " 00:00:00",
                    $toDate . " 23:59:59"
                ]
            )
            ->count();
        return view('admin.transactions.create', compact('hospitals', 'assets', 'counts','run_nos'));
    }

    /**
     * @param StoreTransactionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTransactionRequest $request)
    {
        foreach ($request->orderform_no as $key => $orderform_no) {
            //Get Month in Current Date
            $monthDate = Carbon::now();
            $monthAbbreviation = $monthDate->format('M');

            //Format Time with AM/PM
            //$calibration_time = Carbon::createFromFormat('H:i', $request->calibration_time[$key])->format('h:i A');
            
            //Calibrate Date
            $cal_yr = date("Y", strtotime($request->calibration_date[$key]));
            $cal_date = date($request->calibration_date[$key]);

            //Current Date
            $currentYear = date('Y');
            $currentDate = date('Y-m-d');

            //Get WeekNumber and last 2 digit of the year
            $weekNumber = date('W', strtotime($cal_date));
            $lastTwoDigitsOfYear = date('y', strtotime($cal_date));

            if ($currentYear != $cal_yr) {
                $fromDate = "$cal_yr-01-01";
                $toDate = $cal_date;
                $rx_query = "(calibration_date >= ? AND calibration_date <= ?)";
                $rx_yr = $cal_yr;
            } else {
                $nextYear = $currentYear + 1;
                $fromDate = "$currentYear-01-01";
                $toDate = $currentDate;
                $rx_query = "DATE_PART('year', to_date(left(calibration_date,4),'YYYY')) != '$nextYear' AND (created_at >= ? AND created_at <= ?)";
                $rx_yr = $currentYear;
            }
            //Lot No.
            if ($request->asset_id == 2) {
                $lotNumber = 'I/'.$weekNumber.'/'.$lastTwoDigitsOfYear;
            } else {
                $lotNumber = '';
            }

            //RX Activity
            if ($request->asset_id == 1) {
                $act = 'Tc';
            } else if ($request->asset_id == 2) {
                $lotNumber = 'I/'.$weekNumber.'/'.$lastTwoDigitsOfYear;
                if ($request->item[$key] == 13) {
                    $act = 'IC';
                } else {
                    $act = 'IS';
                }
            } else if ($request->asset_id == 3){
                $act = 'Tl';
            }else if ($request->asset_id == 4){
                $act = 'Y90';
            }else if ($request->asset_id == 5){
                $act = 'MD';
            }else if ($request->asset_id == 6){
                $act = 'Gen';
            }else if ($request->asset_id == 7){
                $act = 'RIA-'.$monthAbbreviation;
            }else if ($request->asset_id == 8){
                $act = 'MISC';
            }

            //RX Count
            $counts = Transaction::where("asset_id", $request->asset_id)
                ->whereRaw(
                    $rx_query,
                    [
                        $fromDate . " 00:00:00",
                        $toDate . " 23:59:59"
                    ]
                )
                ->count();
            $rx_number = $counts + 1;

            //Concat RX Activity, Count and Calibration Year
            $rx_no = $act . '-' . str_pad($rx_number, 5, '0', STR_PAD_LEFT) . '-' . $rx_yr;

            //Activity mCi functions auto generate
            $activityMci = $request->activity_mci[$key];
            $mbq = number_format($activityMci * 37, 2);
            $discrepancy = ($activityMci * .10) + $activityMci;



            $doserates = Doserate::select('max_doserate', 'doserate_m')
            ->where("asset_product_id",$request->item[$key])
            ->whereRaw('? BETWEEN CAST(lower_limit AS numeric) AND CAST(upper_limit AS numeric)',$activityMci)
            ->get("doserate_m");
            foreach ($doserates as $doserate) {
                $max_doserate = $doserate->max_doserate;
                $doserates_meter = $doserate->doserate_m;
            }

            //particular
            if ($request->asset_id == 6) {
                $unit='GBq';
            } else {
                $unit='mCi';
            }
            $particular = $activityMci.' '.$unit;

            $transactions['hospital_id']        = $request->hospital_id;
            $transactions['asset_id']           = $request->asset_id;
            $transactions['remarks']            = $request->remarks[$key];
            $transactions['orderform_no']       = $request->orderform_no[$key];
            $transactions['item']               = $request->item[$key];
            $transactions['activity_mci']       = $request->activity_mci[$key];
            $transactions['activity_mbq']       = $mbq;
            $transactions['discrepancy']        = $discrepancy;
            $transactions['max_doserate']       = $max_doserate;
            $transactions['doserate_meter']     = $doserates_meter;
            $transactions['particular']         = $particular;
            $transactions['patient']            = $request->patient[$key];
            $transactions['calibration_date']   = $request->calibration_date[$key];
            $transactions['calibration_time']   = $request->calibration_time[$key];
            $transactions['lot_no']             = $lotNumber;
            $transactions['run_no']             = $request->run_no[$key];
            $transactions['procedure1']         = $request->procedure[$key];
            $transactions['volume']             = $request->volume[$key];
            $transactions['created_by']         = $request->user;
            $transactions['cancelled']          = 'NO';
            $transactions['status']             = 1;
            Transaction::create(array_merge($transactions, ['rx_no' => $rx_no]));
        }

        return redirect()->route('admin.transactions.show',$request->hospital_id);

    }


    public function edit(Transaction $transaction)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hospitals = Hospital::all()->pluck('hospital', 'id')->prepend(trans('global.pleaseSelect'), '');

        $run_nos = RunNumber::all()->pluck('run_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset_products = Asset_product::all()
        ->where("asset_id",$transaction->asset_id)->pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactions.edit', compact('assets', 'asset_products', 'users', 'transaction','hospitals','run_nos'));
    }

    /**
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     * @return RedirectResponse
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //Format Time with AM/PM
        //$calibration_time = Carbon::createFromFormat('H:i', $request->calibration_time)->format('h:i A');
        //$transaction->update(['calibration_time' => $calibration_time] + $request->all());
        $transaction->update($request->all());
        return redirect()->route('admin.transactions.index');

    }

    /**
     * @param Transaction $transaction
     * @return Factory|View
     */
    public function show(Transaction $transactiona, $ida)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->where("hospital_id",$ida);

        return view('admin.transactions.show', compact('transactions','ida'));
    }

    /**
     * @param Transaction $transaction
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Transaction $transaction)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->delete();

        return back();

    }

    /**
     * @param MassDestroyTransactionRequest $request
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyTransactionRequest $request)
    {
        Transaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    /**
     * @param Stock $stock
     * @return RedirectResponse
     */
    public function storeStock(Stock $stock)
    {
        $action = request()->input('action', 'add') == 'add' ? 'add' : 'remove';
        $stockAmount = request()->input('stock', 1);
        $sign = $action == 'add' ? '+' : '-';

        if ($stockAmount < 1) {
            return redirect()->route('admin.stocks.index')->with([
                'error' => 'No item was added/removed. Amount must be greater than 1.',
            ]);
        }

        Transaction::create([
            'stock' => $sign . $stockAmount,
            'asset_id' => $stock->asset->id,
            'user_id' => auth()->user()->id,
        ]);

        if ($action == 'add') {
            $stock->increment('current_stock', $stockAmount);
            $status = $stockAmount . ' item(-s) was added to stock.';
        }

        if ($action == 'remove') {
            if ($stock->current_stock - $stockAmount < 0) {
                return redirect()->route('admin.stocks.index')->with([
                    'error' => 'Not enough items in stock.',
                ]);
            }

            $stock->decrement('current_stock', $stockAmount);
            $status = $stockAmount . ' item(-s) was removed from stock.';
        }

        return redirect()->route('admin.stocks.index')->with([
            'status' => $status,
        ]);
    }
}
