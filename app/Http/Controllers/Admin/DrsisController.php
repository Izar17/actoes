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

    public function edit(Drsi $drsis, $ida)
    {
        abort_if(Gate::denies('drsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productions = Production::all()->where("hospital_id",$ida);

        $assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

        $run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

       return view('admin.drsis.edit', compact('drsis','productions','ida','assets','run_nos'));
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
