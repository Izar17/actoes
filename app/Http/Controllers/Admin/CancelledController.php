<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Transaction;
use Symfony\Component\HttpFoundation\Response;

class CancelledController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->where("cancelled",'YES');

        return view('admin.cancelled.index', compact('transactions'));
    }
}
