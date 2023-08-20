<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHospitalRequest;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Hospital;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class HospitalsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN,'403 Forbidden');

        $hospitals = Hospital::all();

        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        abort_if(Gate::denies('hospital_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hospitals.create');
    }

    public function store(StoreHospitalRequest $request)
    {
        $hospitals = Hospital::create($request->all());

        return redirect()->route('admin.hospitals.index');
    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hospitals.show', compact('hospital'));
    }

    public function edit(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());

        return redirect()->route('admin.hospitals.index');
    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return back();

    }

    public function massDestroy(MassDestroyHospitalRequest $request)
    {
        Hospital::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
