

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require 'include/dompdf/autoload.inc.php';

    $imagedata = file_get_contents("admin/img/bfp.png");
             // alternatively specify an URL, if PHP settings allow
    $base64 = "data:image/png;base64,".base64_encode($imagedata);
    
    $content = "<head>
    <style>
        .center {
            text-align: center;
        }
        p{
            margin:0px;
        }
        .app-number{
            border: 3px solid black;
        }

        table, th {
            border: 1px solid black;
            margin:0px;
            padding:0px;
            border-collapse: collapse;
        }

        table{
            width:100%
        }

        .font-8 {
            font-size:8px;
        }

        .border-left {
            border-left:1px black solid;
            width:12.5px;
        }

        .border-top {
            border-top:1px black solid;
        }
        </style>
</head>
<body>
    <table>
        <tr>
            <td width='10%'><img src='${base64}' width='100px'></img></td>
            <td width='60%' css='text-align: center;'>
                <div class='center'>
                        <p style='font-size:40px'>BUREAU OF FIRE PROTECTION</p>
                        <p>Region)</p>
                        <p>(District/Provincial Office)</p>
                        <p>(Station)</p>
                        <p>(Station Address)</p>
                </div>
            </td>
            <td width='10%'>
                <div>
                    <p>
                        <h1 style='font-size:60px; padding:0px; margin:0px;'>FSIC</h1>
</p>
                    <p>
                        APPLICATION NUMBER
</p>
                    <p>
                        <table>
                            <tr>
                                <td class='app-number'>TESTAPP</td>
                            </tr>   
                        </table>
                    </p>
                </div>
            </td>
        </tr>
    </table>
    <div>
    <p>FIRE SAFETY INSPECTION CERTIFICATE APPLICATION FORM</p>
    <p>CHECK BOX OF CERTIFICATE APPLIED FOR</p>
    <table style='border:1px solid black'>
    <tr>
    <th>NAME OF OWNER</th>
    <th><th>
    </tr>
    <tr>
    <td>BUILDING/FACILITY/STRUCTURE/BUSINESS/ESTABLISHMENT NAME</td>
    <td></td>
    </tr>

    <tr>
    <td>EXACT ADDRESS</td>
    <td></td>
    </tr>

    <tr>
    <td>AUTHORIZED REPRESENTATIVE</td>
    <td></td>
    </tr>

    <tr>
    <td>TYPE OF OCCUPANCY/BUSINESS NATURE</td>
    <td></td>
    </tr>

    <tr>
    <td>TOTAL FLOOR AREA (M2)</td>
    <td>NO. OF STOREY:</td>
    </tr>

    <tr>
    <td>CONTACT NUMBER:</td>
    <td>EMAIL ADDRESS:</td>
    </tr>
    </table>
    <table>
    <tr style='border:1px solid black;background-color:#910000;color:white;text-align:center;font-weight:bold'>
    <td><i>ATTACHED DOCUMENTARY REQUIREMENTS</i></td>
    </tr>
    <tr style='border:1px solid black;background-color:#958f8f;text-align:center;font-weight:bold'>
    <td><input type='checkbox'> FSIC FOR CERTIFICATE OF OCCUPANCY</td>
    </tr>
    <tr class='font-8'>
    <td>[ ]ENDOURSEMENT FROM OFFICE OF THE BUILDING OFFICIAL</td>
    </tr>
    <tr class='font-8'>
    <td>[ ]CERTIFICATE OF COMPLETION</td>
    </tr>
    <tr class='font-8'>
    <td class='font-8'>[ ]CERTIFIED TRUE COPY OF ASSESSMENT FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO</td>
    </tr>
    <tr>
    <td class='font-8'>[ ]AS-BUILT PLAN (IF NECESSARY)</td>
    </tr>
    <tr>
    <td class='font-8'>[ ]ONE(1) SET OF FIRE SAFETY COMPLIANCE AND COMMISIONING REPORT(FSCCR) (IF NECESSARY)</td>
    </tr>
    </table>
    <table>
        <tr style='background-color:#958f8f;'>
        <th colspan='2'>FSIC FOR BUSINESS PERMIT</th>
        </tr>
    </table>
    <table style='table-layout: fixed ;'>
        <thead>
        <tr style='text-align: center;background-color:#958f8f;font-weight:bold'>
            <td colspan='1'><input type='checkbox'> For NEW BUSINESS</td>
            <td colspan='1'><input type='checkbox'> FOR RENEWAL OF BUSINESS</td>
        </tr>
        </thead>
        <tbody>
        <tr colspan='2'>
        <td>
            <table>
                <tr class='font-8'>
                    <td>[ ]CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY</td>
                </tr>
                <tr class='font-8'>
                    <td>[ ]ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</td>
                </tr>
                <tr class='font-8'>
                <td>[ ]AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANCIAL CHANGES MADE ON BUILDING/ESTABLISHMENT</td>
                </tr>
                <tr class='font-8'>
                    <td>[ ]COPY OF FIRE INSURANCE (IF NECESSARY)</td>
                </tr>
            </table>
        </td>

        <td>
            <table>
                <tr class='font-8'>
                    <td>[ ]ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</td>
                </tr>
                <tr class='font-8'>
                    <td>[ ]COPY OF FIRE INSURANCE (IF NECESSARY)</td>
                </tr>
                <tr class='font-8'>
                    <td>[ ]ONE(1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR) (IF NECESSARY)</td>
                </tr>
                <tr class='font-8'>
                    <td>[ ]FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS(IF REQUIRED)</td>
                </tr>
            </table>
        </td>
    </tr>
        </tbody>   
        <tfoot>
            <tr>
                <td><i><b>NOTE:</b> Incomplete documentary requirements will be returned to the applicant.</i></td>
            </tr>
            <tr>
                <td colspan='2'>I hereby certify the correctness of the information provided above and the completeness of the attached documents.</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr style='text-align:center;'>
                <td><p style='text-decoration:overline'>OWNER/AUTHORIZED REPRESENTATIVE’S SIGNATURE OVER PRINTED NAME</p></td>
                <td><p style='text-decoration:overline'>DATE</p></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td><b>VERIFIED BY BFP-CRO: </b></td>
            <td><p style='text-decoration:overline'>DATE/TIME</p></td>
            </tr>

            <tr style='border:1px solid black;background-color:#910000;color:white;text-align:center;font-weight:bold'>
            <td colspan='2'><i>FSIC MONITORING (TO BE FILLED-UP BY BFP PERSONNEL ONLY)</i></td>
            </tr>
            <tr>
                <table  style='table-layout: fixed ; width:100%'>
                    <tr>
                        <td class='border-left'>CRO</td>    
                        <td class='border-left'>FCA</td>
                        <td class='border-left'>FCCA</td>
                        <td class='border-left'>C,FSES</td>
                        <td class='border-left'>FSI</td>
                        <td class='border-left'>C>FCES</td>
                        <td class='border-left'>CFM,MFM</td>
                        <td class='border-left'>CRO</td>
                    </tr>
                    <tr>
                        <td class='border-left border-top'>DATE:</td>    
                        <td class='border-left border-top'>DATE:</td>
                        <td class='border-left border-top'>DATE:</td>
                        <td class='border-left border-top'>DATE:</td>
                        <td class='border-left border-top'>DATE:</td>
                        <td class='border-left border-top'>DATE:</td>
                        <td class='border-left border-top'>DATE:</td>
                        <td class='border-left border-top'>DATE:</td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>IN</td>
                                    <td class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>IN</td>
                                    <td  class='border-left border-top'>OUT</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td  class='border-left border-top'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    <td colspan='8' style='font-size:8px; color:red; text-align:center;'>PAALALA: “MAHIGPIT NA IPINAGBABAWAL NG PAMUNUAN NG BUREAU OF FIRE PROTECTION SA MGA KAWANI NITO ANG MAGBENTA O 
                    MAGREKOMENDA NG ANUMANG BRAND NG FIRE EXTINGUISHER”</td>
                    </tr>
                    <tr>
                    <td colspan='8' style='font-size:10px; color:blue; font-weight:bold; text-align:center;'>“FIRE SAFETY IS OUR MAIN CONCERN”</td>
                    </tr>
                </table
            </tr>
        </tfoot> 
    </table>
    </br>
    
    <table>
        <tr>
            <td width='10%'><img src='${base64}' width='100px'></img></td>
            <td width='60%' css='text-align: center;'>
                <div class='center'>
                        <p style='font-size:40px'>BUREAU OF FIRE PROTECTION</p>
                        <p>Region)</p>
                        <p>(District/Provincial Office)</p>
                        <p>(Station)</p>
                        <p>(Station Address)</p>
                </div>
            </td>
            <td width='10%'>
                <div>
                    <p>
                        <h1 style='font-size:60px; padding:0px; margin:0px;'>FSIC</h1>
