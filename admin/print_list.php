

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    require $root.'/include/dompdf/autoload.inc.php';
    require $root.'/classes/record.php';
    $record = new Record();
    $record->status = $_REQUEST['status'];
    $status = $record->status;
    $records = $record->get_records();
    $root = dirname(__FILE__, 2);

    $imagedata = file_get_contents($root."/admin/img/bfp.png");
             // alternatively specify an URL, if PHP settings allow
    $base64 = "data:image/png;base64,".base64_encode($imagedata);


    
    $table = "";
    foreach ($records as $data) {
        $table = $table."<tr>
            <td>${data['appnum']}</td>
            <td>${data['nowner']}</td>
            <td>${data['date']}</td>
            <td>${data['contact']}</td>
            <td>${data['address']}</td>
        </tr>
        ";
    }
    $content = "
        <head>
        <style>
        table, th,td {
            border: 1px solid black;
            margin:0px;
            padding:0px;
            border-collapse: collapse;
        }

        table{
            width:100%
        }

        .center {
            text-align: center;
        }
        p{
            margin:0px;
        }
        .app-number{
            border: 3px solid black;
        }

        // table, th {
        //     border: 1px solid black;
        //     margin:0px;
        //     padding:0px;
        //     border-collapse: collapse;
        // }

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
        <table style='border:none'>
        <tr>
            <td width='10%' style='border:none'><img src='${base64}' width='100px'></img></td>
            <td width='80%' style='border:none' css='text-align: center;'>
                <div class='center'>
                        <p>Republic of the Philippines</p>
                        <p>Department of the Interior and Local Government</p>
                        <p style='font-size:20px'>BUREAU OF FIRE PROTECTION</p>
                        <p>Region 4A (CALABARZON)</p>
                        <p>Batangas Province</p>
                        <p>Mabini Fire Station</p>
                        <p>Poblacion Mabini Batangas</p>
                        <p>(043) 425-3890</p>
                        <p>416mabinifirestation@gmail.com</p>
                </div>
            </td>
        </tr>
    </table>
        <h1>${status} List</h1>
        <table>
        <thead>
        <tr>
        <th>Application Number</th>
        <th>Name of Owner</th>
        <th>Date Approved</th>
        <th>Contact</th>
        <th>Address</th>
        </tr>
        </thead>
        <tbody>
        ${table}
        </tbody>
    </table>";
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