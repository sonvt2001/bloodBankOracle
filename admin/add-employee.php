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

        if (empty($_POST["salary"])) 
        {
            $error2 = "*Required";
        } 
        else 
        {
            $salary = test_input($_POST["salary"]);
            if (!preg_match("/^[0-9]*$/",$salary)) 
            {
                $salaryErr = "Only numbers";
            }
        }

        if (empty($_POST["area"])) 
        {
            $error3 = "*Required";
        } 
        else 
        {
            $area = test_input($_POST["area"]);
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$area)) 
            {
                $areaErr = "Invalid Area";
            }
        }

        if(empty($_POST["address"]))
        {
            $error4 = "*Required";
        }
        else
        {
            $address = test_input($_POST["address"]);
            if (!preg_match("/(?i)([0-9A-ZẮẰẲẴẶĂẤẦẨẪẬÂÁÀÃẢẠĐẾỀỂỄỆÊÉÈẺẼẸÍÌỈĨỊỐỒỔỖỘÔỚỜỞỠỢƠÓÒÕỎỌỨỪỬỮỰƯÚÙỦŨỤÝỲỶỸỴ']+\\s?\\b){2,}/",$address)) 
            {
                $addressErr = "Invalid Address";
            }
        }

        if(empty($_POST["role"]))
        {
            $error5 = "*Required";
        }
        else
        {
            $role = test_input($_POST["role"]);
            if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]*$/",$role)) 
            {
                $roleErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["phone"])) 
        {
            $error6 = "*Required";
        } 
        else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/",$phone)) 
            {
                $phoneErr = "Invalid phone number";
            }
        }

        if (empty($_POST["email"])) 
        {
            $error7 = "*Required";
        } 
        else 
        {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $emailErr = "Invalid email format";
            }
        }
        
        if(empty($nameErr) && empty($salaryErr) && empty($addressErr) && empty($areaErr) && empty($roleErr) && empty($phoneErr) && empty($emailErr))
        {
            add_new_employee();
        }
    }

    function add_new_employee()
    {
        if(!empty($_POST['name']) && !empty($_POST['salary']) && !empty($_POST['area']) && !empty($_POST['address'])   && !empty($_POST['branch']) && !empty($_POST['role']) && !empty($_POST['phone']) && !empty($_POST['email'])) 
        {
            $name = $_POST['name'];
            $salary = $_POST['salary'];
            $area = $_POST['area'];
            $address = $_POST['address'];
            $branch = $_POST['branch'];
            $role = $_POST['role'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            
           $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
            $query = "INSERT INTO employee(emp_id, b_id, emp_name, emp_salary, emp_address, emp_area, emp_role, phone, email) VALUES (emp.nextval, $branch, '$name', '$salary', '$address', '$area', '$role', '$phone', '$email')";
            $stid = oci_parse($conn, $query);
            $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    //echo "Successfully added New Employee !";
                    //header('Location: employee.php');
                    echo "<script>window.location.href='employee.php';</script>";
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
    <h1 class="menu-title">Add New Employee: </h1>
    <a href="employee.php" class="hlink cat-link">Back to Employee List</a>
    
        <form id="add-donor-form" name="donorform" action="add-employee.php" method="post">
       <br>
        <p class="form-text">Employee Name : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
        </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php if(isset($_POST['name'])) {echo htmlentities($_POST['name']);} ?>">
        
        <p class="form-text">Salary : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($salaryErr) ? $salaryErr : '' ;?></span>
        </p>
        <input name="salary" class="form-field" type="text" placeholder="Salary" value="<?php if(isset($_POST['salary'])) {echo htmlentities($_POST['salary']);} ?>">
        
        <p class="form-text">Area : 
            <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($areaErr) ? $areaErr : '' ;?></span>
        </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php if(isset($_POST['area'])) {echo htmlentities($_POST['area']);} ?>">
        
        <p class="form-text">Address : 
            <span class="error" style="color: red;"><?php echo isset($error4) ? $error4 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($addressErr) ? $addressErr : '' ;?></span>
        </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php if(isset($_POST['address'])) {echo htmlentities($_POST['address']);} ?></textarea>
        
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
        
        <p class="form-text">Role : 
            <span class="error" style="color: red;"><?php echo isset($error5) ? $error5 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($roleErr) ? $roleErr : '' ;?></span>
        </p>
        <input name="role" class="form-field" type="text" placeholder="Role" value="<?php if(isset($_POST['role'])) {echo htmlentities($_POST['role']);} ?>">
        
        <p class="form-text">Phone : 
            <span class="error" style="color: red;"><?php echo isset($error6) ? $error6 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($phoneErr) ? $phoneErr : '' ;?></span>
        </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php if(isset($_POST['phone'])) {echo htmlentities($_POST['phone']);} ?>">
        
        <p class="form-text">Email : 
            <span class="error" style="color: red;"><?php echo isset($error7) ? $error7: '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($emailErr) ? $emailErr : '' ;?></span>
        </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Add New Employee" class="form-field">
        
    </form>
</div>

<?php require_once('footer.php')?>
