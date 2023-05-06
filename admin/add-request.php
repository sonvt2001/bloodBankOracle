<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
<?php
    if(!$_SESSION['user'])
    {
        header('Location: login.php');
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
            add_new_request();
        }
    }

    function add_new_request()
    {
        if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['branch']) && !empty($_POST['bg']) && !empty($_POST['hname'])  && !empty($_POST['area']) && !empty($_POST['bamount'])) 
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $branch = $_POST['branch'];
            $bg = $_POST['bg'];
            $hname = $_POST['hname'];
            // $dreport = $_POST['dreport'];
            $area = $_POST['area'];
            $bamount = $_POST['bamount'];
           $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
            $query = "INSERT INTO blood_request(blood_request_id, b_id, name, phone, email, blood_group, hospital,  address, area, blood_amount_rq) VALUES (b_request.nextval, $branch, '$name', '$phone', '$email', '$bg', '$hname',  '$address', '$area', '$bamount')";

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    //echo "Successfully added New Blood Request !";
                    //header('Location: blood-request.php');
                    echo "<script>window.location.href='blood-request.php';</script>";
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
    <h1 class="menu-title">Add New Requests: </h1>
    <a href="blood-request.php" class="hlink cat-link">Back to Request List</a>
    
        <form id="add-donor-form" name="donorform" action="add-request.php" method="post">
       <br>
        <p class="form-text">Name : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
        </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php if(isset($_POST['name'])) {echo htmlentities($_POST['name']);} ?>">
        
        <p class="form-text">Phone : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($phoneErr) ? $phoneErr : '' ;?></span>
        </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php if(isset($_POST['phone'])) {echo htmlentities($_POST['phone']);} ?>">
        
        <p class="form-text">Email : 
            <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($emailErr) ? $emailErr : '' ;?></span>
        </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>">
        
        <p id="pcat" class="form-text">Select Branch : </p>
            <select name="branch" style="width: 100%;">
            <?php
               $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
                $stid = oci_parse($conn, "SELECT * FROM branch");
                oci_execute($stid);
                while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                    if(isset($_POST['branch']) && $_POST['branch'] == $row['B_ID']) {
                        echo "<option value=\"".$row['B_ID']."\" selected>".$row['B_NAME']." ,".$row['ADDRESS']." ,".$row['AREA']."</option>";
                    }
                    else{
                        echo "<option value=\"".$row['B_ID']."\">".$row['B_NAME']." ,".$row['ADDRESS']." ,".$row['AREA']."</option>";
                    }
                }
            ?>
            </select>
        
        <p id="pcat" class="form-text">Blood Group : </p>
             <select name="bg">
                <?php
                   $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');

                   $stid = oci_parse($conn, "SELECT * FROM blood ORDER BY blood_group ASC");
                   oci_execute($stid);
                    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                        if(isset($_POST['bg']) && $_POST['bg'] == $row['BLOOD_GROUP']) {
                            echo "<option value=\"".$row['BLOOD_GROUP']."\" selected>".$row['BLOOD_GROUP']." ". $nombre_format_francais = number_format($row['PAID_AMOUNT'], 0, '.','.')." VND /".$row['BLOOD_AMOUNT']." ML</option>";
                        }
                        else {
                            echo "<option value=\"".$row['BLOOD_GROUP']."\">".$row['BLOOD_GROUP']." ". $nombre_format_francais = number_format($row['PAID_AMOUNT'], 0, '.','.')." VND /".$row['BLOOD_AMOUNT']." ML</option>";
                        }
                    }
                ?>
            </select>
        
        <p class="form-text">Hospital : 
            <span class="error" style="color: red;"><?php echo isset($error4) ? $error4 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($hnameErr) ? $hnameErr : '' ;?></span>
        </p>
        <input name="hname" class="form-field" type="text" placeholder="Hospital Name" value="<?php if(isset($_POST['hname'])) {echo htmlentities($_POST['hname']);} ?>">
        
        <!-- <p class="form-text">Deliver Report : 
            <span class="error" style="color: red;"><?php echo isset($error5) ? $error5 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($dreportErr) ? $dreportErr : '' ;?></span>
        </p>
        <input name="dreport" class="form-field" type="text" placeholder="Report" value="<?php if(isset($_POST['dreport'])) {echo htmlentities($_POST['dreport']);} ?>"> -->
        
        <p class="form-text">Address : 
            <span class="error" style="color: red;"><?php echo isset($error6) ? $error6 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($addressErr) ? $addressErr : '' ;?></span>
        </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php if(isset($_POST['address'])) {echo htmlentities($_POST['address']);} ?></textarea>
        
        <p class="form-text">Area : 
            <span class="error" style="color: red;"><?php echo isset($error7) ? $error7 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($areaErr) ? $areaErr : '' ;?></span>
        </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php if(isset($_POST['area'])) {echo htmlentities($_POST['area']);} ?>">
        
        <p class="form-text">Blood Amount : 
            <span class="error" style="color: red;"><?php echo isset($error8) ? $error8 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($bamountErr) ? $bamountErr : '' ;?></span>
        </p>
        <input name="bamount" class="form-field" type="text" placeholder="Blood Amount" value="<?php if(isset($_POST['bamount'])) {echo htmlentities($_POST['bamount']);} ?>">

        <br>
        <input type="submit" name="submit" id="submit" value="Add New Request" class="form-field">
        
    </form>
</div>

<?php require_once('footer.php')?>
