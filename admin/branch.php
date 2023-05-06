<?php
session_start(); ?>
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
        
        //donor-update
        $q_donor = 'UPDATE donor SET b_id = 22 WHERE b_id ='.$p;
        $sdn = oci_parse($conn, $q_donor);
        oci_execute($sdn);

        //employee
        $q_employee = 'UPDATE employee SET b_id = 22 WHERE b_id ='.$p;
        $se = oci_parse($conn, $q_employee);
        oci_execute($se);

        //main
        if($p != 22)
        {
            $query = 'DELETE FROM branch WHERE b_id='.$p;

            $stid = oci_parse($conn, $query);
            oci_execute($stid);

            //header('Location: branch.php');
            echo "<script>window.location.href='branch.php';</script>";
        }else {
            echo "<p id=\"warning\">Can't Delete The Main Branch !</p>";
        }  
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

<div class="donor-section" style="width: 70%;">
    <h1 class="menu-title">Branch : </h1>
    <a href="add-branch.php" class="hlink cat-link" style="margin-left: 25px;">Add New Branch</a>
    <!--<p style="display: block;">[ You can not delete the Main Branch. Deleting other branch will be set default to Main Branch. ]</p>-->
    <?php
    /*$conn = oci_connect('TESTORACLE', 'Tu01228671340', 'localhost/XE:BloodBank');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM branch');
        oci_execute($stid);
    
        echo '<table class="tbls" style="width:70%;">
            <tr>
            <td>Branch Name</td>
            <td>Address</td>
            <td>Area</td>
            <td>Subarea</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Edit</td>
            <td>Delete</td>
            </tr>';

            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td >'.$row["B_NAME"].'</td>
            <td >'.$row["ADDRESS"].'</td>
            <td >'.$row["AREA"].'</td>
            <td>'.$row["SUBAREA"].'</td>
            <td>'.$row["PHONE"].'</td>
            <td>'.$row["EMAIL"].'</td>
            <td> <a id="edit" href="edit-branch.php?e='.$row['B_ID'].'">Edit</a></td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="branch.php?p='.$row['B_ID'].'">Delete</a></td>
            </tr>';
        }
        echo '</table>';
        */
        ?>
        <div class="module" style="width: 100%; margin-left:20px;">
            <div class="module-body table" style="width: 100%; display:inline-block">
            <?php
             $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                if (!$conn) {
                    $e = oci_error();
                    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                }
        
                $stid = oci_parse($conn, 'SELECT * FROM branch');
                oci_execute($stid);
            ?>
                <table cellpadding="0" cellspacing="0" border="0"  style="width:100%;" class="datatable-1 table table-bordered table-striped" id="table-branch">
                    <div class="col-md-12 head">   
                        <div class="float-right">
                            <a href="./Export/export-branch.php" class="btn-success"><i class="fa fa-sort-down" style=" padding-right: 0.5rem;"></i> Export</a>
                        </div>
                        <!-- <form action="./Import/import-branch.php" enctype ="multipart/form-data" method="POST" style="padding:5px;">
                            <input type="file" name="import_file" required value="" style="background: #ba2916; color: white; font-family:Montserrat; margin-left:5px;">
                            <button type="submit" name="import" class="import"><i class="fa fa-sort-asc" style=" padding-right: 0.75rem;"></i>Import</button>
                        </form> -->
                        
                    </div>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Branch Name</th>
                            <th>Address</th>
                            <th>Area</th>
                            <th>Sub Area </th>
                            <th>Phone </th>
                            <th>Email </th>
                            <th>Edit </th>
                            <th>Delete </th>
                        </tr>
                    </thead>
                        <?php
                           $cnt = 1;
                            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                            ?>
                                <tr>
                                    <td style="padding: 14px;"><?php echo htmlentities ($cnt); ?></td>
                                    <td style="padding: 14px;"><?php echo htmlentities ($row['B_NAME']); ?></td>
                                    <td style="padding: 14px;"><?php echo htmlentities ($row['ADDRESS']); ?></td>
                                    <td style="padding: 14px;"><?php echo htmlentities ($row['AREA']); ?></td>
                                    <td style="padding: 14px;"><?php echo htmlentities ($row['SUBAREA']); ?></td>
                                    <td style="padding: 14px;"><?php echo htmlentities ($row['PHONE']); ?></td>
                                    <td style="padding: 14px;"><?php echo htmlentities ($row['EMAIL']); ?></td>
                                    <td style="padding: 14px;"> 
                                        <a id="edit" href="edit-branch.php?e=<?php echo $row['B_ID'] ?>">Edit</a>
                                    </td>
                                    <td style="padding: 14px;">
                                        <a id="delete" href="branch.php?p=<?php echo $row['B_ID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
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

<?php
    
?>

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





