<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="content">

        <table width="100%" border="0" align="center">
            <tr><br /><br /><br /><br /><br />
                <td scope="col" align="center" style="font-size:18px;"><b>ASSURANCE CONTROLS TECHNOLOGIES CO., INC.
                        </style></b><br />
                    <p style="font-size:14px;">42 Montreal Street, Brgy E. Rodriguez Sr., Cubao, Quezon City,
                        Philippines<br />
                        Tel no: (02) 8709-0185, (02) 8292-5570, Telefax no: (02) 8529-9311<br />Email:
                        info@assurancecontrols.com
                </td>
            </tr>
        </table><br />

        <table width="95%" border="1" align="center" cellspacing="0">
            <tr>
                <td colspan="7" align="center" scope="col"><strong>
                        <p style="font-size:16px;">SHIPPER
                    </strong></td>
                <td colspan="6" align="center" scope="col"><strong><span
                            style="font-size:16px;">CONSIGNEE</span></strong></td>
            </tr>
            <tr>
                <td colspan="7" rowspan="2" align="center"><strong>
                        <p style="font-size:16px;">ASSURANCE CONTROLS TECHNOLOGIES
                        <p style="font-size:12px;"> Diliman, Quezon City
                    </strong></td>
                <td colspan="6" align="center"><span style="font-size:16px;"><b><br />
                            {{ $transaction->hospital->hospital ?? '' }}
                            <br />
                            <br />
                            {{ $transaction->calibration_date ?? '' }}
                    </span></td>
            </tr>
            <tr>
                <td align="center" style="font-size:12px; "><strong>RUN NO.:</strong></td>
                <td align="center" style="font-size:12px; "><strong>
                        {{ $transaction->run_no ?? '' }}
                    </strong></td>
                <td colspan="4" align="center" style="font-size:12px; "><strong>DELIVERY</strong></td>
            </tr>
            @php
                $specificTransaction = $transactions->get(1);
            @endphp
            @if ($specificTransaction->asset_id != 2)
                <tr>
                    <td width="85" rowspan="2" align="center"><strong>ORDER<br /> FORM NUMBER</strong></td>
                    <td width="66" rowspan="2" align="center"><strong>PRODUCT</strong></td>
                    <td width="80" rowspan="2" align="center"><strong>RX NO.</strong></td>
                    <td width="42" rowspan="2" align="center"><strong>LOT #</strong></td>
                    <td width="65" rowspan="2" align="center"><strong>LEAD<br /> PIG</strong></td>
                    <td width="126" rowspan="2" align="center"><strong>PROCEDURE</strong></td>
                    <td width="136" rowspan="2" align="center"><strong>PATIENT'S NAME</strong></td>
                    <td width="61" rowspan="2" align="center"><strong> CAL<br /> TIME</strong></td>
                    <td colspan="2" align="center"><strong>ORDER<br /> DOSE</strong></td>
                    <td colspan="2" align="center"><strong>ACTUAL<br /> DOSE</strong></td>
                </tr>
                <tr>
                    <td width="47" align="center"><strong>mCi</strong></td>
                    <td width="46" align="center"><strong>MBq</strong></td>
                    <td width="48" align="center"><strong>mCi</strong></td>
                    <td width="50" align="center"><strong>MBq</strong></td>
                </tr>

                @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td align="center">{{ $transaction->orderform_no ?? '' }}</td>
                        <td align="center">{{ $transaction->asset_product->product_name ?? '' }}</td>
                        <td width="57" align="center">{{ $transaction->rx_no ?? '' }}</td>
                        <td align="center">{{ $transaction->lot_no ?? '' }}</td>
                        <td align="center">{{ $transaction->lead_pot ?? '' }}</td>
                        <td align="center">{{ $transaction->procedure1 ?? '' }}</td>
                        <td align="center">{{ $transaction->patient ?? '' }}</td>
                        <td align="center">{{ $transaction->calibration_time ?? '' }}</td>
                        <td align="center">{{ $transaction->activity_mci ?? '' }}</td>
                        <td align="center" style="font-size:12px; color:#f00; ">
                            <strong>{{ $transaction->activity_mbq ?? '' }}</strong>
                        </td>
                        <td align="center">{{ $transaction->actual_dose ?? '' }}</td>
                        <td align="center" style="font-size:12px; color:#f00; ">
                            <strong>{{ $transaction->actual_mbq ?? '' }}</strong>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td width="86" rowspan="2" align="center"><strong>ORDER<br /> FORM<br /> NUMBER</strong></td>
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

                @foreach ($transactions as $key => $transaction)
                <tr>
                    <td align="center">{{ $transaction->orderform_no ?? '' }}</td>
                    <td align="center">Iodine - 131</td>
                    <td width="56" align="center">{{ $transaction->rx_no ?? '' }}</td>
                    <td align="center">{{ $transaction->asset_product->product_name ?? '' }}</td>
                    <td align="center">{{ $transaction->lead_pot ?? '' }}</td>
                    <td align="center">{{ $transaction->patient ?? '' }}</td>
                    <td align="center">{{ $transaction->calibration_time ?? '' }}</td>
                    <td width="52" align="center">{{ $transaction->activity_mci ?? '' }}</td>
                    <td align="center" style="font-size:12px; color:#f00; "><strong>{{ $transaction->activity_mbq ?? '' }}</strong></td>
                    <td width="52" align="center">{{ $transaction->actual_dose ?? '' }}</td>
                    <td align="center" style="font-size:12px; color:#f00; "><strong>{{ $transaction->actual_mbq ?? '' }}</strong></td>
                </tr>
                @endforeach
            @endif
        </table><BR />
        <p align="center" style="font-size:14px;"><strong>RADIOACTIVE MATERIAL, TYPE A PACKAGE, NORMAL FROM, CLASS 7,
                U.N. 2915</strong><br /><br />
        <table width="98%" align="center" cellspacing="0" style="border-collapse:collapse;">
            <tr>
                <td width="19%" align="left" scope="col" style="font-size:12px;"><strong>Dose Rate @ 1
                        meter:</strong></td>
                <td colspan="2" scope="col" style="border-bottom:1pt solid black; font-size:12px;">
                    {{ $transaction->doserate_meter ?? '' }}
                </td>
                <td width="13%" align="left" scope="col" style="font-size:12px;"><strong>mr/hr
                        </th>
                    </strong>
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
                    align="center">{{ $transaction->calibration_date ?? '' }}</td>
            </tr>
            <tr>
                <td align="center" scope="col" style="font-size:12px;"><strong>Total Mo-99:</strong></td>
                <td colspan="2" scope="col" style="border-bottom:1pt solid black; font-size:12px;">
                    TOTAL
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
                <td align="center" scope="col" style="font-size:12px;"><strong>Mo-99/Tc99m:</strong></td>
                <td colspan="2" scope="col" style="border-bottom:1pt solid black; font-size:12px;">
                    TOTAL
                </td>
                <td scope="col">&nbsp;</td>
                <td colspan="3" align="left" scope="col" style="font-size:12px;"><strong>Performed
                        by:</strong></td>
                <td colspan="3" scope="col"
                    style="font-size:12px; font-weight:normal;border-bottom:1pt solid black" align="center">
                    {{ $transaction->performed_by ?? '' }}
                </td>
            </tr>
            <tr>
                <td align="center" scope="col" style="font-size:12px;"><strong>Number of dose(s):</strong></td>
                <td align="center" colspan="2" scope="col" style="border-bottom:1pt solid black">
                    COUNT</td>
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
                    style="font-size:12px; font-weight:normal;border-bottom:1pt solid black" align="center">&nbsp;
                </td>
            </tr>
        </table>
        <table width="99%" border="0" align="center">
            <tr>
                <th scope="col">
                    <table width="30%" border="1" align="left" cellspacing="0" style="font-size:12px;">
                        <tr>
                            <td colspan="2" align="center" scope="col"><strong>LEAD CONTAINER</strong></td>
                            <td width="39%" align="center" scope="col"><strong>QUANTITY</strong></td>
                        </tr>
                        <tr>
                            <td width="31%" align="left" scope="col"><strong>Red</strong></td>
                            <td width="30%" align="left" scope="col"><strong>(R)</strong></td>
                            <td scope="col"> QTY</td>
                        </tr>
                        <tr>
                            <td align="left" scope="col"><strong> Blue</strong></td>
                            <td align="left" scope="col"><strong>(B)</strong></td>
                            <td scope="col">QTY</td>
                        </tr>
                        <tr>
                            <td align="left" scope="col"><strong>Silver</strong></td>
                            <td align="left" scope="col"><strong>(S)</strong></td>
                            <td scope="col">QTY</td>
                        </tr>
                        <tr>
                            <td align="left" scope="col"><strong>Gray</strong></td>
                            <td align="left" scope="col"><strong>(Gy)</strong></td>
                            <td scope="col">QTY</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" scope="col"><strong><br />
                                    No. of TC Bag/s</strong><br />
                                <br />
                            </td>
                            <td scope="col"><strong>
                                    TC_BAG
                                </strong></td>
                        </tr>
                    </table>
                    <table width="59%" align="right" cellspacing="0" style="border-collapse:collapse;">
                        <tr>
                            <td width="195" style="font-size:12px;" scope="col">&nbsp;</td>
                            <td width="361" style="font-size:12px;" scope="col">&nbsp;</td>
                        </tr>
                        <tr>
                            <td scope="col" style="font-size:12px;">&nbsp;</td>
                            <td scope="col" style="font-size:12px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size:12px;" scope="col"><strong>Packing List Prepared
                                    by:</strong></td>
                            <td scope="col"
                                style="font-size:12px; font-weight:normal;border-bottom:1pt solid black"
                                align="center">CURRENT USER</td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:12px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size:12px;" scope="col"><strong>Delivered by:</strong>
                            </td>
                            <td align="center" scope="col"
                                style="font-size:12px; font-weight:bold; border-bottom:1pt solid black">
                                DELIVERY BY
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size:12px;" scope="col">&nbsp;</td>
                            <td scope="col" style="font-size:12px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size:12px;" scope="col"><strong>Received by:</strong>
                            </td>
                            <td scope="col" style="font-size:12px;  border-bottom:1pt solid black">&nbsp;</td>
                        </tr>
                    </table>
                    <p align="center" style="font-size:14px;"><br />
                    </p>
                    </blockquote>
                    </blockquote>
                    </blockquote>
                    <table align="center">
                        <tr>
                            <td>
                                <script type="text/javascript">
                                    function myPrint() {
                                        window.frames["myIframe"].focus();
                                        window.frames.print();
                                    }
                                </script>
                            </td>
                        </tr>
                    </table>
                    <br />
                </th>
            </tr>
        </table>

        <p align="right" style="font-size:10px;">ACT-LAB-F044-112017_Rev.0



    </div>
</div>
