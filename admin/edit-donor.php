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
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$name)) {
                $nameErr = "*Only letters and white space allowed";
            }
        }
        
        if(empty($_POST["address"])){
            $error2 = "*Required";
        }
        else{
            $address = test_input($_POST["address"]);
            if (!preg_match("/(?i)([0-9A-ZẮẰẲẴẶĂẤẦẨẪẬÂÁÀÃẢẠĐẾỀỂỄỆÊÉÈẺẼẸÍÌỈĨỊỐỒỔỖỘÔỚỜỞỠỢƠÓÒÕỎỌỨỪỬỮỰƯÚÙỦŨỤÝỲỶỸỴ']+\\s?\\b){2,}/",$address)) 
            {
                $addressErr = "Invalid Address";
            }
        }
            
        if (empty($_POST["area"])) 
        {
            $error3 = "*Required";
        } 
        else {
            $area = test_input($_POST["area"]);
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$area)) 
            {
                $areaErr = "Invalid Area";
            }
        }

        if (empty($_POST["sub-area"])) 
        {
            $error4 = "*Required";
        } 
        // else {
        //     $sub_area = test_input($_POST["sub-area"]);
        //     if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$sub_area)) 
        //     {
        //         $sub_areaErr = "Invalid Sub Area";
        //     }
        // }

        // if (empty($_POST["nid"])) 
        // {
        //     $error5 = "*Required";
        // } 
        // else {
        //     $nid = test_input($_POST["nid"]);
        //     if (!preg_match("/^[0-9]*$/",$nid)) 
        //     {
        //         $nidErr = "Only numbers";
        //     }
                
        // }
            
        if (empty($_POST["phone"])) 
        {
            $error6 = "*Required";
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
            $error7 = "*Required";
        } 
        else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["schedule"]))
        {
            $error8 = "*Required";
        }
        
        if(empty($nameErr) && empty($addressErr) && empty($areaErr) && empty($sub_areaErr)  && empty($phoneErr) && empty($emailErr)){
            edit_donor();
        }
    }   

    function edit_donor()
    {
        if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['area']) && !empty($_POST['sub-area']) && !empty($_POST['branch']) && !empty($_POST['bg'])  && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['schedule'])) 
        {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $area = $_POST['area'];
            $sub_area = $_POST['sub-area'];
            $branch = $_POST['branch'];
            $bg = $_POST['bg'];
            // $nid = $_POST['nid'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $schedule = date("d-m-Y h:i:s A", strtotime($_POST['schedule']));

            
            $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
            global $e;
            $query = "UPDATE donor SET b_id ='$branch', d_name ='$name', address ='$address', area='$area', subarea ='$sub_area', blood_group ='$bg', phone ='$phone', email ='$email', schedule = TO_DATE('$schedule', 'DD-MM-YYYY hh:mi:ss AM') WHERE d_id =".$e;

            $stid = oci_parse($conn, $query);
            $result = oci_execute($stid);
    
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "<script>window.location.href='donor.php';</script>";
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
            
    $query = 'SELECT * FROM donor WHERE d_id ='.$e;
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
            
    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {       
?>


<div class="donor-section">
    <h1 class="menu-title">Update Donor : </h1>
    <a href="donor.php" class="hlink cat-link">Back to Donor List</a>
    
    <form id="add-donor-form" name="donorform" action="edit-donor.php?e=<?php echo $e;?>" method="post">
       <br>
        <p class="form-text">Donor Name : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
        </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['D_NAME']?>">
        
        <p class="form-text">Address : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($addressErr) ? $addressErr : '' ;?></span>
        </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php echo $row['ADDRESS']?></textarea>
        
        <p class="form-text">Area : 
            <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($areaErr) ? $areaErr : '' ;?></span>
        </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php echo $row['AREA']?>">
        
        <p class="form-text">Sub Area : 
            <span class="error" style="color: red;"><?php echo isset($error4) ? $error4 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($sub_areaErr) ? $sub_areaErr : '' ;?></span>
        </p>
        <input name="sub-area" class="form-field" type="text" placeholder="Sub Area" value="<?php echo $row['SUBAREA']?>">
        
        <p id="pcat" class="form-text">Select Branch : </p>
            <select name="branch" style="width: 100%;" >
            <?php
                $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
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
                                echo "<option selected='selected' value=\"".$bg['BLOOD_GROUP']."\">".$bg['BLOOD_GROUP']."</option>";
                            }
                            else {
                                echo "<option value=\"".$bg['BLOOD_GROUP']."\">".$bg['BLOOD_GROUP']."</option>";
                            }
                        }
                    } else {
                        echo "Branch Failed !";
                    }
                 ?>
            </select>
            
        <!-- <p class="form-text">National ID : 
            <span class="error" style="color: red;"><?php echo isset($error5) ? $error5: '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nidErr) ? $nidErr : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nidExist) ? $nidExist : '' ;?></span>
        </p>
        <input name="nid" class="form-field" type="text" placeholder="National id" value="<?php echo $row['NATIONAL_ID']?>"> -->
        
        <p class="form-text">Phone : 
            <span class="error" style="color: red;"><?php echo isset($error6) ? $error6 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($phoneErr) ? $phoneErr : '' ;?></span>
        </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php echo $row['PHONE']?>">
        
        <p class="form-text">Email : 
            <span class="error" style="color: red;"><?php echo isset($error7) ? $error7 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($emailErr) ? $emailErr : '' ;?></span>
        </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php echo $row['EMAIL']?>">

        <p class="form-text">Appointment Schedule : 
        </p>  
        <input name="schedule" class="form-field" type="date" value="<?php echo date('Y-m-d', strtotime($row['SCHEDULE']))?>">
            <span class="error" style="color: red;"><?php echo isset($error8) ? $error8 : '' ;?></span>

        <br>
        <input type="submit" name="submit" id="submit" value="Update Donor" class="form-field">
        
    </form>
</div>

<?php 
    }
?>
<?php require_once('footer.php')?>
