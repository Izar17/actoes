<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDrsiRequest;
use Illuminate\Http\Request;
use App\{Hospital, Asset, RunNumber, Transaction, Drsi};
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PrintDrsiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::all();

        return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos'));
    }

    public function searchDrsi(Request $request)
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::all();

        if ($request->rx_number != '') {
            $transactions = Transaction::where("rx_no", $request->rx_number)->get();
        } else {
            switch (true) {
                //query for Hospital
                case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("run_no", $request->run_no)->where("cancelled", 'NO')
                        ->where("asset_id", $request->asset_id)
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->get();
                    break;

                case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)->where("cancelled", 'NO')
                        ->where("run_no", $request->run_no)
                        ->get();
                    break;

                case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)->where("cancelled", 'NO')
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->get();
                    break;

                case $request->hospital_id == '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("run_no", $request->run_no)
                        ->where("asset_id", $request->asset_id)->where("cancelled", 'NO')
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->get();
                    break;

                case $request->hospital_id == '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("asset_id", $request->asset_id)->where("cancelled", 'NO')
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->get();
                    break;

                case $request->asset_id == '' && $request->hospital_id != '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                    ->where("cancelled", 'NO')->get();
                    break;

                //query for Isotope
                case $request->asset_id != '' && $request->hospital_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)
                        ->where("run_no", $request->run_no)
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->where("cancelled", 'NO')->get();
                    break;

                case $request->asset_id != '' && $request->hospital_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)
                        ->where("run_no", $request->run_no)
                        ->where("cancelled", 'NO')->get();
                    break;

                case $request->asset_id != '' && $request->hospital_id != '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)->where("cancelled", 'NO')->get();
                    break;

                case $request->asset_id != '' && $request->hospital_id == '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("asset_id", $request->asset_id)->where("cancelled", 'NO')->get();
                    break;

                default:
                    $transactions = Transaction::All()->where("cancelled", 'NO');
                    break;
            }
        }


        return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos', 'transactions'));
    }


    public function update(UpdateDrsiRequest $request)
    {
        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::all();

        foreach ($request->item as $key => $items) {
            foreach ($request->item as $key => $value) {
                $data = array(
                    'dr_no'=>$request->dr_no[$key],
                    'invoice_no'=>$request->invoice_no[$key],
                    'price'=>$request->price[$key],
                    'delivery_charge'=>$request->delivery_charge[$key],
                    'drsi_cancel'=>$request->drsi_cancel[$key],
                );
                Drsi::where('id',$request->item[$key])
                ->update($data);
          }
        }
        return view('admin.drsis.print.index', compact('hospitals', 'assets', 'run_nos'));
    }
}
