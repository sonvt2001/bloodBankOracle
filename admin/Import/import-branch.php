
<?php
session_start();
$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
require '../vendor/PhpOffice/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST["import"])) {
    $fileName = $_FILES["import_file"]["name"];    
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION)  ;                  
    $allowed_ext = ['xlsx'];
     
    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES["import_file"]["tmp_name"];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row)
        {
        
            $B_ID = $row['0'];
            $B_NAME = $row['1'];
            $ADDRESS= $row['2'];
            $AREA = $row['3'];
            $SUBAREA = $row['4'];
            $PHONE = $row['5'];
            $EMAIL = $row['6'];
    
            $query = "INSERT INTO BRANCH (B_ID, B_NAME, ADDRESS, AREA, SUBAREA, PHONE, EMAIL) VALUES ('$B_ID','$B_NAME', '$ADDRESS', '$AREA', '$SUBAREA', '$PHONE', '$EMAIL')";
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            $msg = true;
        }
        
        if(isset($msg))
        {
            echo "<script> alert('Data Imported Successfully'); document.location.href='../branch.php';</script>";
            exit(0);
        }
        else
        {
            echo "<script> alert('Data Not Imported'); document.location.href='../branch.php';</script>";
            exit(0);
        }
    }
    else{
        echo "<script> alert('Invalid File'); document.location.href='../branch.php';</script>";
        exit(0);
    }
}
?>
