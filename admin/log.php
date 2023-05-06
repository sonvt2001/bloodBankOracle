<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
<?php
    if(!$_SESSION['user'])
    {
        header('Location: login.php');
    }

    if(isset($_GET['p']))
    {
        $p = $_GET['p'];
        
       $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        
        $query = 'DELETE FROM user_triger WHERE ut_id='.$p;
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        echo "<script>window.location.href='log.php';</script>";
    }
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Category</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>

<div class="donor-section" style="width:60%;">
    <h1 class="menu-title" style="margin-left: 25px;">LOG REPORT : (USER)</h1>
    
    <?php
    /*$conn = oci_connect('TESTORACLE', 'Tu01228671340', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM user_triger');
        oci_execute($stid);

    
        echo '<table class="tbls">
            <tr>
            <td>Action</td>
            <td>Time</td>
            <td>Old Username</td>
            <td>New Username</td>
            <td>Delete</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$row["ACTION"].'</td>
            <td>'.$row["TIME"].'</td>
            <td>'.$row["OLD"].'</td>
            <td>'.$row["NEW"].'</td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');"" href="log.php?p='.$row['UT_ID'].'">Delete</a></td>
            </tr>';
        }
     echo '</table>';*/
     ?>
     <div class="module" style="width: 100%; margin-left:20px;">
     <div class="module-body table" style="width: 100%; display:inline-block">
         <table cellpadding="0" cellspacing="0" border="0"  style="width:100%; padding:50px;" class="datatable-1 table table-bordered table-striped" >
             <thead>
                 <tr>
                     <th>STT</th>
                     <th>Action</th>
                     <th>Time</th>
                     <th>Old Username</th>
                     <th>New Username</th>
                     <th>Delete</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
               $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                     if (!$conn) {
                         $e = oci_error();
                         trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                     }
                     $stid = oci_parse($conn, 'SELECT * FROM user_triger');
                     oci_execute($stid);
                     $cnt = 1;
                     while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                     ?>
                         <tr>
                             <td><?php echo htmlentities($cnt); ?></td>
                             <td><?php echo htmlentities($row['ACTION']); ?></td>
                             <td><?php echo htmlentities($row['TIME']); ?></td>
                             <td><?php echo htmlentities($row['OLD']); ?></td>
                             <td><?php echo htmlentities($row['NEW']); ?></td>
                             <td>
                                 <a id="delete" href="log.php?p=<?php echo $row['UT_ID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                             </td>
                         </tr>
                     <?php $cnt ++;
                 } ?>
         </table>
     </div>
 </div>          
<?php

    ?>
</div>


<?php require_once('footer.php')?>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
	$(document).ready(function() {
	$('.datatable-1').dataTable();
	$('.dataTables_paginate').addClass("btn-group datatable-pagination");
	$('.dataTables_paginate > a').wrapInner('<span />');
    $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
	$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
   
});
</script>
