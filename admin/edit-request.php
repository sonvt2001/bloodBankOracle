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
        else 
        {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$name)) 
            {
                $nameErr = "*Only letters and white space allowed";
            }
        }
        

        if (empty($_POST["phone"])) 
        {
            $error2 = "*Required";
            } 
            else {
                $phone = test_input($_POST["phone"]);
            if (!preg_match("/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/",$phone)) 
            {
                $phoneErr = "Phone number should contain only numbers";
            }
        }

        if (empty($_POST["email"])) 
        {
            $error3 = "*Required";
        } 
        else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["hname"])) 
        {
            $error4 = "*Required";
        } 
        else 
        {
            $hname = test_input($_POST["hname"]);
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$name)) 
            {
                $hnameErr = "*Only letters and white space allowed";
            }
        }

        if (empty($_POST["dreport"])) 
        {
            $error5 = "*Required";
        } 
        else 
        {
            $dreport = test_input($_POST["dreport"]);
            if (!preg_match("/(?i)([0-9A-ZẮẰẲẴẶĂẤẦẨẪẬÂÁÀÃẢẠĐẾỀỂỄỆÊÉÈẺẼẸÍÌỈĨỊỐỒỔỖỘÔỚỜỞỠỢƠÓÒÕỎỌỨỪỬỮỰƯÚÙỦŨỤÝỲỶỸỴ']+\\s?\\b){2,}/",$dreport)) 
            {
                $dreportErr = "Invalid delivery report";
            }
        }

        if(empty($_POST["address"]))
        {
            $error6 = "*Required";
        }
        else
        {
            $address = test_input($_POST["address"]);
            if (!preg_match("/(?i)([0-9A-ZẮẰẲẴẶĂẤẦẨẪẬÂÁÀÃẢẠĐẾỀỂỄỆÊÉÈẺẼẸÍÌỈĨỊỐỒỔỖỘÔỚỜỞỠỢƠÓÒÕỎỌỨỪỬỮỰƯÚÙỦŨỤÝỲỶỸỴ']+\\s?\\b){2,}/",$address)) 
            {
                $addressErr = "Invalid Address";
            }
        }

        if (empty($_POST["area"])) 
        {
            $error7 = "*Required";
        } 
        else 
        {
            $area = test_input($_POST["area"]);
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$area)) 
            {
                $areaErr = "Invalid Area";
            }
        }

        if (empty($_POST["bamount"])) 
        {
            $error8 = "*Required";
            } 
            else {
                $bamount = test_input($_POST["bamount"]);
            if (!preg_match("/^([0-9]*)$/",$bamount)) 
            {
                $bamountErr = "Blood amount only number";
            }
        }
        
        if(empty($nameErr) && empty($phoneErr) && empty($emailErr) && empty($hnameErr) && empty($dreportErr) && empty($areaErr) && empty($bamountErr))
        {
            edit_request();
        }
    }

    function edit_request()
    {
        if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['branch']) && !empty($_POST['bg']) && !empty($_POST['hname']) && !empty($_POST['dreport']) && !empty($_POST['area']) && !empty($_POST['bamount'])) 
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $branch = $_POST['branch'];
            $bg = $_POST['bg'];
            $hname = $_POST['hname'];
            $dreport = $_POST['dreport'];
            $area = $_POST['area'];
            $bamount = $_POST['bamount'];
            
           $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                
            global $e;
            
            $query = "INSERT INTO blood_request(blood_request_id, b_id, name, phone, email, blood_group, hospital, delivery_confirmation, address, area, blood_amount_rq) VALUES (admin.b_request.nextval, $branch, '$name', '$phone', '$email', '$bg', '$hname', '$dreport', '$address', '$area', '$bamount')";
            
            $query = "UPDATE blood_request SET b_id ='$branch', name ='$name', phone ='$phone', email ='$email', blood_group ='$bg', hospital ='$hname', delivery_confirmation ='$dreport', address ='$address', area ='$area', blood_amount_rq ='$bamount' WHERE blood_request_id =".$e;

            $stid = oci_parse($conn, $query);
               
            $result = oci_execute($stid);
                
            if(!$result) {
                echo "Failed !";
            }else {
                //echo "Successfully added New Blood Request !";
                //header('Location: blood-request.php');
                echo "<script>window.location.href='blood-request.php';</script>";
            }
        }
        else {
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
    
    $query = 'SELECT * FROM blood_request WHERE blood_request_id ='.$e;
    $stid = oci_parse($conn, $query);
    oci_execute($stid);    
    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {       
 ?>

<div class="donor-section">
    <h1 class="menu-title">Edit Requests: </h1>
    <a href="blood-request.php" class="hlink cat-link">Back to Request List</a>
    
    <form id="add-donor-form" name="donorform" action="edit-request.php?e=<?php echo $e; ?>" method="post">
       <br>
        <p class="form-text">Name : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
        </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['NAME']?>">
        
        <p class="form-text">Phone : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($phoneErr) ? $phoneErr : '' ;?></span>
        </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php echo $row['PHONE']?>">
        
        <p class="form-text">Email : 
            <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($emailErr) ? $emailErr : '' ;?></span>
        </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php echo $row['EMAIL']?>">
        
        <p id="pcat" class="form-text">Select Branch : </p>
        <select name="branch" style="width: 100%;" >
            <?php
                $conn = oci_connect('TESTORACLE', 'Tu01228671340', 'localhost/XE:BloodBank','Al32UTF8');
                $sdt = oci_parse($conn, "SELECT * FROM branch");
                oci_execute($sdt);
                    if($sdt) {
                        while (($bb = oci_fetch_array($sdt, OCI_BOTH)) != false) {
                            if($row['B_ID'] == $bb['B_ID'])
                            {
                                echo "<option selected='selected' value=\"".$bb['B_ID']."\">".$bb['B_NAME']." ,".$bb['ADDRESS']." ,".$bb['AREA']."</option>";
                            }
                            else {
                                echo "<option value=\"".$bb['B_ID']."\">".$bb['B_NAME']." ,".$bb['ADDRESS']." ,".$bb['AREA']."</option>";
                            }
                        }
                    } else {
                        echo "Branch Failed !";
                    }
            ?>
            </select>
        
        <p id="pcat" class="form-text">Blood Group : </p>
             <select name="bg">
                <?php
               $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                $var = $row['BLOOD_GROUP'];
                $sdtt = oci_parse($conn, "SELECT * FROM blood");
                oci_execute($sdtt);
                    if($sdtt) {
                        while (($bg = oci_fetch_array($sdtt, OCI_BOTH)) != false) {
                            if($row['BLOOD_GROUP'] == $bg['BLOOD_GROUP'])
                            {
                                echo "<option selected='selected' value=\"".$bg['BLOOD_GROUP']."\">".$bg['BLOOD_GROUP']." ". $nombre_format_francais = number_format($bg['PAID_AMOUNT'], 0, '.','.')." VND /".$bg['BLOOD_AMOUNT']." ML</option>";
                            }
                            else {
                                echo "<option value=\"".$bg['BLOOD_GROUP']."\">".$bg['BLOOD_GROUP']." ". $nombre_format_francais = number_format($bg['PAID_AMOUNT'], 0, '.','.')." VND /".$bg['BLOOD_AMOUNT']." ML</option>";
                            }
                        }
                    } else {
                        echo "Branch Failed !";
                    }
                 ?>
            </select>
        
        <p class="form-text">Hospital : 
            <span class="error" style="color: red;"><?php echo isset($error4) ? $error4 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($hnameErr) ? $hnameErr : '' ;?></span>
        </p>
        <input name="hname" class="form-field" type="text" placeholder="Hospital Name" value="<?php echo $row['HOSPITAL']?>">
        
        <p class="form-text">Deliver Report : 
            <span class="error" style="color: red;"><?php echo isset($error5) ? $error5 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($reportErr) ? $reportErr : '' ;?></span>
        </p>
        <input name="dreport" class="form-field" type="text" placeholder="Report" value="<?php echo $row['DELIVERY_CONFIRMATION']?>">
        
        <p class="form-text">Address : 
            <span class="error" style="color: red;"><?php echo isset($error6) ? $error6 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($addressErr) ? $addressErr : '' ;?></span>
        </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php echo $row['ADDRESS']?></textarea>
        
        <p class="form-text">Area : 
            <span class="error" style="color: red;"><?php echo isset($error7) ? $error7 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($areaErr) ? $areaErr : '' ;?></span>
        </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php echo $row['AREA']?>">
        
        <p class="form-text">Blood Amount : 
            <span class="error" style="color: red;"><?php echo isset($error8) ? $error8 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($bamountErr) ? $bamountErr : '' ;?></span>
        </p>
        <input name="bamount" class="form-field" type="text" placeholder="Blood Amount" value="<?php echo $row['BLOOD_AMOUNT_RQ']?>">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update Request" class="form-field">
        
    </form>
</div>

<?php 
    }
?>


<?php require_once('footer.php')?>
