<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use App\{Asset_product, Product_activity};

class DropdownController extends Controller
{
    public function fetchProduct(Request $request)
    {
        $data['asset_products'] = Asset_Product::where("asset_id",$request->asset_id)->get(["product_name", "id"]);
        return response()->json($data);
    }

    public function fetchActivity(Request $request)
    {
        $data['product_activities'] = Product_Activity::where("product_id",$request->product_id)->get(["activity_name", "id"]);
        return response()->json($data);
    }
}
