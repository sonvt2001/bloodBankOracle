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
        
        $query = 'DELETE FROM blood_request WHERE blood_request_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        //header('Location: blood-request.php');
        echo "<script>window.location.href='blood-request.php';</script>";
        
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

<div class="donor-section" style="width: 50%;">
    <h1 class="menu-title">Blood Requests: </h1>
    <a href="add-request.php" class="hlink cat-link" style="margin-left: 25px;">Add New Blood Request</a>
    <?php
    /*
        $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM blood_request');
        oci_execute($stid);

        echo '<table class="tbls-bloodrequest">
            <tr>
            <td>Name</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Hospital</td>
            <td>Confirmation</td>
            <td>Address</td>
            <td>Area</td>
            <td>Blood Group</td>
            <td>Blood Amount</td>
            <td>Edit</td>
            <td>Delete</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {

            echo '<tr>
                <td>'.$row["NAME"].'</td>
                <td>'.$row["PHONE"].'</td>
                <td>'.$row["EMAIL"].'</td>
                <td>'.$row["HOSPITAL"].'</td>
                <td>'.$row["DELIVERY_CONFIRMATION"].'</td>
                <td>'.$row["ADDRESS"].'</td>
                <td>'.$row["AREA"].'</td>
                <td>'.$row["BLOOD_GROUP"].'</td>
                <td>'.$row["BLOOD_AMOUNT"].' ML</td>
                <td> <a id="edit" href="edit-request.php?e='.$row['BLOOD_REQUEST_ID'].'">Edit</a></td>
                <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="blood-request.php?p='.$row['BLOOD_REQUEST_ID'].'">Delete</a></td>
            </tr>';
        }
     echo '</table>';*/
     ?>
     <div class="module" style="width: 155%; margin-left:15px;">
         <div class="module-body table" style="width: 100%; display:inline-block">
         <?php
             $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
             if (!$conn) {
                 $e = oci_error();
                 trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
             }
     
            $stid = oci_parse($conn, 'SELECT * FROM BLOOD INNER JOIN blood_request ON blood.blood_group = blood_request.blood_group ');
            oci_execute($stid);
         ?>
             <table cellpadding="0" cellspacing="0" border="0"  style="width:100%;" class="datatable-1 table table-bordered table-striped" id="table-blood_request">
                 <thead>
                     <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Hospital</th>
                        <!-- <th>Confirm</th> -->
                        <th style="width:100px;">Address</th>
                        <th>Area</th>
                        <th>Blood Group</th>
                        <th>Blood Amount</th>
                        <th>Total Money</th>
                        <!-- <th>Edit</th> -->
                        <th>Delete</th>
                     </tr>
                 </thead>
                     <?php
                        $cnt = 1;
                         while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                            $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                            if (!$conn) {
                                $e = oci_error();
                                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                            }
    
                            $std = oci_parse($conn, 'SELECT b_name, address, area FROM branch WHERE b_id ='.$row['B_ID']);
                            oci_execute($std);
                            
                            while (($branch = oci_fetch_array($std, OCI_BOTH)) != false) {
                         ?>
                             <tr>
                                 <td style="padding: 5px;"><?php echo htmlentities($cnt); ?></td>
                                 <td style="padding: 5px;"><?php echo htmlentities($row['NAME']); ?></td>
                                 <td style="padding: 5px;"><?php echo htmlentities($row['PHONE']); ?></td>
                                 <td style="padding: 5px;"><?php echo htmlentities($row['EMAIL']); ?></td>
                                 <td style="padding: 5px"> <?php echo htmlentities($branch['B_NAME']." ,".$branch['ADDRESS']." ,".$branch['AREA']); ?></td>
                                 <td style="padding: 5px;"><?php echo htmlentities($row['HOSPITAL']); ?></td>
                                 <!-- <td style="padding: 5px;"><?php echo htmlentities($row['DELIVERY_CONFIRMATION']); ?></td> -->
                                 <td style="padding: 5px;"><?php echo htmlentities($row['ADDRESS']); ?></td>
                                 <td style="padding: 5px;"><?php echo htmlentities($row['AREA']); ?></td>
                                 <td style="padding: 5px;"><?php echo htmlentities($row['BLOOD_GROUP']); ?></td>
                                 <td style="padding: 5px;">
                                 <?php 
                                        $nombre_format_francais = number_format($row['BLOOD_AMOUNT_RQ'], 0, '.','.');
                                        echo $nombre_format_francais.""." ML";
                                    ?> 
                                </td>
                                <td style="padding: 5px;">
                                    <?php 
                                        $nombre_format_francais = number_format(($row['BLOOD_AMOUNT_RQ']/$row['BLOOD_AMOUNT'])*$row['PAID_AMOUNT'], 0, '.','.');
                                        echo $nombre_format_francais.""." VND";
                                    ?> 
                                </td>
                                 <!-- <td style="padding: 5px;"> 
                                     <a id="edit" href="edit-request.php?e=<?php echo $row['BLOOD_REQUEST_ID'] ?>">Edit</a>
                                 </td> -->
                                 <td style="padding: 5px;">
                                     <a id="delete" href="blood-request.php?p=<?php echo $row['BLOOD_REQUEST_ID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                 </td>
                             </tr>
                         <?php $cnt ++;
                     } ?>
                    <?php } ?>
             </table>
         </div>
     </div>                
 <?php
?> 
</div>

<?php require_once('footer.php')?>
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
