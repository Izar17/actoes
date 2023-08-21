<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DrsiResource;
use App\Drsi;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class DrsisApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DrsiResource(Drsi::with(['asset', 'user', 'hospital','asset_product','product_activity','runNumber'])->get());

    }

}
