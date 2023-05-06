<?php

use Shuchkin\SimpleXLSXGen;

include("../ExportXLXS/SimpleXLXSGen.php");
$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$employee = [ ['ID', 'Name', 'Salary', 'Address', 'Area', 'Branch Name', 'Branch Address', 'Branch Area', 'Roloe', 'Phone', 'Email'] ];

$id = 1;
$query = 'select *  From employee';
$stid = oci_parse($conn, $query);
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    $std = oci_parse($conn, 'SELECT b_name, address, area FROM branch WHERE b_id ='.$row['B_ID']);
    oci_execute($std);     
    while (($branch = oci_fetch_array($std, OCI_BOTH)) != false) {
        if(oci_num_rows($stid) > 0){
            $id++;
            $employee = array_merge($employee ,array(array($row['EMP_ID'], $row['EMP_NAME'], 
            $nombre_format_francais = number_format($row['EMP_SALARY'], 0, '.','.'),
            $row['EMP_ADDRESS'], $row['EMP_AREA'], $branch['B_NAME'], $branch['ADDRESS'], $branch['AREA'], $row['EMP_ROLE'], $row['PHONE'], $row['EMAIL'])));
        }
    }
}
//echo "<pre>";
//print_r($employee);
$xlxs = SimpleXLSXGen::fromArray($employee);
$xlxs ->download("employee.xlsx");

?>