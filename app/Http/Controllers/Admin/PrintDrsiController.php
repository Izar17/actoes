<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDrsiRequest;
use Illuminate\Http\Request;
use App\{Hospital, Asset, RunNumber, Transaction, Drsi, CancelDrsi, Product_price};
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class PrintDrsiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::orderBy('hospital', 'asc')->get(["hospital", "id"]);

        return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos'));
    }


    public function searchByDrsi(Request $request)
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $delCharges = Hospital::select('delivery_charge', 'doctor_name')
        ->where('id', $request->hospital_id)
        ->get();

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::all();

        $selectedDrsi = $request->selectDrsi;
        $drsi = $request->drsi;

        $transactions = null; // Initialize the variable

        if ($drsi != '') {
            switch ($selectedDrsi) {
                case 'DR':
                    $transactions = Transaction::where("dr_no", $drsi)->get();
                    break;
                case 'SI':
                    $transactions = Transaction::where("invoice_no", $drsi)->get();
                    break;
                default:
                    $transactions = Transaction::where("invoice_no", 'ALL')->get();
                    break;
            }
        }

        return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos', 'transactions', 'request', 'delCharges'));
    }


    public function searchDrsi(Request $request)
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delCharges = Hospital::select('delivery_charge', 'doctor_name')
            ->where('id', $request->hospital_id)
            ->get();

        include(app_path('Forms/FormDrsi.php'));
        return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos', 'transactions', 'request', 'delCharges'));
    }


    public function printDr(Request $request)
    {
        // Include the file from the app directory
        include(app_path('Forms/FormDrsi.php'));
        return view('admin.drsis.print.printdr', compact('transactions'));
    }

    public function printSdr(Request $request)
    {
        // Include the file from the app directory
        include(app_path('Forms/FormDrsi.php'));
        return view('admin.drsis.print.printsdr', compact('transactions','request'));
    }

    public function printSi(Request $request)
    {
        // Include the file from the app directory
        include(app_path('Forms/FormDrsi.php'));
        return view('admin.drsis.print.printsi', compact('transactions', 'request'));
    }
    public function update(UpdateDrsiRequest $request)
    {
        $cancel = $request->cancel;
        $selectDrsi = $request->selectDrsi;

        $currentDateTime = Carbon::now();

        foreach ($request->item as $key => $items) {
            if ($selectDrsi == 'SI') {
                $SI = 1;
                $selectedDrsi = $request->invoice_no[$key];
            } else {
                $SI = 0;
                $selectedDrsi = $request->dr_no[$key];
            }

            if ($cancel == 'YES') {
                $canceldrsis = array(
                    'dr_number' => $request->edr_no[$key],
                    'si_number' => $request->einvoice_no[$key],
                    'status' => $SI,
                    'transaction_id' => $request->item[$key],
                    'created_at' => $currentDateTime,
                );
                CancelDrsi::insert($canceldrsis);
            }
            $data = array(
                'dr_no' => $request->dr_no[$key],
                'invoice_no' => $request->invoice_no[$key],
                'price' => $request->price[$key],
            );
            Drsi::where('id', $request->item[$key])
                ->update($data);

        }

        // Set a flash message
        session()->flash('success', 'DRSI update success!');
        //return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos'));

        if ($cancel == 'YES') {
            return redirect()->route('admin.printdrsi.searchByDrsi', [
                '_token' => $request->_token,
                'selectDrsi' => $request->selectDrsi,
                'drsi' => $selectedDrsi,
                'cancel' => $request->cancel,
            ]);
        } else {
            return redirect()->route('admin.printdrsi.searchDrsi', [
                '_token' => $request->_token,
                'asset_id' => $request->asset_id,
                'rx_number' => $request->rx_number,
                'hospital_id' => $request->hospital_id,
                'run_no' => $request->run_no,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'cancel' => $request->cancel,
            ]);
        }
    }
}
