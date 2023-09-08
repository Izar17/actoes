<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="content">

        @foreach ($transactions as $key => $transaction)
        @endforeach
        <table width="100%" border="0" align="center">
            <tr><br /><br /><br /><br /><br />
                <td scope="col" align="center" style="font-size:18px;"><b>ASSURANCE CONTROLS TECHNOLOGIES CO., INC.
                        </style></b><br />
                    <p style="font-size:14px;">42 Montreal Street, Brgy E. Rodriguez Sr., Cubao, Quezon City,
                        Philippines<br />
                        Tel no: (02) 8709-0185, (02) 8292-5570, Telefax no: (02) 8529-9311<br />
                </td>
            </tr>
        </table><br />

        @if (isset($transaction))
            <table width="95%" border="1" align="center" cellspacing="0">
                <tr>
                    <td colspan="5" align="center" scope="col"><strong>
                            <p style="font-size:16px;">SHIPPER
                        </strong></td>
                    <td colspan="8" align="center" scope="col"><strong><span
                                style="font-size:16px;">CONSIGNEE</span></strong></td>
                </tr>
                <tr>
                    <td @if ($transaction->asset_id < 4) colspan="5"
                        @else
                        colspan="3" @endif
                        rowspan="2" align="center"><strong>
                            <p style="font-size:16px;">ASSURANCE CONTROLS TECHNOLOGIES
                            <p style="font-size:12px;"> 42 Montreal Street, Brgy E. Rodriguez Sr., Cubao, Quezon City,
                                Philippines
                        </strong></td>
                    <td colspan="8" align="center"><span style="font-size:16px;"><b><br />
                                {{ $transaction->hospital->hospital ?? '' }}
                                <br />
                                <br />
                                <strong>
                                    @php
                                        $dateString = "$transaction->calibration_date";
                                        $timestamp = strtotime($dateString);
                                        $formattedDate = date('l, F j, Y', $timestamp);
                                        $formattedMonth = date('F', $timestamp);
                                    @endphp
                                    @if ($transaction->asset_id == 7)
                                        @php
                                            echo $formattedMonth;
                                        @endphp
                                    @else
                                        @php
                                            echo $formattedDate;
                                        @endphp
                                    @endif
                                </strong>

                        </span><br><br></td>
                </tr>
                <tr>
                    <td align="center" style="font-size:12px; "><strong>RUN NO.:</strong></td>
                    <td align="center" style="font-size:12px; "><strong>
                            {{ $transaction->runNumber->run_name ?? '' }}
                        </strong></td>
                    <td colspan="5" align="center" style="font-size:12px; "><strong>DELIVERY</strong></td>
                </tr>
                @if ($transaction->asset_id != 2)
                    <tr>
                        <td width="85" rowspan="2" align="center"><strong>ORDER<br /> FORM NUMBER</strong></td>
                        <td width="66" rowspan="2" align="center"
                            @if ($transaction->asset_id > 3) colspan="2" @endif><strong>PRODUCT</strong></td>
                        <td width="80" rowspan="2" align="center"
                            @if ($transaction->asset_id > 3) colspan="2" @endif><strong>RX NO.</strong></td>
                        @if ($transaction->asset_id < 4)
                            <td width="42" rowspan="2" align="center"><strong>LOT #</strong></td>
                            <td width="65" rowspan="2" align="center"><strong>LEAD<br /> PIG</strong></td>
                        @endif
                        @if ($transaction->asset_id < 4)
                            <td width="126" rowspan="2" align="center"><strong>PROCEDURE</strong></td>
                        @endif
                        @if ($transaction->asset_id == 7)
                            <td colspan="1" rowspan="2" align="center"><strong>QUANTITY</strong></td>
                        @else
                            @if ($transaction->asset_id != 6 && $transaction->asset_id != 8)

                                <td width="136" rowspan="2" align="center"><strong>PATIENT'S NAME</strong>
                                </td>
                                <td width="61" rowspan="2" align="center"><strong> CAL<br /> TIME</strong></td>
                            @else
                                @if ($transaction->asset_id == 8)
                                    <td width="136" rowspan="2" align="center"><strong>UNIT OF
                                            MEASUREMENT</strong></td>
                                @endif
                                <td width="61" rowspan="2" align="center"><strong> GEN #</strong></td>
                            @endif
                            @if ($transaction->asset_id != 8)
                            <td colspan="2" align="center"><strong>ORDER DOSE</strong></td>
                            @else
                            <td colspan="2" align="center"><strong>QUANTITY</strong></td>
                            @endif
                        @endif
                        @if ($transaction->asset_id < 4)
                            <td colspan="2" align="center"><strong>ACTUAL DOSE</strong></td>
                        @endif
                    </tr>
                    <tr>
                        @if ($transaction->asset_id == 4 || $transaction->asset_id == 6)
                            <td colspan="2" align="center"><strong>Activity (GBq)</strong></td>
                        @elseif ($transaction->asset_id == 8 || $transaction->asset_id == 7)
                        @else
                            <td width="47" align="center"><strong>mCi</strong></td>
                            <td width="46" align="center"><strong>MBq</strong></td>
                        @endif
                        @if ($transaction->asset_id < 4)
                            <td width="48" align="center"><strong>mCi</strong></td>
                            <td width="50" align="center"><strong>MBq</strong></td>
                        @endif
                    </tr>

                    @php
                        $countWithR = 0;
                        $countWithB = 0;
                        $countWithS = 0;
                        $countWithG = 0;
                        $countWithO = 0;
                    @endphp
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td align="center">{{ $transaction->orderform_no ?? '' }}</td>
                            <td align="center" @if ($transaction->asset_id > 3) colspan="2" @endif>
                                {{ $transaction->asset_product->product_name ?? '' }}</td>
                            <td width="57" align="center" @if ($transaction->asset_id > 3) colspan="2" @endif>
                                {{ $transaction->rx_no ?? '' }}</td>
                            @if ($transaction->asset_id < 4)
                                <td align="center">{{ $transaction->lot_no ?? '' }}</td>
                                <td align="center">{{ $transaction->leadPot->lead_code ?? '' }}
                                    @if (isset($transaction->leadPot->lead_code))
                                        @switch($transaction->leadPot->lead_code)
                                            @case(strpos($transaction->leadPot->lead_code, 'R') !== false)
                                            @case(strpos($transaction->leadPot->lead_code, 'B') !== false)

                                            @case(strpos($transaction->leadPot->lead_code, 'S') !== false)
                                            @case(strpos($transaction->leadPot->lead_code, 'G') !== false)

                                            @case(strpos($transaction->leadPot->lead_code, 'O') !== false)
                                                @php
                                                    $countWithR += strpos($transaction->leadPot->lead_code, 'R') !== false ? 1 : 0;
                                                    $countWithB += strpos($transaction->leadPot->lead_code, 'B') !== false ? 1 : 0;
                                                    $countWithS += strpos($transaction->leadPot->lead_code, 'S') !== false ? 1 : 0;
                                                    $countWithG += strpos($transaction->leadPot->lead_code, 'G') !== false ? 1 : 0;
                                                    $countWithO += strpos($transaction->leadPot->lead_code, 'O') !== false ? 1 : 0;
                                                @endphp
                                            @break

                                            @default
                                        @endswitch
                                    @endif
                                </td>
                            @endif
                            @if ($transaction->asset_id < 4)
                                <td align="center">{{ $transaction->procedure1 ?? '' }}</td>
                            @endif
                            @if ($transaction->asset_id == 7)
                            @else
                                @if ($transaction->asset_id != 6)
                                    <td align="center">{{ $transaction->patient ?? '' }}</td>
                                @endif
                                <td align="center">{{ $transaction->calibration_time ?? '' }}</td>
                            @endif
                            <td align="center">{{ $transaction->activity_mci ?? '' }}</td>
                            @if (
                                $transaction->asset_id != 4 &&
                                    $transaction->asset_id != 6 &&
                                    $transaction->asset_id != 8 &&
                                    $transaction->asset_id != 7)
                                <td align="center" style="font-size:12px; color:#f00; ">
                                    <strong>{{ $transaction->activity_mbq ?? '' }}</strong>
                                </td>
                            @endif
                            @if ($transaction->asset_id < 4)
                                <td align="center">{{ $transaction->actual_dose ?? '' }}</td>
                                <td align="center" style="font-size:12px; color:#f00; ">
                                    <strong>{{ number_format($transaction->actual_mbq, 2, '.', ',') ?? '' }}</strong>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td width="86" rowspan="2" align="center"><strong>ORDER<br /> FORM<br />
                                NUMBER</strong>
                        </td>
                        <td width="83" rowspan="2" align="center"><strong>PRODUCT</strong></td>
                        <td width="80" rowspan="2" align="center"><strong>RX NUMBER</strong></td>
                        <td width="39" rowspan="2" align="center"><strong>FORM</strong></td>
                        <td width="80" rowspan="2" align="center"><strong>LEAD<br /> CONTAINER</strong></td>
                        <td rowspan="2" align="center"><strong>PATIENT NAME</strong></td>
                        <td rowspan="2" align="center"><strong>CALIBRATION<br /> TIME</strong></td>
                        <td colspan="2" align="center"><strong>ORDER<br /> DOSE</strong></td>
                        <td colspan="2" align="center"><strong>ACTUAL<br /> DOSE</strong></td>
                    </tr>
                    <tr>
                        <td align="center"><strong>mCi</strong></td>
                        <td width="55" align="center"><strong>MBq</strong></td>
                        <td align="center"><strong>mCi</strong></td>
                        <td align="center"><strong>MBq</strong></td>
                    </tr>

                    @php
                        $countWithBB = 0;
                        $countWithSB = 0;
                        $countWithP = 0;
                        $countWithY = 0;
                        $countWithG = 0;
                        $countWithO = 0;
                        $countWithW = 0;
                    @endphp
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td align="center">{{ $transaction->orderform_no ?? '' }}</td>
                            <td align="center">Iodine - 131</td>
                            <td width="56" align="center">{{ $transaction->rx_no ?? '' }}</td>
                            <td align="center">{{ $transaction->asset_product->product_name ?? '' }}</td>
                            <td align="center">{{ $transaction->leadPot->lead_code ?? '' }}
                                @if (isset($transaction->leadPot->lead_code))
                                    @switch($transaction->leadPot->lead_code)
                                        @case(strpos($transaction->leadPot->lead_code, 'BB') !== false)
                                        @case(strpos($transaction->leadPot->lead_code, 'SB') !== false)

                                        @case(strpos($transaction->leadPot->lead_code, 'P') !== false)
                                        @case(strpos($transaction->leadPot->lead_code, 'Y') !== false)

                                        @case(strpos($transaction->leadPot->lead_code, 'G') !== false)
                                        @case(strpos($transaction->leadPot->lead_code, 'O') !== false)

                                        @case(strpos($transaction->leadPot->lead_code, 'W') !== false)
                                            @php
                                                $countWithBB += strpos($transaction->leadPot->lead_code, 'BB') !== false ? 1 : 0;
                                                $countWithSB += strpos($transaction->leadPot->lead_code, 'SB') !== false ? 1 : 0;
                                                $countWithP += strpos($transaction->leadPot->lead_code, 'P') !== false ? 1 : 0;
                                                $countWithY += strpos($transaction->leadPot->lead_code, 'Y') !== false ? 1 : 0;
                                                $countWithG += strpos($transaction->leadPot->lead_code, 'G') !== false ? 1 : 0;
                                                $countWithO += strpos($transaction->leadPot->lead_code, 'O') !== false ? 1 : 0;
                                                $countWithW += strpos($transaction->leadPot->lead_code, 'W') !== false ? 1 : 0;
                                            @endphp
                                        @break

                                        @default
                                    @endswitch
                                @endif
                            </td>
                            <td align="center">{{ $transaction->patient ?? '' }}</td>
                            <td align="center">{{ $transaction->calibration_time ?? '' }}</td>
                            <td width="52" align="center">{{ $transaction->activity_mci ?? '' }}</td>
                            <td align="center" style="font-size:12px; color:#f00; ">
                                <strong>{{ $transaction->activity_mbq ?? '' }}</strong>
                            </td>
                            <td width="52" align="center">{{ $transaction->actual_dose ?? '' }}</td>
                            <td align="center" style="font-size:12px; color:#f00; ">
                                <strong>{{ number_format($transaction->actual_mbq, 2, '.', ',') ?? '' }}</strong>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table><BR />
            @if ($transaction->asset_id != 2)
                <p align="center" style="font-size:14px;"><strong>RADIOACTIVE MATERIAL, TYPE A PACKAGE, NORMAL FROM,
                        CLASS
                        7,
                        U.N. 2915</strong><br /><br />
                <table width="98%" align="center" cellspacing="0"
                    @if ($transaction->asset_id < 4) style="border-collapse:collapse;"
                @else
                style="border-collapse:collapse;margin-top:-70px" @endif>
                    <tr>
                        <td width="19%" align="left" scope="col" style="font-size:12px;"></td>
                        <td colspan="2" scope="col">

                        </td>
                        <td width="13%" align="left" scope="col" style="font-size:12px;">
                            </th>
                        <td width="4%" align="left" scope="col"></td>
                        <td width="8%" scope="col">&nbsp;</td>
                        <td width="9%" scope="col">&nbsp;</td>
                        <td width="23%" scope="col">&nbsp;</td>
                        <td width="7%" scope="col">&nbsp;</td>
                        <td width="8%" scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" scope="col">&nbsp;</td>
                        <td width="4%" scope="col">&nbsp;</td>
                        <td width="5%" scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>

                        @if ($transaction->asset_id < 4)
                            <td colspan="3" align="left" scope="col" style="font-size:12px;">
                                <strong>Date Dispensed:</strong>
                            </td>
                            <td colspan="3" scope="col" style="font-size:12px; border-bottom:1pt solid black"
                                align="center"><strong>
                                    @php
                                        $dateString = "$transaction->calibration_date";
                                        $timestamp = strtotime($dateString);
                                        $formattedDate = date('l, F j, Y', $timestamp);
                                        echo $formattedDate;
                                    @endphp
                                </strong></td>
                        @endif
                    </tr>
                    <tr>
                        @if ($transaction->asset_id == 1)
                            <td align="center" scope="col" style="font-size:12px;"><strong>Total
                                    {{ $transaction->asset_product->product_name ?? '' }}:</strong></td>
                            <td align="center" colspan="2" scope="col"
                                style="border-bottom:1pt solid black; font-size:12px;">
                                {{ count($transactions) }}
                            </td>
                        @else
                            <td scope="col" colspan="3px">&nbsp;</td>
                        @endif
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        @if ($transaction->asset_id == 1)
                            <td align="center" scope="col" style="font-size:12px;"><strong>Mo-99/Tc99m:</strong>
                            </td>
                            <td align="center" colspan="2" scope="col"
                                style="border-bottom:1pt solid black; font-size:12px;">

                            </td>
                        @else
                            <td scope="col" colspan="3px">&nbsp;</td>
                        @endif
                        <td scope="col">&nbsp;</td>

                        @if ($transaction->asset_id < 4)
                            <td colspan="3" align="left" scope="col" style="font-size:12px;">
                                <strong>Performed
                                    by:</strong>
                            </td>
                            <td colspan="3" scope="col"
                                style="font-size:12px; font-weight:normal;border-bottom:1pt solid black"
                                align="center">
                                {{ $transaction->performed_by ?? '' }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td align="center" scope="col" style="font-size:12px;"><strong>Number of dose(s):</strong>
                        </td>
                        <td align="center" colspan="2" scope="col"
                            style="border-bottom:1pt solid black; font-size:12px;">
                            {{ count($transactions) }}
                        </td>
                        <td scope="col">&nbsp;</td>
                        <td colspan="3" align="left" scope="col" style="font-size:12px;">&nbsp;</td>
                        <td colspan="3" scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right" scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td colspan="3" align="left" scope="col" style="font-size:12px;"><strong>Checked
                                by:</strong></td>
                        <td colspan="3" scope="col"
                            style="font-size:12px; font-weight:normal;border-bottom:1pt solid black" align="center">
                            &nbsp;
                        </td>
                    </tr>
                </table>

                @if ($transaction->asset_id < 4)
                    <table width="99%" border="0" align="center">
                        <tr>
                            <th scope="col">
                                <table width="30%" border="1" align="left" cellspacing="0"
                                    style="font-size:12px;">
                                    <tr>
                                        <td colspan="2" align="center" scope="col"><strong>LEAD
                                                CONTAINER</strong>
                                        </td>
                                        <td width="39%" align="center" scope="col"><strong>QUANTITY</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="31%" align="left" scope="col"><strong>Red</strong></td>
                                        <td width="30%" align="left" scope="col"><strong>(R)</strong></td>
                                        <td scope="col" align="center">{{ $countWithR }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left" scope="col"><strong> Blue</strong></td>
                                        <td align="left" scope="col"><strong>(B)</strong></td>
                                        <td scope="col" align="center">{{ $countWithB }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left" scope="col"><strong>Silver</strong></td>
                                        <td align="left" scope="col"><strong>(S)</strong></td>
                                        <td scope="col" align="center">{{ $countWithS }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left" scope="col"><strong>Gray</strong></td>
                                        <td align="left" scope="col"><strong>(Gy)</strong></td>
                                        <td scope="col" align="center">{{ $countWithG }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left" scope="col"><strong>Orange</strong></td>
                                        <td align="left" scope="col"><strong>(O)</strong></td>
                                        <td scope="col" align="center">{{ $countWithO }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center" scope="col"><strong><br />
                                                No. of TC Bag/s</strong><br />
                                            <br />
                                        </td>
                                        <td scope="col"><strong>
                                            </strong></td>
                                    </tr>
                                </table>
                                <table width="59%" align="right" cellspacing="0"
                                    style="border-collapse:collapse;">
                                    <tr>
                                        <td width="195" style="font-size:12px;" scope="col">&nbsp;</td>
                                        <td width="361" style="font-size:12px;" scope="col">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col"><strong>Packing
                                                List
                                                Prepared
                                                by:</strong></td>
                                        <td scope="col"
                                            style="font-size:12px; font-weight:normal;border-bottom:1pt solid black"
                                            align="center">
                                            {{ auth()->user()->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col"><strong>Delivered
                                                by:</strong>
                                        </td>
                                        <td align="center" scope="col"
                                            style="font-size:12px; font-weight:bold; border-bottom:1pt solid black">
                                            {{-- DELIVERY BY --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col"><strong>Received
                                                by:</strong>
                                        </td>
                                        <td scope="col" style="font-size:12px;  border-bottom:1pt solid black">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                                <br />
                            </th>
                        </tr>
                    </table>
                @else
                    <table width="99%" border="0" align="center">
                        <tr>
                            <th scope="col">
                                <table width="59%" align="right" cellspacing="0"
                                    style="border-collapse:collapse;">
                                    <tr>
                                        <td width="195" style="font-size:12px;" scope="col">&nbsp;</td>
                                        <td width="361" style="font-size:12px;" scope="col">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col"><strong>Packing
                                                List
                                                Prepared
                                                by:</strong></td>
                                        <td scope="col"
                                            style="font-size:12px; font-weight:normal;border-bottom:1pt solid black"
                                            align="center">
                                            {{ auth()->user()->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col"><strong>Delivered
                                                by:</strong>
                                        </td>
                                        <td align="center" scope="col"
                                            style="font-size:12px; font-weight:bold; border-bottom:1pt solid black">
                                            {{-- DELIVERY BY --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                                        <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="font-size:12px;" scope="col"><strong>Received
                                                by:</strong>
                                        </td>
                                        <td scope="col" style="font-size:12px;  border-bottom:1pt solid black">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                                <br />
                            </th>
                        </tr>
                    </table>
                @endif
            @else
                <p align="center" style="font-size:14px;"><strong>RADIOACTIVE MATERIAL, TYPE A PACKAGE, NORMAL FROM,
                        CLASS 7, U.N. 2915</strong><br /><br />
                <table width="98%" border="0" align="center" cellspacing="0">
                    <tr>
                        <td width="19%" align="left" scope="col" style="font-size:12px;"></td>
                        <td align="center" colspan="2"></td>
                        <td width="13%" align="left" scope="col" style="font-size:12px;"></td>
                        <td width="4%" align="left" scope="col">&nbsp;</td>
                        <td width="8%" scope="col">&nbsp;</td>
                        <td width="9%" scope="col">&nbsp;</td>
                        <td width="23%" scope="col">&nbsp;</td>
                        <td width="7%" scope="col">&nbsp;</td>
                        <td width="8%" scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" scope="col">&nbsp;</td>
                        <td width="4%" scope="col">&nbsp;</td>
                        <td width="5%" scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td colspan="3" align="left" scope="col" style="font-size:12px;"><strong>Date
                                Dispensed:</strong></td>
                        <td colspan="3" scope="col" style="font-size:12px; border-bottom:1pt solid black"
                            align="center"><strong>
                                @php
                                    $dateString = "$transaction->calibration_date";
                                    $timestamp = strtotime($dateString);
                                    $formattedDate = date('l, F j, Y', $timestamp);
                                    echo $formattedDate;
                                @endphp
                            </strong></td>
                    </tr>
                    <tr>
                        <td align="left" scope="col" style="font-size:12px;"><strong>Number of dose(s):</strong>
                        </td>
                        <td align="center" colspan="2" scope="col" style="border-bottom:1pt solid black">
                            {{ count($transactions) }}
                        </td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right" scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td colspan="3" align="left" scope="col" style="font-size:12px;"><strong>Performed
                                by:</strong></td>
                        <td colspan="3" scope="col" style="font-size:12px; border-bottom:1pt solid black"
                            align="center">

                        </td>
                    </tr>

                </table>
                <table width="99%" border="0" align="center">
                    <tr>
                        <th scope="col">
                            <table width="30%" border="1" align="left" cellspacing="0"
                                style="font-size:12px;">
                                <tr>
                                    <td colspan="2" align="center" scope="col"><strong>LEAD CONTAINER</strong>
                                    </td>
                                    <td width="39%" align="center" scope="col"><strong>QUANTITY</strong></td>
                                </tr>
                                <tr>
                                    <td width="31%" align="left" scope="col"><strong>Yellow</strong></td>
                                    <td width="30%" align="left" scope="col"><strong>(Y)</strong></td>
                                    <td scope="col" align="center">{{ $countWithY }}</td>
                                </tr>
                                <tr>
                                    <td align="left" scope="col"><strong>Big Blue</strong></td>
                                    <td align="left" scope="col"><strong>(BB)</strong></td>
                                    <td scope="col" align="center">{{ $countWithBB }}</td>
                                </tr>
                                <tr>
                                    <td align="left" scope="col"><strong>Small Blue</strong></td>
                                    <td align="left" scope="col"><strong>(SB)</strong></td>
                                    <td scope="col" align="center">{{ $countWithSB }}</td>
                                </tr>
                                <tr>
                                    <td align="left" scope="col"><strong>Purple</strong></td>
                                    <td align="left" scope="col"><strong>(P)</strong></td>
                                    <td scope="col" align="center">{{ $countWithP }}</td>
                                </tr>
                                <tr>
                                    <td align="left" scope="col"><strong>Green</strong></td>
                                    <td align="left" scope="col"><strong>(G)</strong></td>
                                    <td scope="col" align="center">{{ $countWithG }}</td>
                                </tr>
                                <tr>
                                    <td align="left" scope="col"><strong>Orange</strong></td>
                                    <td align="left" scope="col"><strong>(O)</strong></td>
                                    <td scope="col" align="center">{{ $countWithO }}</td>
                                </tr>
                                <tr>
                                    <td align="left" scope="col"><strong>White</strong></td>
                                    <td align="left" scope="col"><strong>(W)</strong></td>
                                    <td scope="col" align="center">{{ $countWithW }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" scope="col"><strong><br />
                                            RAM CAN NUMBER</strong><br />
                                        <br />
                                    </td>
                                    <td scope="col"><strong>
                                            {{-- RAM CAN --}}
                                        </strong></td>
                                </tr>
                            </table>
                            <table width="59%&quot;" border="0" align="right" cellspacing="0">
                                <tr>
                                    <td width="195" style="font-size:12px;" scope="col">&nbsp;</td>
                                    <td width="361" style="font-size:12px;" scope="col">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td scope="col" style="font-size:12px;">&nbsp;</td>
                                    <td scope="col" style="font-size:12px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:12px;" scope="col"><strong>Packing List
                                            Prepared by:</strong></td>
                                    <td scope="col"
                                        style="font-size:12px; font-weight:normal;border-bottom:1pt solid black"
                                        align="center"></td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                                    <td scope="col" style="font-size:12px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:12px;" scope="col"><strong>Delivered
                                            by:</strong></td>
                                    <td align="center" scope="col"
                                        style="font-size:12px; font-weight:normal; border-bottom:1pt solid black"><span
                                            style="font-size:12px; font-weight:normal; border-bottom:1pt solid black">

                                        </span></td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                                    <td scope="col" style="font-size:12px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:12px;" scope="col"><strong>Received
                                            by:</strong></td>
                                    <td scope="col" style="font-size:12px;  border-bottom:1pt solid black">&nbsp;
                                    </td>
                                </tr>
                            </table>
            @endif
        @endif



    </div>
</div>
