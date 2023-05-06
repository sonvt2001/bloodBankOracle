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
        
        $query = 'DELETE FROM blood WHERE blood_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        //header('Location: blood.php');
        echo "<script>window.location.href='blood.php';</script>";
        
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
    <h1 class="menu-title">Blood : </h1>
    <a href="add-blood.php" class="hlink cat-link" style="margin-left: 25px;">Add Blood</a>
    
    <?php
    /*
  $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM blood ORDER BY blood_group ASC');
        oci_execute($stid);
    
        echo '<table class="tbls-blood">
            <tr>
            <td>Blood Group</td>
            <td>Blood Amount</td>
            <td>Paid Amount</td>
            <td>Edit</td>
            <td>Delete</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$row["BLOOD_GROUP"].'</td>
            <td>'.$row["BLOOD_AMOUNT"].' ML</td>
            <td>'.$row["PAID_AMOUNT"].' VND</td>
            <td> <a id="edit" href="edit-blood.php?e='.$row['BLOOD_ID'].'">Edit</a></td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="blood.php?p='.$row['BLOOD_ID'].'">Delete</a></td>
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
    
            $stid = oci_parse($conn, 'SELECT * FROM blood ORDER BY blood_group ASC');
            oci_execute($stid);
        ?>
        <div style="margin-left: 10px; margin-bottom:10px; color:red; font-family: -apple-system,system-ui,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif;">
            *Note: If delete button disable that mean this blood group is in blood request table
        </div>
            <table cellpadding="0" cellspacing="0" border="0"  style="width:100%;" class="datatable-1 table table-bordered table-striped" id="table-blood">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Blood Group</th>
                        <th>Blood Amount</th>
                        <th>Paid Amount</th>
                        <th>Edit</th>
                        <th>Delete </th>
                    </tr>
                </thead>
                    <?php
                       $cnt = 1;
                        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false){
                        ?>
                            <tr>
                                <td style="padding: 20px;"><?php echo htmlentities($cnt); ?></td>
                                <td style="padding: 20px;"><?php echo htmlentities($row['BLOOD_GROUP']); ?></td>
                                <td style="padding: 20px;">
                                <?php 
                                        $nombre_format_francais = number_format($row['BLOOD_AMOUNT'], 0, '.','.');
                                        echo $nombre_format_francais;
                                        //echo htmlentities($row['EMP_SALARY']); 
                                    ?> ML
                                </td>
                                <td style="padding: 20px;">
                                    <?php 
                                        $nombre_format_francais = number_format($row['PAID_AMOUNT'], 0, '.','.');
                                        echo $nombre_format_francais;
                                        //echo htmlentities($row['EMP_SALARY']); 
                                    ?> VND
                                </td>
                                <td style="padding: 20px;"> 
                                    <a id="edit" href="edit-blood.php?e=<?php echo $row['BLOOD_ID'] ?>">Edit</a>
                                </td>
                                <td style="padding: 20px;">
                                    <?php
                                        $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                                        if (!$conn) {
                                            $e = oci_error();
                                            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                                        }
                                        $std = oci_parse($conn, "SELECT BLOOD_GROUP FROM BLOOD WHERE NOT EXISTS (SELECT * FROM blood_request WHERE blood.blood_group = blood_request.blood_group)");
                                        oci_execute($std);
                                        
                                        while (($blood_request = oci_fetch_array($std, OCI_BOTH)) != false){
                                            if($row['BLOOD_GROUP'] == $blood_request['BLOOD_GROUP']){
                                                echo '<a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="blood.php?p='.$row['BLOOD_ID'].'">Delete</a>';
                                            }
                                        }
                                    ?>        
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
