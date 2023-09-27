<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="content">

        @foreach ($transactions as $key => $transaction)
        @endforeach
        <table width="100%" border="0" align="center">
            <tr><br /><br /><br /><br /><br />
                <td scope="col" align="center" style="font-size:18px;">
                    </style></b><br /><br /><br />
                </td>
            </tr>
        </table><br />

        @if (isset($transaction))
            <table width="95%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" align="center" scope="col"><strong></strong></td>
                    <td colspan="8" scope="col"><strong><span style="font-size:16px;"></span></strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td scope="col">&nbsp;&nbsp;&nbsp;<strong>{{ $transaction->hospital->hospital ?? '' }}</strong>
                    </td>
                    <td colspan="3" scope="col"><strong><span style="font-size:16px;"></span>
                            @php
                                $dateString = "$transaction->calibration_date";
                                $timestamp = strtotime($dateString);
                                $formattedDate = date('m/d/Y', $timestamp);
                                echo $formattedDate;
                            @endphp</strong></td>
                    <td align="center" scope="col"><strong></td>
                </tr>
            </table><br /><br />
            <table width="95%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" align="center" scope="col"><strong></strong></td>
                    <td colspan="3" scope="col"><strong><span style="font-size:16px;"></span>
                            @php
                                $dateString = "$transaction->calibration_date";
                                $timestamp = strtotime($dateString);
                                $formattedDate = date('m/d/Y', $timestamp);
                                echo $formattedDate;
                            @endphp</strong></td>
                    <td align="center" scope="col"><strong></td>
                </tr>
            </table><br /><br /><br />
            <table width="95%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" scope="col">&nbsp;&nbsp;&nbsp;<strong>SAME</strong></td>
                    <td colspan="5" scope="col"style="font-size:16px;text-align:center;">
                        <strong><span></span>{{ $transaction->hospital->hospital ?? '' }}</strong>
                    </td>
                </tr>
            </table><br /><br /><br />
            @php
                $totalPrice = 0;
                $totalDeliveryCharge = 0; // Initialize the total price variable
            @endphp
            <table width="95%" align="center" style="margin-top:60px;" cellspacing="0">

                @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td width="70px" style="text-align:center;padding-top:10px;">1</td>
                        <td width="70px" style="text-align:center;">dose</td>
                        <td width="70px" style="text-align:center;"></td>
                        <td colspan="2px">
                            {{ $transaction->asset->name ?? '' }}

                            {{ $transaction->asset_product->product_name ?? '' }},
                            {{ $transaction->particular ?? '' }},
                            {{ $transaction->rx_no ?? '' }}
                        </td>
                        <td width="100px" style="text-align: right;">
                            {{ number_format($transaction->price, 2, '.', ',') }}</td>
                        <td width="100px" style="text-align: right;">
                            {{ number_format($transaction->price, 2, '.', ',') }}</td>
                    </tr>
                    @php
                        $totalPrice += $transaction->price ?? 0;
                        $totalDeliveryCharge += $transaction->delivery_charge ?? 0;
                        $grandTotal = $totalPrice + $totalDeliveryCharge;
                        $lessVat = $grandTotal*.10;
                        $netVat = $grandTotal - ($grandTotal*.10);
                    @endphp
                @endforeach
                <!-- Footer row to display the total -->
                <tr>
                    <td colspan="3"  style="padding-top: 20%;"></td>
                    <td></td>
                    <td style="text-align: right;">Delivery Charge:</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($totalDeliveryCharge, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3" ></td>
                    <td></td>
                    <td style="text-align: right;">TOTAL SALES (VAT INCLUSIVE):</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($grandTotal, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td style="text-align: right;">LESS VAT:</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($lessVat, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>VATABLE SALES</td>
                    <td style="text-align: right;">NET OF VAT/TOTAL:</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($netVat, 2, '.', ',') }}<hr></td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top: 10%;"></td>
                    <td>VAT AMOUNT</td>
                    <td style="text-align: right;">TOTAL AMOUNT DUE</td>
                    <td></td>
                    <td style="text-align: right;"><hr>
                        {{ number_format($grandTotal, 2, '.', ',') }}<hr>
                    </td>
                </tr>
            </table>
        @endif
    </div>
</div>
