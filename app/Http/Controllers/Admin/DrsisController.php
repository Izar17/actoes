<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{Asset, User, Hospital, RunNumber, Asset_product, Production, LeadPot, Drsi};
use App\Transaction;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateDrsiRequest;
use Carbon\Carbon;

class DrsisController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $productions = Production::all()->where("status",1);

        $hospitals = Hospital::all();

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        // $drsis = Drsi::join('hospitals', 'transactions.hospital_id', '=', 'hospitals.id')
        // ->where('transactions.status', 1)
        // ->distinct('hospitals.hospital')
        // ->pluck('hospitals.hospital','hospitals.id');

        return view('admin.drsis.index', compact('productions','assets','run_nos','hospitals'));
    }

    public function wip()
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drsis.wip');
    }

    public function edit(Drsi $request, $id)
    {
        abort_if(Gate::denies('drsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

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

       return view('admin.drsis.print.edit', compact('transactions','assets','run_nos'));
    }

    public function update(UpdateDrsiRequest $request)
    {
        foreach ($request->item as $key => $items) {
            foreach ($request->item as $key => $value) {
                $data = array(
                    'dr_no'=>$request->dr_no[$key],
                    'invoice_no'=>$request->invoice_no[$key],
                    'price'=>$request->price[$key],
                );
                Drsi::where('id',$request->item[$key])
                ->update($data);
          }
        }
        return redirect()->route('admin.drsis.edit', $request->hospital);
    }

}
