<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\{Transaction,Asset,Hospital,RunNumber};
use Symfony\Component\HttpFoundation\Response;

class CancelledController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->where("cancelled",'YES');

        $hospitals = Hospital::all();

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        return view('admin.cancelled.index', compact('transactions','assets','run_nos','hospitals'));
    }
}
