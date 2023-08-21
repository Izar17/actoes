<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{Asset, User, Hospital, RunNumber, Asset_product, Production, LeadPot, Drsi};
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateDrsiRequest;
use Carbon\Carbon;

class DrsisController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drsis = Drsi::join('hospitals', 'transactions.hospital_id', '=', 'hospitals.id')
        ->where('transactions.status', 1)
        ->distinct('hospitals.hospital')
        ->pluck('hospitals.hospital','hospitals.id');

        return view('admin.drsis.index', compact('drsis'));
    }

    public function edit(Drsi $drsis, $ida)
    {
        abort_if(Gate::denies('drsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productions = Production::all()->where("hospital_id",$ida);

       return view('admin.drsis.edit', compact('drsis','productions','ida'));
    }

    public function update(UpdateDrsiRequest $request,Drsi $drsis)
    {
        foreach ($request->dr_no as $key => $dr_no) {
            $drsis->update(['dr_no' => $request->dr_no[$key]] + ['invoice_no' => $request->invoice_no[$key]] + ['price' => $request->price[$key]]);
        }

        return redirect()->route('admin.drsis.index');
    }

}
