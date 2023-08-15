<?php

namespace App\Http\Controllers\Admin;

use App\{Asset, Stock, Transaction, User, Hospital, LeadPot};
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Exception;
use Gate;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        $transactions = Transaction::all();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::all()->pluck('hospital', 'id')->prepend(trans('global.pleaseSelect'), '');

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
        return view('admin.transactions.create', compact('hospitals', 'assets', 'counts'));
    }

    /**
     * @param StoreTransactionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTransactionRequest $request)
    {
        foreach ($request->orderform_no as $key => $orderform_no) {

            //Format Time with AM/PM
            $calibration_time = Carbon::createFromFormat('H:i', $request->calibration_time[$key])->format('h:i A');

            //Current & Calibrate Date
            $cal_yr = date("Y", strtotime($request->calibration_date[$key]));
            $cal_date = date($request->calibration_date[$key]);

            $currentYear = date('Y');
            $currentDate = date('Y-m-d');

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
            //RX Activity
            if ($request->asset_id == 1) {
                $act = 'Tc';
            } else if ($request->asset_id == 2) {
                if ($request->item[$key] == 13) {
                    $act = 'IC';
                } else {
                    $act = 'SI';
                }
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

            $particular = $request->activity_mci[$key].' mCi '.$request->item[$key];

            $transactions['hospital_id']        = $request->hospital_id;
            $transactions['asset_id']           = $request->asset_id;
            $transactions['orderform_no']       = $request->orderform_no[$key];
            $transactions['item']               = $request->item[$key];
            $transactions['lead_pot']           = $request->leadpot[$key];
            $transactions['activity_mci']       = $request->activity_mci[$key];
            $transactions['activity_mbq']       = $request->activity_mbq[$key];
            $transactions['discrepancy']        = $request->discrepancy[$key];
            $transactions['particular']         = $particular;
            $transactions['calibration_date']   = $request->calibration_date[$key];
            $transactions['calibration_date']   = $request->calibration_date[$key];
            $transactions['calibration_time']   = $calibration_time;
            Transaction::create(array_merge($transactions, ['rx_no' => $rx_no]));
        }

        return redirect()->route('admin.transactions.index');

    }

    /**
     * @param Transaction $transaction
     * @return Factory|View
     */
    public function edit(Transaction $transaction)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction->load('asset', 'user');

        return view('admin.transactions.edit', compact('assets', 'users', 'transaction'));
    }

    /**
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     * @return RedirectResponse
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index');

    }

    /**
     * @param Transaction $transaction
     * @return Factory|View
     */
    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('asset', 'user');

        return view('admin.transactions.show', compact('transaction'));
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
