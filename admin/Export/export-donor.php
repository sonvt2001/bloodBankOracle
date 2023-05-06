<?php

use Shuchkin\SimpleXLSXGen;

include("../ExportXLXS/SimpleXLXSGen.php");
$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$donor = [ ['ID', 'Name', 'Address', 'Area', 'Sub Area', 'Branch Name', 'Branch Address', 'Brach Area', 'Blood Group', 'National ID', 'Phone', 'Email', 'Schedule'] ];

$id = 1;
$query = 'select *  From donor';
$stid = oci_parse($conn, $query);
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    $std = oci_parse($conn, 'SELECT b_name, address, area FROM branch WHERE b_id ='.$row['B_ID']);
    oci_execute($std);     
    while (($branch = oci_fetch_array($std, OCI_BOTH)) != false) {
        if(oci_num_rows($stid) > 0){
            $id++;
            $donor = array_merge($donor ,array(array($row['D_ID'], $row['D_NAME'], $row['ADDRESS'], $row['AREA'], $row['SUBAREA'], $branch['B_NAME'], $branch['ADDRESS'], $branch['AREA'], $row['BLOOD_GROUP'], $row['NATIONAL_ID'], $row['PHONE'], $row['EMAIL'], $row['SCHEDULE'])));
        }
    }
}
//echo "<pre>";
//print_r($donor);
$xlxs = SimpleXLSXGen::fromArray($donor);
$xlxs ->download("donor.xlsx");

?>