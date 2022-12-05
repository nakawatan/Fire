

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

        </style>
        </head>
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