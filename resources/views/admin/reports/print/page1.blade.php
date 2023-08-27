<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />

<div class="container">
    <div class="content">
        <p style="font-family: Calibri;">
            @foreach ($transactions as $key => $transaction)
                {{-- Asset1 --}}
                @if ($transaction->asset_id == 1 || $transaction->asset_id == 3)
                    <table align="center" width="98%" border="0">
                        <tr>
                            <td height="40" align="left" scope="col">&nbsp;</td>
                            <td align="left" scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td align="left" scope="col">&nbsp;</td>
                            <td align="left" scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="8%" height="29" align="left" scope="col">&nbsp;</td>
                            <td width="22%" align="left" scope="col">
                                <b>{{ $transaction->asset->name ?? '' }}</b>
                            </td>
                            <td width="19%" scope="col"><b>&nbsp;&nbsp;{{ $transaction->particular ?? '' }} </b><b
                                    style="font-size:12px; color:#f00; ">({{ $transaction->activity_mbq ?? '' }}
                                    MBq)</b></td>
                            <td width="11%" align="left" scope="col">&nbsp;</td>
                            <td width="22%" align="left" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;{{ $transaction->asset->name ?? '' }}</b>
                            </td>
                            <td width="18%" scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->particular ?? '' }}</b><b
                                    style="font-size:12px; color:#f00; ">({{ $transaction->activity_mbq ?? '' }}
                                    MBq)</b>
                            </td>
                        </tr>
                        <tr>
                            <td height="24" scope="col">&nbsp;</td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $transaction->calibration_date ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;&nbsp;<b>{{ $transaction->calibration_time ?? '' }}</b></td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_date ?? '' }}</b>
                            </td>
                            <td scope="col"><b>&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_time ?? '' }}</b></td>
                        </tr>
                        <tr>
                            <td height="22" scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;&nbsp;<b>{{ $transaction->volume ?? '' }}</b></td>
                            <td scope="col">&nbsp;&nbsp;<b>ml</b></td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col"><b>&nbsp;&nbsp;&nbsp;{{ $transaction->volume ?? '' }}</b></td>
                            <td scope="col"><b>ml</b></td>
                        </tr>
                        <tr>
                            <td height="24" scope="col">&nbsp;</td>
                            <td scope="col">
                                <b>&nbsp;{{ $transaction->expiry_date ?? '' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_time ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_date ?? '' }}&nbsp;&nbsp;{{ $transaction->expiry_time ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="29" scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_date ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_date ?? '' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="25" colspan="3" scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;{{ $transaction->hospital->hospital ?? '' }}</b>
                            </td>
                            <td colspan="3" scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->hospital->hospital ?? '' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td height="27" scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;{{ $transaction->patient ?? '' }}</b>
                            </td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->rx_no ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->patient ?? '' }}</b>
                            </td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->rx_no ?? '' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td height="33" scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;{{ $transaction->hospital->hospital ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->asset->name ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="32" scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;{{ $transaction->particular ?? '' }}</b><b
                                    style="font-size:14px; color:#f00; ">({{ $transaction->activity_mbq ?? '' }}
                                    MBq)</b>
                            </td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_time ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->particular ?? '' }}</b><b
                                    style="font-size:14px; color:#f00; ">({{ $transaction->activity_mbq ?? '' }}
                                    MBq)</b>
                            </td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->calibration_time ?? '' }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td height="25" scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;{{ $transaction->procedure1 ?? '' }}</b>
                            </td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $transaction->expiry_date ?? '' }}&nbsp;{{ $transaction->expiry_time ?? '' }}</b>
                            </td>
                            <td scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->procedure1 ?? '' }}</b>
                            </td>
                            <td scope="col" style="font-size:14px;">
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $transaction->expiry_date ?? '' }}&nbsp;&nbsp;{{ $transaction->expiry_time ?? '' }}</b>
                            </td>
                        </tr>
                    </table>


                    {{-- Asset2 --}}
                @elseif($transaction->asset_id == 2)
                    <table width="43%" height="118" border="0" align="center"
                        data-entry-id="{{ $transaction->id }}">
                        <tr>
                            <td height="19" colspan="2" align="left" style="font-size:11px; "
                                scope="col"><b>Sodium
                                    Iodide, Na 131
                                    I</b></td>
                            <td width="15%" rowspan="2" align="right" style="font-size:12px; "
                                scope="col"><img src="{{ asset('img/nuclear_logo.jpg') }}" alt="Image"
                                    width="38" height="28" />
                            </td>
                        </tr>
                        <tr>
                            <td height="19" colspan="2" align="left"
                                style="font-size:10px;font-weight:normal;">
                                Hospital:&nbsp;&nbsp;<b><u>{{ $transaction->hospital->hospital ?? '' }}</u></b></td>
                        </tr>
                        <tr>
                            <td width="55%" height="19" align="left"
                                style="font-size:10px;font-weight:normal;">
                                Activity:&nbsp;&nbsp;<b><u>{{ $transaction->particular ?? '' }}
                                        {{ $transaction->asset_product->product_name ?? '' }}</u></b><u> <strong
                                        style="color:#f00;">ACTIVITY MBQ</strong></u></td>
                            <td colspan="2" align="left" style="font-size:10px;font-weight:normal;">Calibration
                                Date:&nbsp;&nbsp;<b><u>{{ $transaction->calibration_date }}</u></b></td>
                        </tr>
                        <tr>
                            <td height="19" align="left" style="font-size:10px;font-weight:normal;">
                                Patient:&nbsp;&nbsp;<u>{{ $transaction->patient }}</u></td>
                            <td colspan="2" alig n="left" style="font-size:10px;font-weight:normal;">Rx
                                No.:&nbsp;&nbsp;<b><u>{{ $transaction->rx_no }}</u></b></td>
                        </tr>
                        <tr>
                            <td height="23" colspan="3" align="right" valign="top"
                                style="font-size:10px;font-weight:normal;">
                                <strong>Assurance Controls Technologies Co., Inc.</strong><br />
                            </td>
                        </tr>
                    </table>
                @endif
            @endforeach
        </p>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">
        function myPrint() {
            window.frames["myIframe"].focus();
            window.frames.print();
        }
    </script>
@endsection
