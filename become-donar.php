<?php session_start(); ?>
<?php include 'includes/header.php'; ?>
<?php
  
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
        // else{
        //     $address = test_input($_POST["address"]);
        //     if (!preg_match("/(?i)([0-9A-ZẮẰẲẴẶĂẤẦẨẪẬÂÁÀÃẢẠĐẾỀỂỄỆÊÉÈẺẼẸÍÌỈĨỊỐỒỔỖỘÔỚỜỞỠỢƠÓÒÕỎỌỨỪỬỮỰƯÚÙỦŨỤÝỲỶỸỴ']+\\s?\\b){2,}/",$address)) 
        //     {
        //         $addressErr = "Invalid Address";
        //     }
        // }
        
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

        // if (empty($_POST["sub-area"])) 
        // {
        //     $error4 = "*Required";
        //     } 
        //     else {
        //         $sub_area = test_input($_POST["sub-area"]);
        //     if (!preg_match("/^[a-zA-Z*#+ ]+$/",$sub_area)) 
        //     {
        //         $sub_areaErr = "Invalid Sub Area";
        //     }
        // }

        // if (empty($_POST["nid"])) 
        // {
        //     $error5 = "*Required";
        //     } 
        //     else {
        //         $nid = test_input($_POST["nid"]);
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
        else{
            $schedule = test_input($_POST["schedule"]);
            $date = date_create($schedule);
            $today = date_create(date("d-m-Y"));
            if($date < $today)
            {
                $errorDate = "*Date should not be in the past";
            }
        }

        if(empty($nameErr) && empty($addressErr) && empty($areaErr) && empty($sub_areaErr) && empty($nidErr) && empty($phoneErr) && empty($emailErr) && empty($errorDate)){
            add_new_donor();
        }
    }

    function add_new_donor()
    {
        if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['area']) && !empty($_POST['sub-area']) && !empty($_POST['branch']) && !empty($_POST['bg']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['schedule'])) 
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
            $query = "INSERT INTO donor(d_id, b_id, d_name, address, area, subarea, blood_group,  phone, email, schedule) VALUES (dnr.nextval, $branch, '$name', '$address', '$area', '$sub_area', '$bg',  '$phone', '$email', TO_DATE('$schedule', 'DD-MM-YYYY hh:mi:ss AM'))";
            $stid = oci_parse($conn, $query);
            $result = oci_execute($stid);

            if(!$result) {
                echo "Failed !";  
            }
            else {
                echo "<script>alert('Successfully Become donoar! Thank You');</script>";
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

<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    #color {
        color: #ba2916;
    }

    #center {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
    }

    select{
        width:auto;
        border:1px solid #cccccc;
        background-color:#ffffff;
        display: inline-block;  
    }

    select/*,input[type="file"]*/{
        height:30px;
        border:1px solid #cccccc;
        background-color:#ffffff;
        outline: none;
    }

    input[type="search"]{
        border:1px solid #cccccc;
        background-color:#ffffff;
        margin-bottom: 30px;
        height: 30px;
        display: inline-block;

    }

    input[type="text"]{
        border:1px solid #cccccc;
        margin-bottom: 10px;
        outline: none;
    }

    input[type="password"]{
        border:1px solid #cccccc;
        margin-bottom: 10px;
        outline: none;
    }
    #textarea{
        border:1px solid #cccccc;
        margin-bottom: 10px;
        outline: none;
    }

    input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0px 1000px #ffffff inset;
    }

    select,
    textarea,
    input[type="text"],
    input[type="url"],
    .uneditable-input,
    button,
    select,
    textarea {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px; 
    }

    .form-field {
        width: 100%;
        padding: 15px;
        font-size: 16px;
    }

    #submit {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        background: #ba2916;
        cursor: pointer;
        margin-bottom: 50px;
        border: none;
        text-decoration: none;
        padding: 15px;
        border-radius: 10px;
        color: #ffffff;
        font-size: 16px;
        margin-top: 25px;
    }

    .menu-title {
        display: block;
        font-size: 50px;
        color: #ba2916;
        text-shadow: 2px 2px 0px rgba(0,0,0,0.2);
        text-align: center;
    }
    #warning {
        background: red;
        padding: 15px 25px;
        width: 220px;
        margin: 0 auto;
        color: white;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    body {
        line-height: 1;
        margin: auto;
        width: 100%;  
    }

</style>
</head>

<div class="container">
    <div class="donor-section" id="center">

        <h1 class="menu-title" id="color">Become Donor</h1>
            <form id="add-donor-form" name="donorform" action="become-donar.php" method="post">
        <br>
            <p class="form-text">Donor Name :
                <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
            </p>
            <input name="name" class="form-field" type="text" placeholder="Name" value="<?php if(isset($_POST['name'])) {echo htmlentities($_POST['name']);} ?>">

            <p class="form-text">Address :
                <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($addressErr) ? $addressErr : '' ;?></span>
            </p>
            <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php if(isset($_POST['address'])) {echo htmlentities($_POST['address']);} ?></textarea>

            <p class="form-text">Area :
                <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($areaErr) ? $areaErr : '' ;?></span>
            </p>
            <input name="area" class="form-field" type="text" placeholder="Area" value="<?php if(isset($_POST['area'])) {echo htmlentities($_POST['area']);} ?>">

            <p class="form-text">Sub Area :
                <span class="error" style="color: red;"><?php echo isset($error4) ? $error4 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($sub_areaErr) ? $sub_areaErr : '' ;?></span>
            </p>
            <input name="sub-area" class="form-field" type="text" placeholder="Sub Area" value="<?php if(isset($_POST['sub-area'])) {echo htmlentities($_POST['sub-area']);} ?>">

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
                            echo "<option value=\"".$row['BLOOD_GROUP']."\" selected>".$row['BLOOD_GROUP']."</option>";
                        }
                        else {
                            echo "<option value=\"".$row['BLOOD_GROUP']."\">".$row['BLOOD_GROUP']."</option>";
                        }
                    }
                 ?>
            </select>

            <!-- <p class="form-text">National ID :
                <span class="error" style="color: red;"><?php echo isset($error5) ? $error5 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($nidErr) ? $nidErr : '' ;?></span>
            </p>
            <input name="nid" class="form-field" type="text" placeholder="National id" value="<?php if(isset($_POST['nid'])) {echo htmlentities($_POST['nid']);} ?>"> -->

            <p class="form-text">Phone :
                <span class="error" style="color: red;"><?php echo isset($error6) ? $error6 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($phoneErr) ? $phoneErr : '' ;?></span>
            </p>
            <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php if(isset($_POST['phone'])) {echo htmlentities($_POST['phone']);} ?>">

            <p class="form-text">Email :
                <span class="error" style="color: red;"><?php echo isset($error7) ? $error7 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($emailErr) ? $emailErr : '' ;?></span>
            </p>
            <input name="email" class="form-field" type="text" placeholder="Email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>">
            
            <p class="form-text">Appointment Schedule :
                <span class="error" style="color: red;"><?php echo isset($error8) ? $error8 : '' ;?></span>
                <span class="error" style="color: red;"><?php echo isset($errorDate) ? $errorDate : '' ;?></span>
            </p>  
            <input name="schedule" class="form-field" type="date" value="<?php if(isset($_POST['schedule'])) {echo htmlentities($_POST['schedule']);} ?>">

            <input type="submit" name="submit" id="submit" value="Become Donar" class="form-field">
        </form>
    </div>
</div>

<?php require_once('footer.php')?>