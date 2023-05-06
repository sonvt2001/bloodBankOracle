<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="head-section" style="width: 100%;">
    <h1 id="heading">Blood Bank Management System</h1>
</div>

<div id="mini-section" class="clearfix" style="width: 100%;">
    <ul class="header-list">
        <li><a href="">
            <?php
                //Procedure
                $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                $sql = 'BEGIN sayHello(:name, :message); END;';
                $stmt = oci_parse($conn,$sql);

                //  Bind the input parameter
                oci_bind_by_name($stmt,':name',$name,32);

                // Bind the output parameter
                oci_bind_by_name($stmt,':message',$message,32);

                // Assign a value to the input 
                $name = $_SESSION['user'];

                oci_execute($stmt);

                // $message is now populated with the output value
                print "$message\n";

            ?>
            </a>
        </li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="sidebar" style="margin-top:10px; margin-bottom:10px;">
    <ul class="main-nav">  
        <a href="home.php">
            <li>
                <img src="images/dashboard.png" alt="">
                <p>Dashboard</p>
            </li>
        </a>
        <a href="donor.php">
            <li>
                <img src="images/blood_in_hand.png" alt="">
                <p>Donor</p>
            </li>
        </a>
        <a href="branch.php">
            <li>
                <img src="images/branch.png" alt="">
                <p>Branch</p>
            </li>
        </a>
        <a href="blood.php">
            <li>
                <img src="images/heart-beat.png" alt="">
                <p>Blood</p>
            </li>
        </a>
        <a href="blood-request.php">
            <li>
                <img src="images/blood-request.png" alt="">
                <p>Blood Request</p>
            </li>
        </a>
        <a href="employee.php">
            <li>
                <img src="images/group.png" alt="">
                <p>Employees</p>
            </li>
        </a>
        <a href="user.php">
            <li>
                <img src="images/user.png" alt="">
                <p>Users</p>
            </li>
        </a>
        <a href="logout.php">
            <li>
                <img src="images/logout.png" alt="">
                <p>Logout</p>
            </li>
        </a>
        
    </ul>
</div>
</body>
</html>