</p>
                    <p>
                        APPLICATION NUMBER
</p>
                    <p>
                        <table>
                            <tr>
                                <td class='app-number'>TESTAPP</td>
                            </tr>   
                        </table>
                    </p>
                </div>
            </td>
        </tr>
    </table>
    </br>
        <div style='text-align:center'>
            <span style='background-color: grey;'>CLAIM STUB <label style='color:red;'>&#9654;</label></span>
        </div>
        <div>
        CERTIFIED BY:
        </div>
        </br>
        </br>
        <div>
        <span style='text-decoration:overline'>CUSTOMER RELATION OFFICER</span>
        <span style='text-decoration:overline; float:right;'>DATE</span>
        </div>
        <div>
        <i><b>NOTE:</b> AUTHORIZED REPRESENTATIVE MUST PRESENT AN AUTHORIZATION LETTER AND COPY OF OWNER’S IDENTIFICATION CARD</i>
        </div>
        <div style='font-size:8px; color:red; text-align:center;'>
        <i>PAALALA: “MAHIGPIT NA IPINAGBABAWAL NG PAMUNUAN NG BUREAU OF FIRE PROTECTION SA MGA KAWANI NITO ANG MAGBENTA O 
        MAGREKOMENDA NG ANUMANG BRAND NG FIRE EXTINGUISHER”<i/>
        </div>
        <div style='font-size:10px; color:blue; font-weight:bold; text-align:center;'>
        <i>“FIRE SAFETY IS OUR MAIN CONCERN”<i/>
        </div>
        <div style='background-color:#910000;width:100%'>
        &nbsp;
        </div>
        <div>
        BFP-QSF-FSED-002 REV.02 (08.24.20)
        </div>
    </div>
</body>";
        // echo ($content);
        // die();
    use Dompdf\Dompdf;
    use Dompdf\Options;

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    
   // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);
    
    $dompdf->loadHtml($content);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream('my.pdf',array('Attachment'=>0));