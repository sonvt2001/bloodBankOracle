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
        
        $query = 'DELETE FROM donor WHERE d_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        echo "<script>window.location.href='donor.php';</script>";
        
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
    <h1 class="menu-title" >Donor : </h1>
    <a href="add-donor.php" class="hlink cat-link" style="margin-left: 25px;">Add New Donor</a>
    
    <?php
    /*$conn = oci_connect('TESTORACLE', 'Tu01228671340', 'localhost/XE:BloodBank');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM donor');
        oci_execute($stid);
        $i = 1;
        
        echo '<table class="tbls-donor" >
            <tr>
            <td>STT</td>
            <td>Name</td>
            <td>Address</td>
            <td>Area</td>
            <td>Sub Area </td>
            <td>Branch </td>
            <td>Blood Group </td>
            <td>National ID </td>
            <td>Phone </td>
            <td>Email </td>
            <td>Edit </td>
            <td>Delete </td>
            </tr>';
        $i = 1;
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            //Branch
            $conn = oci_connect('TESTORACLE', 'Tu01228671340', 'localhost/XE:BloodBank');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            $std = oci_parse($conn, 'SELECT b_name FROM branch WHERE b_id ='.$row['B_ID']);
            oci_execute($std);
            
            while (($branch = oci_fetch_array($std, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$i.'</td>
            <td>'.$row["D_NAME"].'</td>
            <td>'.$row["ADDRESS"].'</td>
            <td>'.$row["AREA"].'</td>
            <td>'.$row["SUBAREA"].'</td>
            <td>'.$branch["B_NAME"].'</td>
            <td>'.$row["BLOOD_GROUP"].'</td>
            <td>'.$row["NATIONAL_ID"].'</td>
            <td>'.$row["PHONE"].'</td>
            <td>'.$row["EMAIL"].'</td>
            <td> <a id="edit" href="edit-donor.php?e='.$row['D_ID'].'">Edit</a></td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="donor.php?p='.$row['D_ID'].'">Delete</a></td>
            </tr>';
            ?>
                <?php $i++; 
            }
        }
     echo '</table>';
    */
    ?>
    <div class="module" style="width: 150%; margin-left:20px;">
        <div class="module-body table" style="width: 100%; display:inline-block">
        <?php
            $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            
            $stid = oci_parse($conn, 'SELECT * FROM donor');
            oci_execute($stid);
        ?>
            <table cellpadding="0" cellspacing="0" border="0"  style="width:100%;" class="datatable-1 table table-bordered table-striped" id="table-donor">
            <div class="col-md-12 head">   
                <div class="float-right">
                    <a href="./Export/export-donor.php" class="btn-success"><i class="fa fa-sort-down" style="padding-right: 0.5rem;"></i> Export</a>
                </div>
                <form action="" method="GET"> 
                <div class="row" style="margin-left:10px; margin-bottom:15px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" name="from_date" class="form-control-date" value="<?php if(isset($_GET['from_date'])){echo $_GET['from_date'];} ?>"></input>
                            <label>To Date</label>
                            <input type="date" name="to_date" class="form-control-date" value="<?php if(isset($_GET['to_date'])){echo $_GET['to_date'];} ?>"></input>
                            <button type="submit" class="btn-filter-time"><i class="fa fa-filter" style="padding-right: 0.5rem;"></i>Filter</button>
                            <a href="donor.php" class="reloadbtn"><i class="fa fa-refresh " style="padding-right: 0.5rem;"></i>Reload</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            </div>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Area</th>
                        <th>Sub Area </th>
                        <th style="width:100px ;">Branch </th>
                        <th>Blood Group </th>
                        <!-- <th>National ID </th> -->
                        <th>Phone </th>
                        <th>Email </th>
                        <th>Schedule </th>
                        <th>Edit </th>
                        <th>Delete </th>
                    </tr>
                </thead>
                    <?php
                    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                    if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                        $from_date =  date("d-m-Y", strtotime($_GET['from_date']));
                        $to_date =  date("d-m-Y", strtotime($_GET['to_date']));
                        $stid = oci_parse($conn, "SELECT * FROM donor WHERE SCHEDULE BETWEEN TO_DATE('$from_date','DD-MM-YYYY') AND TO_DATE('$to_date','DD-MM-YYYY')");
                        oci_execute($stid);

                        if(strtotime($from_date) > strtotime($to_date)){
                            echo "<script>alert('From Date Must Be Less Than To Date'); document.location.href='donor.php';</script>";
                        }
                    }
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
                                <td style="padding: 5px"><?php echo htmlentities($cnt); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['D_NAME']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['ADDRESS']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['AREA']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['SUBAREA']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($branch['B_NAME']." ,".$branch['ADDRESS']." ,".$branch['AREA']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['BLOOD_GROUP']); ?></td>
                                <!-- <td style="padding: 5px"><?php echo htmlentities($row['NATIONAL_ID']); ?></td> -->
                                <td style="padding: 5px"><?php echo htmlentities($row['PHONE']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['EMAIL']); ?></td>
                                <td style="padding: 5px"><?php echo htmlentities($row['SCHEDULE']);?></td>
                                <td style="padding: 5px"> 
                                    <a id="edit" href="edit-donor.php?e=<?php echo $row['D_ID'] ?>">Edit</a>
                                </td>
                                <td style="padding: 5px">
                                    <a id="delete" href="donor.php?p=<?php echo $row['D_ID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
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

