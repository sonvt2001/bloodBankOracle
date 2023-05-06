<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
<?php
    if(!$_SESSION['user'])
    {
        header('Location: login.php');
    }

    //Donor Count
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM donor');
        oci_execute($stid);
        $donor_count = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $donor_count++;
    }

    //Blood Count
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM blood');
        oci_execute($stid);
        $blood_count = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $blood_count++;
    }

    //Blood Request
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM blood_request');
        oci_execute($stid);
        $blood_req = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $blood_req++;
    }


    //Branch
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM branch');
        oci_execute($stid);
        $branch = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $branch++;
    }

    //Employee
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM employee');
        oci_execute($stid);
        $emp = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $emp++;
    }


    //Transection
    $$conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM BLOOD INNER JOIN blood_request ON blood.blood_group = blood_request.blood_group');
        oci_execute($stid);
        $tk = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $tk = $tk + ($row['BLOOD_AMOUNT_RQ']/$row['BLOOD_AMOUNT'])*$row['PAID_AMOUNT'];
    }

    //User
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM user_info');
        oci_execute($stid);
        $user = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $user++;
    }

    //Log Report
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM user_triger');
        oci_execute($stid);
        $log = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $log++;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="dashboard-section" >
    <ul id="dashboardlist" >
        <li>
            <img src="images/group.png" alt="">
            <p>Number of Donor : <span class="dash"><?php echo $donor_count; ?></span> </p>
        </li>
        <li>
            <img src="images/blood.ico" alt="">
            <p>Blood in Stock : <span class="dash"><?php echo $blood_count; ?></span></p>
        </li>
        <li>
            <img src="images/time.png" alt="">
            <p>Blood Request : <span class="dash"><?php echo $blood_req; ?></span></p>
        </li>
        <li>
            <img src="images/branch2.png" alt="">
            <p>Total Branch : <span class="dash"><?php echo $branch; ?></span></p>
        </li>
        <li>
            <img src="images/emp.png" alt="" >
            <p>Total Employee : <span class="dash"><?php echo $emp; ?></span></p>
        </li>
        <li>
            <img src="images/dollar.png" alt="">
            <p>Total B.Request: 
                <span class="dash" >
                    <?php
                    $numbers = $tk;
                    function format_number($number) {
                        if($number >= 1000) {
                           return $number/1000 . "k"; 
                        }
                        else {
                            return $number;
                        }
                    }
                    echo format_number($numbers);
                    ?>
                </span>
            </p>
        </li>
        <li>
            <img src="images/user.png" alt="" >
            <p>Users</a> : <span class="dash"><?php echo $user; ?></span></p>
        </li>
        <li>
            <img src="images/log.png" alt="">
            <p>Log Report : <span class="dash"><?php echo $log; ?></span></p>
        </li>
    </ul>
    
    <div class="dashboard-links" style="height: 100%; width:80%; ">
        <a href="add-donor.php" class="hlink">Add a Donor</a>
        <a href="add-user.php" class="hlink">Add New User</a>
        <a href="add-employee.php" class="hlink">Add a Employee</a>
        <a href="add-request.php" class="hlink">Add Blood Request</a>
        <a href="add-branch.php" class="hlink">Add New Branch</a>
        <a href="log.php" class="hlink">User Log Report</a>    
    </div>
</div>

<?php require_once('footer.php')?>
</body>
</html>
