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
                    <td style="padding-left:20px;"><strong>{{ $transaction->hospital->doctor_name ?? '' }}<br></strong>
                    </td>
                    <td colspan="3" scope="col"><strong><span
                                style="font-size:16px;"></span>{{ now()->format('m/d/Y') }}</strong></td>
                    <td align="center" scope="col"><strong></td>
                </tr>
                <tr><td style="padding-left:20px;"><strong>{{ $transaction->hospital->hospital ?? '' }}</strong></td></tr>
                <tr><td style="padding-left:20px;"><strong>{{ $transaction->hospital->address ?? '' }}</strong></td></tr>
            </table>
            <br />
            <table width="95%" align="center" cellspacing="0">
                <tr>
                    <td style="width:50%;" align="center" scope="col"><strong></strong></td>
                    <td colspan="3" scope="col"><strong><span
                                style="font-size:16px;"></span>{{ now()->format('m/d/Y') }}</strong></td>
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
                $totalPrice = 0; // Initialize the total price variable
            @endphp
            <table width="95%" align="center" cellspacing="0">

                @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td width="70px" style="text-align:center;">1</td>
                        <td width="70px" style="text-align:center;">dose</td>
                        <td width="70px" style="text-align:center;"></td>
                        <td>
                            {{ $transaction->asset->name ?? '' }}

                            {{ $transaction->asset_product->product_name ?? '' }},
                            {{ $transaction->particular ?? '' }},
                            {{ $transaction->rx_no ?? '' }}
                        </td>
                        <td width="150px">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($transaction->price, 2, '.', ',') }}</td>
                    </tr>
                    @php
                        $totalPrice += $transaction->price ?? 0; // Add the transaction price to the total
                    @endphp
                @endforeach
                <!-- Footer row to display the total -->
                <tr>
                    <td colspan="4"></td> <!-- Adjust colspan based on your table structure -->
                    <td><u>________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                </tr>
                <tr>
                    <td colspan="4"></td> <!-- Adjust colspan based on your table structure -->
                    <td style="padding-top: 20%;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($totalPrice, 2, '.', ',') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                    </td>
                </tr>
            </table>
        @endif
    </div>
</div>
