<?php

use Shuchkin\SimpleXLSXGen;

include("../ExportXLXS/SimpleXLXSGen.php");
$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$branch = [ ['ID', 'Branch Name', 'Address', 'Area', 'Sub Area','Phone', 'Email'] ];

$id = 1;
$query = 'select *  From branch';
$stid = oci_parse($conn, $query);
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {   
    if(oci_num_rows($stid) > 0){
        $id++;
        $branch = array_merge($branch ,array(array($row['B_ID'], $row['B_NAME'], $row['ADDRESS'], $row['AREA'], $row['SUBAREA'], $row['PHONE'], $row['EMAIL'])));
    }   
}
//echo "<pre>";
//print_r($branch);
$xlxs = SimpleXLSXGen::fromArray($branch);
$xlxs ->download("branch.xlsx");

?>