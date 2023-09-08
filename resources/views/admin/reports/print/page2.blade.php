<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="content">
        <p style="font-family: Calibri;">
            @foreach ($transactions as $key => $transaction)
                {{-- Asset1 --}}
                @if ($transaction->asset_id == 1 || $transaction->asset_id == 3)
                    <table align="center" style="margin-top:-25px;" width="79%" border="0">
                        <tr>
                            <td height="27" align="left" scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="36%" height="33" align="left" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->asset->name ?? '' }}  {{ $transaction->asset_product->product_name ?? '' }}</b>
                            </td>
                            <td width="30%" scope="col">&nbsp;</td>
                            <td width="34%" scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="25" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->activity_mci ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="26" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->volume ?? '' }}&nbsp;</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="27" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date('m/d/Y', strtotime($transaction->calibration_date)) ?? '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_time ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="29" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_date ?? '' }}&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_time ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="34" scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->patient ?? '' }}</b>
                            </td>
                            <td colspan="2" scope="col">
                                <b  style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->hospital->hospital ?? '' }}</b></td>
                        </tr>
                        <tr>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->asset->name ?? '' }}  {{ $transaction->asset_product->product_name ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;&nbsp;<b>{{ $transaction->procedure1 ?? '' }}</b></td>
                            <td><b style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->particular ?? '' }}</b><b
                                    style="font-size:12px; color:#f00; ">({{ $transaction->activity_mbq ?? '' }}
                                    MBq)</b><b style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->rx_no ?? '' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td height="28" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            </td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date('m/d/Y', strtotime($transaction->calibration_date)) ?? '' }}</b>
                            </td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_time ?? '' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td height="21" valign="top" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_date ?? '' }}</b>
                            </td>
                            <td valign="top" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_time ?? '' }}</b>
                            </td>
                            <td valign="top" scope="col">&nbsp;</td>
                        </tr>
                    </table>
                    <tr>
                        <td colspan="4" scope="col">&nbsp;</td>
                        <td align="right" width="11%" rowspan="2" scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        <td scope="col" style="font-size:11px"></td>
                        <td colspan="3" scope="col" style="font-size:11px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="13%" scope="col" style="font-size:11px"></td>
                        <td width="30%" scope="col" style="font-size:11px">&nbsp;</td>
                        <td width="25%" scope="col" style="font-size:11px"></td>
                        <td colspan="2" scope="col" style="font-size:11px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td scope="col" style="font-size:11px"></td>
                        <td scope="col" style="font-size:11px">&nbsp;</td>
                        <td scope="col" style="font-size:11px"></td>
                        <td colspan="2" scope="col" style="font-size:11px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right" colspan="5" scope="col"><b></b></td>
                    </tr>
                    </table>

                    {{-- Asset2 --}}
                @elseif ($transaction->asset_id == 2)
                    <table align="center" width="52%" border="0">
                        <tr>
                            <td colspan="2" scope="col" align="center"
                                style="font-size:16px; border-top:1pt solid black;border-left:1pt solid black;border-right:1pt solid black;">
                                <b>{{ $transaction->hospital->hospital ?? '' }}<br />
                                    <span align="center" style="font-size:20px;">
                                        {{ $transaction->particular ?? '' }}</span><br /><span align="center"
                                        style="font-size:20px;font-weight:normal;">
                                        {{ $transaction->patient ?? '' }}</span></b>
                            </td>
                        </tr>
                        <tr>
                            <td width="71%" scope="col" align="center"
                                style="font-size:20px;font-weight:bold;border-bottom:1pt solid black;border-left:1pt solid black;">
                                {{ date('m/d/Y', strtotime($transaction->calibration_date)) ?? '' }}</td>
                            <td align="left" width="29%" scope="col"
                                style="font-size:20px;font-weight:bold;border-bottom:1pt solid black;border-right:1pt solid black;">
                                {{ $transaction->rx_no ?? '' }}</td>
                        </tr>
                    </table>
                @endif
            @endforeach
        </p>
        <br>
        <style>
            @media print {
                .no-print {
                    display: none;
                }
            }
        </style>
        <div class="no-print">
            <div style="text-align: center;">{{ $transactions->withQueryString()->links() }}</div>
        </div>
    </div>
</div>
