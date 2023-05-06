<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
<?php
    if(!$_SESSION['user'])
    {
        header('Location: login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["bloodgroup"])) 
        {
            $error1 = "*Required";
            } 
            else {
                $bloodgroup = test_input($_POST["bloodgroup"]);
            if (!preg_match("/^[a-zA-Z-*#+ ]+$/",$bloodgroup)) 
            {
                $bloodgroupErr = "Only letters and white spacing allowed";
            }
            else{
                $query = "SELECT * FROM blood WHERE BLOOD_GROUP = '$bloodgroup'";
                $stmt = oci_parse($conn, $query);
                oci_execute($stmt);
                $row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS);
                if($row)
                {
                    $bloodgroupExist = "This blood group already exists";
                }
            }
        }

        if (empty($_POST["bloodamount"])) 
        {
            $error2 = "*Required";
            } 
            else {
                $bloodamount = test_input($_POST["bloodamount"]);
            if (!preg_match("/^[0-9]*$/",$bloodamount)) 
            {
                $bloodamountErr = "Only numbers";
            }
        }

        if (empty($_POST["paidamount"])) 
        {
            $error3 = "*Required";
            } 
            else {
                $padiamount = test_input($_POST["paidamount"]);
            if (!preg_match("/^[0-9]*$/",$padiamount)) 
            {
                $padiamountErr = "Only numbers";
            }
        }
        
        if(empty($bloodamountErr) && empty($bloodgroupErr) && empty($padiamountErr))
        {
            Add_new_blood();
        }
    }

    function add_new_blood()
    {
        if(!empty($_POST['bloodgroup']) && !empty($_POST['bloodamount']) && !empty($_POST['paidamount']))  
        {
            $bloodgroup = $_POST['bloodgroup'];
            $bloodamount = $_POST['bloodamount'];
            $padiamount = $_POST['paidamount'];
        

            $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                
            $query = "INSERT INTO blood(blood_id, blood_amount, blood_group, paid_amount) VALUES (bld.nextval,'$bloodamount', '$bloodgroup', ' $padiamount')";
            $stid = oci_parse($conn, $query);
            $result = oci_execute($stid);
            if(!$result) {
                echo "Failed !";
            }else {
                //echo "Successfully added New Branch !";
                //header('Location: branch.php');
                echo "<script>window.location.href='blood.php';</script>";
            }

        }else {
            echo "<p id=\"warning\">Fill All The Information !</p>";
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<div class="donor-section">
    <h1 class="menu-title">Add New Blood : </h1>
    <a href="blood.php" class="hlink cat-link">Back to Blood List</a>
    
        <form id="add-donor-form" name="donorform" action="add-blood.php" method="post">
        <br>
        <p class="form-text">Blood Group : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($bloodgroupErr) ? $bloodgroupErr : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($bloodgroupExist) ? $bloodgroupExist : '' ;?></span>
        </p>
        <input name="bloodgroup" class="form-field" type="text" placeholder="Blood Group" value="<?php if(isset($_POST['bloodgroup'])) {echo htmlentities($_POST['bloodgroup']);} ?>">
        
        <p class="form-text">Blood Amount : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($bloodamountErr) ? $bloodamountErr : '' ;?></span>
        </p>
        <input name="bloodamount" class="form-field" type="text" placeholder="Blood Amount" value="<?php if(isset($_POST['bloodamount'])) {echo htmlentities($_POST['bloodamount']);} ?>">
        
        <p class="form-text">Paid Amount : 
            <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($padiamountErr) ? $padiamountErr : '' ;?></span>
        </p>
        <input name="paidamount" class="form-field" type="text" placeholder="Paid Amount" value="<?php if(isset($_POST['paidamount'])) {echo htmlentities($_POST['paidamount']);} ?>">
        <br>
        <input type="submit" name="submit" id="submit" value="Add Blood" class="form-field">
        
    </form>
    
</div>

<?php require_once('footer.php')?>
