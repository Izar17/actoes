<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Hospital, Asset, RunNumber, Transaction};
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::all();

        return view('admin.reports.index', compact('hospitals', 'assets', 'run_nos'));
    }


    public function print(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->asset_id == 2) {
            $perPage = 10;
        } else {
            $perPage = 1;
        }
        if ($request->rx_number != '') {
            $transactions = Transaction::where("rx_no", $request->rx_number)
                ->where("asset_id", $request->asset_id)->simplePaginate($perPage);
        } else {
            if($request->printField <= 2){
            switch (true) {
                case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("run_no", $request->run_no)
                        ->where("asset_id", $request->asset_id)
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->simplePaginate($perPage);
                    break;

                case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)
                        ->where("run_no", $request->run_no)
                        ->simplePaginate($perPage);
                    break;

                case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->simplePaginate($perPage);
                    break;

                case $request->hospital_id == '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("run_no", $request->run_no)
                        ->where("asset_id", $request->asset_id)
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->simplePaginate($perPage);
                    break;

                case $request->hospital_id == '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
                    $transactions = Transaction::where("asset_id", $request->asset_id)
                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                        ->simplePaginate($perPage);
                    break;

                case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                        ->where("asset_id", $request->asset_id)->simplePaginate($perPage);
                    break;

                default:
                    $transactions = Transaction::where("asset_id", $request->asset_id)->simplePaginate($perPage);
                break;
            }
        }
            else {
                switch (true) {
                    case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                            ->where("run_no", $request->run_no)
                            ->where("asset_id", $request->asset_id)
                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                            ->get();
                        break;

                    case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate == ''):
                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                            ->where("asset_id", $request->asset_id)
                            ->where("run_no", $request->run_no)
                            ->get();
                        break;

                    case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                            ->where("asset_id", $request->asset_id)
                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                            ->get();
                        break;

                    case $request->hospital_id == '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
                        $transactions = Transaction::where("run_no", $request->run_no)
                            ->where("asset_id", $request->asset_id)
                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                            ->get();
                        break;

                    case $request->hospital_id == '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
                        $transactions = Transaction::where("asset_id", $request->asset_id)
                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                            ->get();
                        break;

                    case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                            ->where("asset_id", $request->asset_id)->get();
                        break;

                    default:
                        $transactions = Transaction::where("asset_id", $request->asset_id)->get();
                    break;
                }
            }
        }

        switch ($request->printField) {
            case '1':
                // Code for Form Page 1
                return view('admin.reports.print.page1', compact('transactions'));
                break;
            case '2':
                // Code for Form Page 2
                return view('admin.reports.print.page2', compact('transactions'));
                break;
            case '3':
                // Code for Form Page 3
                return view('admin.reports.print.page3', compact('transactions'));
                break;
            case '4':
                // Code for Form Page 4
                return view('admin.reports.print.page4', compact('transactions'));
                break;
            // Add more cases if needed
            default:
                break;
        }

    }



}
