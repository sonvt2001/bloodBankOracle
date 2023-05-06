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
        if (empty($_POST["bloodgroup"])) 
        {
            $error = "*Required";
            } 
            else {
                $bloodgroup = test_input($_POST["bloodgroup"]);
            if (!preg_match("/^[a-zA-Z]*$/",$bloodgroup)) 
            {
                $bloodgroupErr = "Only letters and no white spacing";
            }
        }

        if (empty($_POST["bloodamount"])) 
        {
            $error1 = "*Required";
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
            $error2 = "*Required";
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
            edit_blood();
        }
    }

    function edit_blood()
    {
        if(!empty($_POST['bamount']) && !empty($_POST['pamount'])) 
        {
            $bamount = $_POST['bamount'];
            $pamount = $_POST['pamount'];

            $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
            global $e;
            $query = "UPDATE blood SET blood_amount ='$bamount', paid_amount ='$pamount' WHERE blood_id ='$e'";

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    //echo "Successfully updated Branch !";
                    //header('Location: blood.php');
                    echo "<script>window.location.href='blood.php';</script>";
                }

        }else {
            echo "<p id=\"warning\">Fill All The Information !</p>";
        }
    }
?>



<?php

    global $e;
    $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
            
    $query = 'SELECT * FROM blood WHERE blood_id ='.$e;

    $stid = oci_parse($conn, $query);
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                  
 ?>


<div class="donor-section">
    <h1 class="menu-title">Edit Blood : <?php echo $row['BLOOD_GROUP']?></h1>
    <a href="blood.php" class="hlink cat-link">Back to Blood List</a>
    
    <form id="add-donor-form" name="donorform" action="edit-blood.php?e=<?php echo $e; ?>" method="post">
       <br>
        <p class="form-text">Blood Amount : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($bloodamountErr) ? $bloodamountErr : '' ;?></span>
        </p>
        <input name="bamount" class="form-field" type="text" placeholder="Amount of Blood" value="<?php echo $row['BLOOD_AMOUNT']?>">
        
        <p class="form-text">Paid Amount : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2: '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($padiamountErr) ? $padiamountErr : '' ;?></span>
        </p>
        <input name="pamount" class="form-field" type="text" placeholder="Amount" value="<?php echo $row['PAID_AMOUNT']?>">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update Blood" class="form-field">
        
    </form>
    
    
</div>

<?php 
    }
?>

<?php require_once('footer.php')?>
