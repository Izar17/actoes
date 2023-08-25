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
            case 1: // Code for Tc99m
                switch ($request->printField) {
                    case '1': 
                        // Code for Form Page 1
                        require app_path('Forms/tcForm1.php');
                        return view('admin.reports.print.page1', compact('transactions'));
                        break;
                    
                    case '2': 
                        // Code for Form Page 2
                        require app_path('Forms/tcForm2.php');
                        return view('admin.reports.print.page2', compact('transactions'));
                        break;

                    case '3': 
                        // Code for Form Page 2
                        require app_path('Forms/tcForm3.php');
                        return view('admin.reports.print.page2', compact('transactions'));
                        break;
                            
                    case '4': 
                        // Code for Form Page 2
                        require app_path('Forms/tcForm4.php');
                        return view('admin.reports.print.page2', compact('transactions'));
                        break;
                        // Add more cases if needed
                        
                        default:
                        break;
                    }
        
            case 2: // Iodine
                switch ($request->printField) {
                    case '1': 
                        // Code for Form Page 1
                        require app_path('Forms/iForm1.php');
                        return view('admin.reports.print.page1', compact('transactions'));
                        break;
                    
                    // Add more cases if needed
                    
                    default:
                    break;
                }
        
            // Add more cases if needed
        
            default:
            break;
        }
    }
    
    

}
