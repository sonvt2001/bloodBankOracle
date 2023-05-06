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
        
        $query = 'DELETE FROM employee WHERE emp_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        //header('Location: employee.php');
        echo "<script>window.location.href='employee.php';</script>";  
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div class="donor-section" style="width: 50%;">
    <h1 class="menu-title">Employee: </h1>
    <a href="add-employee.php" class="hlink cat-link" style="margin-left: 25px;">Add New Employee</a>
    
    <?php
        /*$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM employee');
        oci_execute($stid);
    
    
        echo '<table class="tbls-employee">
            <tr>
            <td>Name</td>
            <td>Salary</td>
            <td>Address</td>
            <td>Area</td>
            <td>Branch</td>
            <td>Role</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Delete</td>
            <td>Edit</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            //Branch
            $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            $std = oci_parse($conn, 'SELECT b_name FROM branch WHERE b_id ='.$row['B_ID']);
            oci_execute($std);
            
            while (($branch = oci_fetch_array($std, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$row["EMP_NAME"].'</td>
            <td>'.$row["EMP_SALARY"].' VND</td>
            <td>'.$row["EMP_ADDRESS"].'</td>
            <td>'.$row["EMP_AREA"].'</td>
            <td>'.$branch["B_NAME"].'</td>
            <td>'.$row["EMP_ROLE"].'</td>
            <td>'.$row["PHONE"].'</td>
            <td>'.$row["EMAIL"].'</td>
            <td> <a id="edit" href="edit-employee.php?e='.$row['EMP_ID'].'">Edit</a></td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="employee.php?p='.$row['EMP_ID'].'">Delete</a></td>
            </tr>';   
            }
        }    
     echo '</table>';*/
     ?>
     <div class="module" style="width: 150%; margin-left:20px;">
         <div class="module-body table" style="width: 100%; display:inline-block">
         <?php
             $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
             if (!$conn) {
                 $e = oci_error();
                 trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
             }
     
            $stid = oci_parse($conn, 'SELECT * FROM employee');
            oci_execute($stid);
         ?>
             <table cellpadding="0" cellspacing="0" border="0"  style="width:100%;" class="datatable-1 table table-bordered table-striped" id="table-donor">
                <div class="col-md-12 head">   
                <div class="float-right">
                    <a href="./Export/export-employee.php" class="btn-success"><i class="fa fa-sort-down" style=" padding-right: 0.5rem;"></i> Export</a>
                </div>
                </div>
                 <thead>
                     <tr>
                         <th>STT</th>
                         <th>Name</th>
                         <th>Salary</th>
                         <th>Address</th>
                         <th>Area</th>
                         <th style="width: 100px;">Branch </th>
                         <th>Role</th>
                         <th>Phone </th>
                         <th>Email </th>
                         <th>Edit </th>
                         <th>Delete </th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $cnt = 1;
                         while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                         //branch
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
                                <td style="padding: 7px;"><?php echo htmlentities($cnt); ?></td>
                                <td style="padding: 7px;"><?php echo htmlentities($row['EMP_NAME']); ?></td>
                                <td style="padding: 7px; width:10%;">
                                    <?php 
                                        $nombre_format_francais = number_format($row['EMP_SALARY'], 0, '.','.');
                                        echo $nombre_format_francais;
                                        //echo htmlentities($row['EMP_SALARY']); 
                                    ?> VND
                                </td>
                                <td style="padding: 7px;"><?php echo htmlentities($row['EMP_ADDRESS']); ?></td>
                                <td style="padding: 7px;"><?php echo htmlentities($row['EMP_AREA']); ?></td>
                                <td style="padding: 7px"><?php echo htmlentities($branch['B_NAME']." ,".$branch['ADDRESS']." ,".$branch['AREA']); ?></td>
                                <td style="padding: 7px;"><?php echo htmlentities($row['EMP_ROLE']); ?></td>
                                <td style="padding: 7px;"><?php echo htmlentities($row['PHONE']); ?></td>
                                <td style="padding: 7px;"><?php echo htmlentities($row['EMAIL']); ?></td>
                                <td style="padding: 7px;"> 
                                     <a id="edit" href="edit-employee.php?e=<?php echo $row['EMP_ID'] ?>">Edit</a>
                                 </td>
                                 <td style="padding: 7px;">
                                     <a id="delete" href="employee.php?p=<?php echo $row['EMP_ID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
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
