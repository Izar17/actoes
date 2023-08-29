<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{Asset, User, Hospital, RunNumber, Asset_product, Production, LeadPot};
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateProductionRequest;
use Carbon\Carbon;

class ProductionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('production_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

        $productions = Production::all()->where("status",1)->where("cancelled",'NO');

        return view('admin.productions.index', compact('productions','assets','run_nos'));
    }

    public function edit(Production $production)
    {
        abort_if(Gate::denies('production_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hospitals = Hospital::all()->pluck('hospital', 'id')->prepend(trans('global.pleaseSelect'), '');

        $run_nos = RunNumber::all()->pluck('run_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset_products = Asset_product::all()->pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $leadpots = LeadPot::all()
        ->where("asset_id",$production->asset_id)
        ->pluck('lead_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

       return view('admin.productions.edit', compact('assets', 'asset_products', 'users', 'production','hospitals','run_nos','leadpots'));
    }

    public function update(UpdateProductionRequest $request, Production $production)
    {

        // if (!empty($request->expiry_time)) {
        //Format Time with AM/PM
        // $expiry_time = Carbon::createFromFormat('H:i', $request->expiry_time)->format('h:i A');
        // $time_dispensed = Carbon::createFromFormat('H:i', $request->time_dispensed)->format('h:i A');
        // } else {
        //     $expiry_time = '';
        //     $time_dispensed = '';
        // }
        // $production->update(['expiry_time' => $expiry_time] + ['time_dispensed' => $time_dispensed] + $request->all());
        $production->update($request->all());

        return redirect()->route('admin.productions.index');
    }




}
