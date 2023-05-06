<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
<?php
    if(!$_SESSION['user'])
    {
        header('Location: login.php');
    }

    global $e;

    if(isset($_REQUEST['e']))
    {
        $e = $_GET['e'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) 
        {
            $error1 = "*Required";
            } 
            else {
                $name = test_input($_POST["name"]);

            if (!preg_match('/^([A-Za-z0-9-_]+)$/',$name)) 
            {
                $nameErr = "Only letters and No white space";
            }
            else{
                $query = "SELECT * FROM user_info WHERE username = '$name'";
                $stmt = oci_parse($conn, $query);
                oci_execute($stmt);
                $row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS);
                if($row)
                {
                    $nameErrExist = "Name already exists";
                }
            }
        }
        

        if (empty($_POST["password"])) 
        {
            $error2 = "*Required";
            } 
            else {
                $password = test_input($_POST["password"]); 
                
            if (strlen($password) <6) 
            {
                $passwordErr = "Password must be at least 6 characters";
            }
        }
    
        if(empty($nameErr) && empty($passwordErr) && empty($nameErrExist))
        {
            edit_user();
        }
    }

    function edit_user()
    {
        if(!empty($_POST['name']) && !empty($_POST['password'])) 
        {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
           $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                
            global $e;
            $query = "UPDATE user_info SET username ='$name', password ='$password' WHERE user_id =".$e;

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    //echo "Successfully added New User !";
                    echo "<script>window.location.href='User.php';</script>";
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


<?php
        global $e;
       $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
            
        $query = 'SELECT * FROM user_info WHERE user_id ='.$e;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
            
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                
        
 ?>

<div class="donor-section">
    <h1 class="menu-title">Edit User : </h1>
    <a href="user.php" class="hlink cat-link">Back to User List</a>
    
    <form id="add-donor-form" name="donorform" action="edit-user.php?e=<?php echo $e; ?>" method="post">
       <br>
        <p class="form-text">User Name : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErrExist) ? $nameErrExist : '' ;?></span>
        </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['USERNAME']?>">
        
        <p class="form-text">Password : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($passwordErr) ? $passwordErr : '' ;?></span>
        </p>
        <input name="password" class="form-field" type="password" placeholder="Password" value="<?php echo $row['PASSWORD']?>">
        
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update User" class="form-field">
        
    </form>
</div>

<?php 
    }
?>

<?php require_once('footer.php')?>
