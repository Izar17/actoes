<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="content">

        @foreach ($transactions as $key => $transaction)
        @endforeach
        <table width="100%" border="0" align="center">
            <tr>
                <td scope="col" align="center" style="font-size:18px;">
                    </style></b><br />
                </td>
            </tr>
        </table><br />

        @if (isset($transaction))
            <table width="80%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" align="center" scope="col"><strong></strong></td>
                    <td colspan="8" scope="col"><strong><span style="font-size:16px;"></span></strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding-left:20px;"><strong>{{ $transaction->hospital->hospital ?? '' }}</strong>
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
                <tr>
                    <td style="padding-left:20px;"><strong>{{ $transaction->hospital->address ?? '' }}</strong></td>
                </tr>
            </table><br />
            <table width="95%" align="center" cellspacing="0">

                <tr>
                    <td style="width:50%;" scope="col"></td>
                    <td style="width:34%;" scope="col"></td>
                    <td scope="col"style="font-size:16px;">
                        <strong>
                            @if ($transaction->hospital_id == 36)
                                90 Days
                            @elseif ($transaction->hospital_id == 51)
                                60 Days
                            @else
                                30 Days
                            @endif
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:20px;"></td>
                    <td><strong>&nbsp;</strong></td>
                </tr>
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
            </table><br /><br />
            <table width="80%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" scope="col"></td>
                    <td colspan="5" scope="col"style="font-size:16px;text-align:right;">
                        <strong>DR # {{ $transaction->dr_no ?? '' }}</strong>
                    </td>
                </tr>
            </table><br /><br />
            <table width="80%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" scope="col">&nbsp;&nbsp;&nbsp;<strong>SAME</strong></td>
                    <td colspan="5" scope="col"style="font-size:16px;text-align:center;">
                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->hospital->hospital ?? '' }}</strong>
                    </td>
                </tr>
            </table><br /><br /><br />
            @php
                $totalPrice = 0;
                $totalDeliveryCharge = 0; // Initialize the total price variable
            @endphp
            <table width="95%" align="center" style="margin-top:40px;" cellspacing="0">

                @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td width="70px" style="text-align:center;padding-top:10px;">
                            @if ($transaction->asset_id == 8)
                                {{ $transaction->activity_mci ?? '' }}
                            @else
                                1
                            @endif
                        </td>
                        <td width="70px" style="text-align:center;">
                            @if ($transaction->asset_id == 8)
                                {{ $transaction->patient ?? '' }}
                            @else
                                dose
                            @endif
                        </td>
                        <td width="70px" style="text-align:center;"></td>
                        <td colspan="2px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            @if ($transaction->asset_id == 2)
                            {{ $transaction->asset->name ?? '' }}
                            @endif
                            {{ $transaction->asset_product->product_name ?? '' }},

                            @if ($transaction->asset_id == 8)
                                {{-- {{ $transaction->activity_mci?? '' }}
                                    {{ $transaction->patient?? '' }}, --}}
                            @else
                                {{ $transaction->particular ?? '' }},
                            @endif
                            {{ $transaction->rx_no ?? '' }}
                        </td>
                        <td width="100px" style="text-align: right;">
                            {{ number_format($transaction->price, 2, '.', ',') }}</td>
                        <td width="140px" style="text-align: right;">
                            {{ number_format($transaction->price, 2, '.', ',') }}</td>
                    </tr>
                    @php
                        $totalPrice += $transaction->price ?? 0;
                        $totalDeliveryCharge = $request->delivery_charge ?? 0;
                        $grandTotal = $totalPrice + $totalDeliveryCharge;
                        $lessVat = $grandTotal * 0.1;
                        $netVat = $grandTotal - $grandTotal * 0.1;
                    @endphp
                @endforeach
                <!-- Footer row to display the total -->
                <tr>
                    <td colspan="3" style="padding-top: 40%;"></td>
                    <td></td>
                    <td style="text-align: right;">Delivery Charge:</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($totalDeliveryCharge, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td style="text-align: right;"></td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($grandTotal, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td style="text-align: right;"></td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($lessVat, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td style="text-align: right;"></td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($netVat, 2, '.', ',') }}
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top: 10%;"></td>
                    <td></td>
                    <td style="text-align: right;"></td>
                    <td></td>
                    <td style="text-align: right;">
                        <hr>
                        {{ number_format($grandTotal, 2, '.', ',') }}
                        <hr>
                    </td>
                </tr>
            </table>
        @endif
    </div>
</div>
