<?php
namespace App;

$assets = Asset::orderBy('id', 'asc')->get(["name", "id"]);

$run_nos = RunNumber::orderBy('id', 'asc')->get(["run_name", "id"]);

$hospitals = Hospital::all();

if ($request->rx_number != '') {
    $transactions = Transaction::where("rx_no", $request->rx_number)->get();
} else {
    switch ($request->hospital_id) {
        //query for Hospital

        case $request->asset_id != '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->where("asset_id", $request->asset_id)
                ->get();
            break;

        case $request->asset_id != '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate == ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->where("run_no", $request->run_no)->where("cancelled", 'NO')
                ->where("asset_id", $request->asset_id)
                ->get();
            break;

        case $request->asset_id != '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->where("run_no", $request->run_no)->where("cancelled", 'NO')
                ->where("asset_id", $request->asset_id)
                ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                ->get();
            break;

        case $request->asset_id != '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->where("asset_id", $request->asset_id)
                ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                ->get();
            break;


        case $request->asset_id == '' && $request->run_no == '' && ($request->startDate == '' || $request->endDate == ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->get();
            break;

        case $request->asset_id == '' && $request->run_no != '' && ($request->startDate == '' || $request->endDate == ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->where("run_no", $request->run_no)->where("cancelled", 'NO')
                ->get();
            break;

        case $request->asset_id == '' && $request->run_no == '' && ($request->startDate != '' || $request->endDate != ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                ->get();
            break;

        case $request->asset_id == '' && $request->run_no != '' && ($request->startDate != '' || $request->endDate != ''):
            $transactions = Transaction::where("hospital_id", $request->hospital_id)
                ->where("run_no", $request->run_no)->where("cancelled", 'NO')
                ->whereBetween("calibration_date", [$request->startDate, $request->endDate])
                ->get();
            break;

        default:
            $transactions = Transaction::All()->where("hospital_id", $request->hospital_id)->where("cancelled", 'NO');
            break;

            // $transactions = Transaction::join('product_hospital', 'transactions.asset_id', '=', 'product_hospital.asset_id')
            //     ->where("transactions.hospital_id", $request->hospital_id)
            //     ->where("cancelled", 'NO')
            //     ->whereRaw('CAST(transactions.activity_mci AS numeric) BETWEEN CAST(product_hospital.lower_limit AS numeric) AND CAST(product_hospital.upper_limit AS numeric)')
            //     ->select('transactions.*', 'product_hospital.price as actPrice')
            //     ->distinct()
            //     ->get();
    }
}


?>
