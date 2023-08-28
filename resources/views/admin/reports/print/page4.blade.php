<link href="{{ asset('css/frame.css') }}" rel="stylesheet" type="text/css" />
<div class="container">
    <div class="content">
        <table width="90%" border="0" align="center" style="margin-top:-50px;">
            <tr><br /><br /><br /><br />
                <td width="10%" align="center" scope="col" valign="top"><img src="{{ asset('img/act.png') }}"
                        width="120" height="89" /></td>
                <td width="82%" align="left"
                    style="font-size:18px; color:#03f; font-weight:bold; font-style:italic" scope="col">
                    <b>&nbsp;&nbsp; Assurance Controls Technologies Co., Inc.
                        </style>
                    </b><br />
                    <p style="font-size:12px;color:#000; font-weight:normal; font-style:normal"><i>Office: 1710
                        Annapolis
                        Wilshire Plaza, #11 Annapolis St., Greenhills, San Juan, Metro Manila 1502,
                        Philippines</b><br />
                        Laboratory: 42 Montreal Street, Brgy E. Rodriguez Sr., Cubao, Quezon City, Philippines<br />
                        Office Tel. No.: +63-2-724-4149, 724-4150, 722-4580, 722-4588 Fax No.: 723-1742</b><br />
                        Laboratory Tel. No.: +63-2-8709-0185, 8292-5570, Telefax no: 8529-9311<br />
                        </i></p>
                </td>
            </tr>
        </table><br />
        <p style="font-family: Calibri;">
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td colspan="5" align="center" scope="col"><strong>
                        <span style="font-size:16px;"><u>CONSIGNOR'S DECLARATION FOR THE TRANSPORT OF RADIOACTIVE
                            MATERIAL</u></span></strong></td>
            </tr>
            <tr>
                <td width="91" align="center" scope="col">&nbsp;</td>
                <td colspan="2" align="center" scope="col">&nbsp;</td>
                <td width="110" align="left" scope="col">Date of Issue:</td>
                <td width="140" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        DATE OF ISSUE

                    </strong></td>
            </tr>
            <tr>
                <td align="center" scope="col">&nbsp;</td>
                <td colspan="2" align="center" scope="col">&nbsp;</td>
                <td align="left" scope="col">Expiry Date:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        {{ $transaction->expiry_date ?? '' }}
                    </strong></td>
            </tr>
            <tr>
                <td align="center" scope="col">&nbsp;</td>
                <td colspan="2" align="center" scope="col">&nbsp;</td>
                <td align="left" scope="col">&nbsp;</td>
                <td align="center" scope="col">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" scope="col">CONSIGNOR:</td>
                <td colspan="2" align="left" scope="col" style="border-bottom:1pt solid black"><strong>ASSURANCE
                        CONTROLS TECHNOLOGIES CO., INC.</strong></td>
                <td align="left" scope="col">License Number:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        LICENSE NO
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="11%">ADDRESS:</td>
                <td colspan="2" align="left" scope="col" style="border-bottom:1pt solid black"><strong>
                        ADDRESS
                    </strong></td>
                <td width="110" align="left" scope="col">Expiry Date:</td>
                <td width="140" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        EXPIRY
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="34%">RADIATION PROTECTION OFFICER (RPO):</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        RHSO
                    </strong></td>
                <td width="110" align="left" scope="col"> Tel/Fax No.:</td>
                <td width="140" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong> (02) 5299311</strong>
                </td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="47%" align="left">CONSIGNOR'S REPRESENTATIVE(S) / PACKAGE ESCORT(S):</td>
                <td colspan="3" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        REP
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="28%" align="left">LOCATION/ADDRESS OF ORIGIN:</td>
                <td width="74%" align="center" style="border-bottom:1pt solid black"><strong>
                        ADDRESS
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td align="center"><strong><u>DESCRIPTION OF RADIOACTIVE MATERIAL/PACKAGE TO BE
                            TRANSPORTED</strong></u></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="13%">RADMAT TYPE:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong> Iodine-131</strong></td>
                <td width="20%">CATEGORY OF PACKAGE:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>TYPE A YELLOW II</strong></td>
                <td width="17%">SURFACE DOSERATE:</td>
                <td width="50px"align="center" style="border-bottom:1pt solid black"><strong>9</strong></td>
                <td><strong>mr/hr</strong></td>
            </tr>
            <tr>
                <td width="13%">FORM:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong> CAPSULE</strong></td>
                <td width="20%">UN NUMBER:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>UN 2915</strong></td>
                <td width="17%">DOSERATE @ 1M:</td>
                <td width="50px"align="center" style="border-bottom:1pt solid black"><strong>0.4</strong></td>
                <td><strong>mr/hr</strong></td>
            </tr>
            <tr>
                <td width="13%">ACTIVITY:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong> 555 MBq</strong></td>
                <td width="20%">PACKAGE DESCRIPTION:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>RAM CAN</strong></td>
                <td width="17%">TRANSPORT INDEX:</td>
                <td width="50px"align="center" style="border-bottom:1pt solid black"><strong>0.4</strong></td>
                <td><strong></strong></td>
            </tr>
            <tr>
                <td width="13%">RX NUMBER:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>IC-00001-2023</strong></td>
                <td width="20%">DIMENSION:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>15.5 x 18 x 29 cm</strong></td>
                <td width="17%">SWIPE TEST RESULT:</td>
                <td width="50px"align="center" style="border-bottom:1pt solid black"><strong>Passed</strong></td>
                <td><strong></strong></td>
            </tr>
            <tr>
                <td width="13%"></td>
                <td></td>
                <td width="20%">PACKAGE CONDITION:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>Good and Intact</strong></td>
            </tr>
        </table>

        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="18%">SURVEY INSTRUMENT:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>Ludium 14C</strong></td>
                <td width="14%">SERIAL NUMBER:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>230180</strong></td>
                <td width="17%">CALIBRATION DATE:</td>
                <td width="80px"align="center" style="border-bottom:1pt solid black"><strong>2023-08-29</strong>
                </td>
            </tr>
        </table>
        <BR />
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="18%">CONSIGNEE/LICENSEE:</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        UNIVERSITY OF SANTO TOMAS HSPITAL (UST-MANILA)
                    </strong></td>
                <td width="120" align="left" scope="col"> LICENSE NUMBER:</td>
                <td width="129" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong> M16.21015.22</strong>
                </td>
            </tr>
            <tr>
                <td width="14%">DEPARTMENT:</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        DEPARTMENT OF NUCLEAR MEDICINE
                    </strong></td>
                <td width="120" align="left" scope="col"> EXPIRY DATE:</td>
                <td width="129" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong> 2023-05-31</strong>
                </td>
            </tr>
            <tr>
                <td width="14%">ADDRESS:</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        ESPANA BOULEVARD MANILA
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="34%">RADIATION PROTECTION OFFICER (RPO):</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        Jean Hazel P. Reyes
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="44%">CONSIGNEE'S REPRESENTATIVE(S)/PACKAGE ESCORT(S):</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        Jean Hazel P. Reyes
                    </strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="34%">LOCATION/ADDRESS OF DESTINATION:</td>
                <td colspan="2" align="center" scope="col" style="border-bottom:1pt solid black"><strong>
                        ESPANA BOULEVARD MANILA
                    </strong></td>
            </tr>
        </table><br />
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="35%" align="center"><u><strong>TRANSPORT CONVEYANCE</strong></u></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="17%"><b>LAND TRANSPORT:<b></td>
            </tr>
            <tr>
                <td></td>
                <td width="16%">COMPANY OWNED:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>YES</strong></td>
                <td width="18%">VEHICLE TYPE/MODEL:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>SUZUKI/APV</strong>
                </td>
                <td width="9%">PLATE NO:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>NIE3325</strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="17%"></td>
                <td width="5%">ETD:</td>
                <td width="29%"align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
                <td width="5%">ETA:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>&nbsp;</strong></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="17%"><b>AIR TRANSPORT:<b></td>
            </tr>
            <tr>
                <td></td>
                <td width="6%">AIRLINE:</td>
                <td width="27%" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
                <td width="5%">ETA:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>&nbsp;</strong></td>
                <td width="5%">ETD:</td>
                <td width="128px" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="17%"><b>SEA TRANSPORT:<b></td>
            </tr>
        </table>
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="17%"></td>
                <td width="7%">VESSEL:</td>
                <td width="25%" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
                <td width="7%">RIGGING:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>&nbsp;</strong></td>
                <td width="5%">ETD:</td>
                <td width="127px"align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td width="17%"></td>
                <td width="7%">STOWAGE:</td>
                <td width="25%" align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
                <td width="7%">PLACARDS:</td>
                <td align="center" scope="col" style="border-bottom:1pt solid black"><strong>&nbsp;</strong></td>
                <td width="5%">ETA:</td>
                <td width="127px"align="center" scope="col" style="border-bottom:1pt solid black">
                    <strong>&nbsp;</strong>
                </td>
            </tr>
        </table>
        <br />
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td align="center"><b><u>DECLARATION</u><b></td>
            </tr>
        </table>
        <table width="92%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="3px"></td>
                </td>
                <td width="642" align="center"><strong><i>&quot;I hereby declare that the content/s of this
                            consignment is/are fully and
                            accurately described above by the proper shipping name and classified, packaged, marked and
                            labeled/placard, and is/are in all respect in proper condition for the safe transport of
                            RADIOACTIVE MATERIALS in accordance with PNRI regulation and applicable national
                            governmental
                            regulation.&quot;</i></strong></td>
                <td width="3px"></td>

            </tr>
        </table>
        <br />
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td width="18%">PACKAGE INSPECTOR:</td>
                <td width="28%" align="center" style="border-bottom:1pt solid black"><strong>
                        PACKAGE INSPECTOR
                    </strong></td>
                <td width="18%" align="right">APPROVED BY:</td>
                <td align="center" style="border-bottom:1pt solid black"><strong>
                        APPROVED BY
                    </strong></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center"><strong>
                        TITLE
                    </strong></td>
                <td align="center">&nbsp;</td>
            </tr>
        </table>
        <br />
        <table width="90%" border="0" align="center" cellspacing="0">
            <tr>
                <td align="right" style="font-size:10px;">
                    ACT-LAB-F044-112017_Rev.1
                </td>
            </tr>
        </table>
        </p>
    </div>
</div>
