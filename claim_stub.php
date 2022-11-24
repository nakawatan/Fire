

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