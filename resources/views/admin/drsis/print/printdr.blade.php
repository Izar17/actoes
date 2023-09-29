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
        </table>

        @if (isset($transaction))
            <table width="100%" align="center" cellspacing="0">
                <tr>
                    <td style="width:45%;" align="center" scope="col"><strong></strong></td>
                    <td colspan="2" scope="col"><strong><span style="font-size:16px;"></span></strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>{{ $transaction->hospital->hospital ?? '' }}<br></strong>
                    </td>
                    <td colspan="3" scope="col"><strong><span
                                style="font-size:16px;"></span>{{ now()->format('m/d/Y') }}</strong></td>
                    <td align="center" scope="col"><strong></td>
                </tr>
                <tr>
                    <td><strong>{{ $transaction->hospital->address ?? '' }}</strong></td>
                </tr>
            </table>
            <br /><br />
            <table width="100%" align="center" cellspacing="0">
                <tr>
                    <td style="width:45%;"scope="col"><strong>SAME</strong></td>
                    <td colspan="3" scope="col"><strong><span
                                style="font-size:16px;"></span>{{ now()->format('m/d/Y') }}</strong></td>
                    <td align="center" scope="col"><strong></td>
                </tr>
            </table><br /><br /><br /><br /><br />
            <table width="100%" align="center" cellspacing="0">
                <tr>
                    <td style="width:30%;" scope="col"></td>
                    <td colspan="5" scope="col"style="font-size:16px;text-align:center;">
                        <strong><span></span>{{ $transaction->hospital->hospital ?? '' }}</strong>
                    </td>
                </tr>
            </table><br /><br /><br />
            @php
                $totalPrice = 0; // Initialize the total price variable
            @endphp
            <table width="100%" align="center" style="margin-top:60px;" cellspacing="0">

                @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td width="70px" style="padding-top:10px;">1</td>
                        <td width="70px" style="padding-top:10px;">dose</td>
                        <td width="70px" style="padding-top:10px;"></td>
                        <td>
                            {{ $transaction->asset->name ?? '' }}

                            {{ $transaction->asset_product->product_name ?? '' }},
                            {{ $transaction->particular ?? '' }},
                            {{ $transaction->rx_no ?? '' }}
                        </td>
                    </tr>
                    @php
                        $totalPrice += $transaction->price ?? 0; // Add the transaction price to the total
                    @endphp
                @endforeach
                <!-- Footer row to display the total -->
                <tr>
                    <td colspan="3"></td>
                    <td>###NOTHING FOLLOWS###</td>
                </tr>
            </table>
        @endif
    </div>
</div>
