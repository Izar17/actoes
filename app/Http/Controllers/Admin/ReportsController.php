<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Hospital,Asset,RunNumber,Transaction};
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN,'403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $hospitals = Hospital::all();

        return view('admin.reports.index', compact('hospitals','assets','run_nos'));
    }

    
    public function print(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN,'403 Forbidden');
        switch ($request->asset_id) {
            case 1: // Code for asset_id == 1
                switch ($request->printField) {
                    case '1': // Code for printField == 1
                        if ($request->rx_number != '') {
                            $transactions = Transaction::where("rx_no", $request->rx_number)
                            ->where("asset_id", 1)->get();
                        } else {
                            switch (true) {
                                case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate !=''):
                                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                        ->where("run_no", $request->run_no)
                                        ->where("asset_id", 1)
                                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                        ->get();
                                    break;
                            
                                case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate ==''):
                                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                        ->where("asset_id", 1)
                                        ->where("run_no", $request->run_no)
                                        ->get();
                                    break;
                            
                                case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate !=''):
                                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                        ->where("asset_id", 1)
                                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                        ->get();
                                    break;
                            
                                case $request->hospital_id == '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate !=''):
                                    $transactions = Transaction::where("run_no", $request->run_no)
                                        ->where("asset_id", 1)
                                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                        ->get();
                                    break;
                                    
                                case $request->hospital_id == '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate !=''):
                                    $transactions = Transaction::where("asset_id", 1)
                                        ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                        ->get();
                                    break;

                                default:
                                    $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                    ->where("asset_id", 1)->get();
                                    break;
                            }
                        }
                        return view('admin.reports.print.boxlabel', compact('transactions'));
                        break;
                    
                    // Add more cases if needed
                    
                    default:
                        // Handle default case
                        break;
                }
        
                case 2:
                    switch ($request->printField) {
                        case '1': // Code for printField == 1
                            if ($request->rx_number != '') {
                                $transactions = Transaction::where("rx_no", $request->rx_number)
                                ->where("asset_id", 2)->get();
                            } else {
                                switch (true) {
                                    case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate !=''):
                                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                            ->where("run_no", $request->run_no)
                                            ->where("asset_id", 2)
                                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                            ->get();
                                        break;
                                
                                    case $request->hospital_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate ==''):
                                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                            ->where("asset_id", 2)
                                            ->where("run_no", $request->run_no)
                                            ->get();
                                        break;
                                
                                    case $request->hospital_id != '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate !=''):
                                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                            ->where("asset_id", 2)
                                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                            ->get();
                                        break;
                                
                                    case $request->hospital_id == '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate !=''):
                                        $transactions = Transaction::where("run_no", $request->run_no)
                                            ->where("asset_id", 2)
                                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                            ->get();
                                        break;
                                
                                    
                                    case $request->hospital_id == '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate !=''):
                                        $transactions = Transaction::where("asset_id", 2)
                                            ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                                            ->get();
                                        break;

                                    default:
                                        $transactions = Transaction::where("hospital_id", $request->hospital_id)
                                        ->where("asset_id", 2)->get();
                                        break;
                                }
                            }
                            return view('admin.reports.print.boxlabel', compact('transactions'));
                            break;
                        
                        // Add more cases if needed
                        
                        default:
                            // Handle default case
                            break;
                    }
        
            // Add more cases if needed
        
            default:
                // Handle default case
                break;
        }
    }
    
    

}
