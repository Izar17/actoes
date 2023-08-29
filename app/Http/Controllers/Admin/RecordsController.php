<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\{Transaction, Asset, RunNumber};
use Gate;
use Symfony\Component\HttpFoundation\Response;

class RecordsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->where("status", '!=', 1)->where("cancelled",'NO');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        return view('admin.reports.records.index', compact('transactions','assets','run_nos'));
    }
}
