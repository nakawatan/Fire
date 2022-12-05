

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require 'include/dompdf/autoload.inc.php';
    require 'classes/record.php';
    require 'classes/occupancy_docs.php';
    require 'classes/new_business_doc.php';
    require 'classes/renewal_business_doc.php';
    $record = new Record();
    $id = $_REQUEST['id'];
    $record->id = $id;
    $record->get_record();

    $imagedata = file_get_contents("admin/img/bfp.png");
             // alternatively specify an URL, if PHP settings allow
    $base64 = "data:image/png;base64,".base64_encode($imagedata);

    $app_num = $record->appnum;
    $n_owner = $record->nowner;
    $es_name = $record->esname;
    $address = $record->address;
    $author = $record->author;
    $b_nature = $record->bnature;
    $area = $record->area;
    $contact = $record->contact;
    $email = $record->email;
    $no_of_storey = $record->no_of_storey;

    $occupancy = "";
    $new_business = "";
    $renew_business = "";
    $occupancy_docs = [];
    $new_docs = [];
    $renewal_docs = [];

    if ($record->type==1){
        $occupancy = "checked";

        $occupancy_docs = [];
        $occupancyDocs = new OccupancyDocs();
        $occupancyDocs->record_id = $record->id;
        $occupancyDoc = $occupancyDocs->get_records();
        $occupancyDoc = $occupancyDoc[0];

        if ($occupancyDoc['obo_endoursement'] != ""){
            $occupancy_docs[] = "x";
        }else {
            $occupancy_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['certificate_of_completion'] != ""){
            $occupancy_docs[] = "x";
        }else {
            $occupancy_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['assessment_fee'] != ""){
            $occupancy_docs[] = "x";
        }else {
            $occupancy_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['as_built_plan'] != ""){
            $occupancy_docs[] = "x";
        }else {
            $occupancy_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['fsccr'] != ""){
            $occupancy_docs[] = "x";
        }else {
            $occupancy_docs[] = "&nbsp;";
        }

        $new_docs = ['&nbsp;','&nbsp;','&nbsp;','&nbsp;'];
        $renewal_docs = ['&nbsp;','&nbsp;','&nbsp;','&nbsp;'];

    }else if ($record->type == 2){
        $new_business="checked";

        $occupancyDocs = new NewBusinessDoc();
        $occupancyDocs->record_id = $record->id;
        $occupancyDoc = $occupancyDocs->get_records();
        $occupancyDoc = $occupancyDoc[0];

        if ($occupancyDoc['certificate_of_occupancy'] != ""){
            $new_docs[] = "x";
        }else {
            $new_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['business_permit_fee'] != ""){
            $new_docs[] = "x";
        }else {
            $new_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['appidavit_of_undertaking'] != ""){
            $new_docs[] = "x";
        }else {
            $new_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['fire_insurance'] != ""){
            $new_docs[] = "x";
        }else {
            $new_docs[] = "&nbsp;";
        }

        $occupancy_docs = ['&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;'];
        $renewal_docs = ['&nbsp;','&nbsp;','&nbsp;','&nbsp;'];

    }else {
        $renew_business="checked";

        $occupancyDocs = new RenewalBusinessDoc();
        $occupancyDocs->record_id = $record->id;
        $occupancyDoc = $occupancyDocs->get_records();
        $occupancyDoc = $occupancyDoc[0];

        if ($occupancyDoc['business_permit_fee'] != ""){
            $renewal_docs[] = "x";
        }else {
            $renewal_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['fire_insurance'] != ""){
            $renewal_docs[] = "x";
        }else {
            $renewal_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['fsmr'] != ""){
            $renewal_docs[] = "x";
        }else {
            $renewal_docs[] = "&nbsp;";
        }

        if ($occupancyDoc['fire_safety_clearance'] != ""){
            $renewal_docs[] = "x";
        }else {
            $renewal_docs[] = "&nbsp;";
        }

        $occupancy_docs = ['&nbsp;','&nbsp;','&nbsp;','&nbsp;','&nbsp;'];
        $new_docs = ['&nbsp;','&nbsp;','&nbsp;','&nbsp;'];
    }


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

        .font-10 {
            font-size:10px;
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
                        <h1 style='font-size:60px; color:#910000; padding:0px; margin:0px;'>FSIC</h1>
</p>
                    <p>
                        APPLICATION NUMBER
</p>
                    <p>
                        <table>
                            <tr>
                                <td class='app-number'>${app_num}</td>
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
    <td class='border-left border-top'>NAME OF OWNER</td>
    <td class='border-left border-top'>${n_owner}</td>
    </tr>

    <tr>
    <td class='border-left border-top'>BUILDING/FACILITY/STRUCTURE/BUSINESS/ESTABLISHMENT NAME</td>
    <td class='border-left border-top'>${es_name}</td>
    </tr>

    <tr>
    <td class='border-left border-top'>EXACT ADDRESS</td>
    <td class='border-left border-top'>${address}</td>
    </tr>

    <tr>
    <td class='border-left border-top'>AUTHORIZED REPRESENTATIVE</td>
    <td class='border-left border-top'>${author}</td>
    </tr>

    <tr>
    <td class='border-left border-top'>TYPE OF OCCUPANCY/BUSINESS NATURE</td>
    <td class='border-left border-top'>${b_nature}</td>
    </tr>

    <tr>
    <td class='border-left border-top'>TOTAL FLOOR AREA (M2):${area}</td>
    <td class='border-left border-top'>NO. OF STOREY:${no_of_storey}</td>
    </tr>

    <tr>
    <td class='border-left border-top'>CONTACT NUMBER:${contact}</td>
    <td class='border-left border-top'>EMAIL ADDRESS:${email}</td>
    </tr>
    </table>
    <table>
    <tr style='border:1px solid black;background-color:#910000;color:white;text-align:center;font-weight:bold'>
    <td><i>ATTACHED DOCUMENTARY REQUIREMENTS</i></td>
    </tr>
    <tr style='border:1px solid black;background-color:#958f8f;text-align:center;font-weight:bold'>
    <td><input type='checkbox' ${occupancy}> FSIC FOR CERTIFICATE OF OCCUPANCY</td>
    </tr>
    <tr class='font-8'>
    <td>[${occupancy_docs[0]}]ENDOURSEMENT FROM OFFICE OF THE BUILDING OFFICIAL</td>
    </tr>
    <tr class='font-8'>
    <td>[${occupancy_docs[1]}]CERTIFICATE OF COMPLETION</td>
    </tr>
    <tr class='font-8'>
    <td class='font-8'>[${occupancy_docs[2]}]CERTIFIED TRUE COPY OF ASSESSMENT FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO</td>
    </tr>
    <tr>
    <td class='font-8'>[${occupancy_docs[3]}]AS-BUILT PLAN (IF NECESSARY)</td>
    </tr>
    <tr>
    <td class='font-8'>[${occupancy_docs[4]}]ONE(1) SET OF FIRE SAFETY COMPLIANCE AND COMMISIONING REPORT(FSCCR) (IF NECESSARY)</td>
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
            <td colspan='1'><input type='checkbox' ${new_business}> For NEW BUSINESS</td>
            <td colspan='1'><input type='checkbox' ${renew_business}> FOR RENEWAL OF BUSINESS</td>
        </tr>
        </thead>
        <tbody>
        <tr colspan='2'>
        <td>
            <table>
                <tr class='font-8'>
                    <td>[${new_docs[0]}]CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY</td>
                </tr>
                <tr class='font-8'>
                    <td>[${new_docs[1]}]ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</td>
                </tr>
                <tr class='font-8'>
                <td>[${new_docs[2]}]AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANCIAL CHANGES MADE ON BUILDING/ESTABLISHMENT</td>
                </tr>
                <tr class='font-8'>
                    <td>[${new_docs[3]}]COPY OF FIRE INSURANCE (IF NECESSARY)</td>
                </tr>
            </table>
        </td>

        <td>
            <table>
                <tr class='font-8'>
                    <td>[${renewal_docs[0]}]ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO</td>
                </tr>
                <tr class='font-8'>
                    <td>[${renewal_docs[1]}]COPY OF FIRE INSURANCE (IF NECESSARY)</td>
                </tr>
                <tr class='font-8'>
                    <td>[${renewal_docs[2]}]ONE(1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR) (IF NECESSARY)</td>
                </tr>
                <tr class='font-8'>
                    <td>[${renewal_docs[3]}]FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS(IF REQUIRED)</td>
                </tr>
            </table>
        </td>
    </tr>
        </tbody>   
        <tfoot>
            <tr>
                <td class='font-8'><i><b>NOTE:</b> Incomplete documentary requirements will be returned to the applicant.</i></td>
                <td></td>
            </tr>
            <tr class='font-10' style='text-align:center;'>
                <td colspan='2'>I hereby certify the correctness of the information provided above and the completeness of the attached documents.</td>
            </tr>
            <tr style='border-right:1px solid black;'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr style='border-right:1px solid black;'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr style='text-align:center;'>
                <td><p style='text-decoration:overline'>OWNER/AUTHORIZED REPRESENTATIVE’S SIGNATURE OVER PRINTED NAME</p></td>
                <td><p style='text-decoration:overline'>DATE</p></td>
            </tr>
            <tr style='border-right:1px solid black;'>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td><b>VERIFIED BY BFP-CRO: </b></td>
            <td style='text-align:center'><p style='text-decoration:overline'>DATE/TIME</p></td>
            </tr>

            <tr style='border:1px solid black;background-color:#910000;color:white;text-align:center;font-weight:bold'>
            <td colspan='2'><i>FSIC MONITORING (TO BE FILLED-UP BY BFP PERSONNEL ONLY)</i></td>
            </tr>
        </tfoot> 
    </table>
    <table  style='table-layout: fixed ; width:100%'>
        <tr>
            <td class='border-left'>CRO</td>    
            <td class='border-left'>FCA</td>
            <td class='border-left'>FCCA</td>
            <td class='border-left'>C,FSES</td>
            <td class='border-left'>FSI</td>
            <td class='border-left'>C,FCES</td>
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
                        <h1 style='font-size:60px; padding:0px; margin:0px;color:#910000;'>FSIC</h1>
</p>
                    <p>
                        APPLICATION NUMBER
</p>
                    <p>
                        <table>
                            <tr>
                                <td class='app-number'>${app_num}</td>
                            </tr>   
                        </table>
                    </p>
                </div>
            </td>
        </tr>
    </table>
    </br>
        <div style='text-align:center'>
            <span style='background-color: grey;'>CLAIM STUB <label style='color:red;'></label></span>
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
        <div class='font-8'>
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