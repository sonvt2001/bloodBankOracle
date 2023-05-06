<?php

$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}else {
    echo "connected to database with me !";
}

?>
