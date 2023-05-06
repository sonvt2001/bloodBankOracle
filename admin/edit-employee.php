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
            edit_employee();
        }
    }

    function edit_employee()
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
                
            global $e; 
            $query = "UPDATE employee SET b_id ='$branch', emp_name ='$name', emp_salary ='$salary', emp_address ='$address', emp_area ='$area', emp_role ='$role', phone ='$phone', email ='$email' WHERE emp_id =".$e;

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

<?php
    global $e;
   $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
            
        $query = 'SELECT * FROM employee WHERE emp_id ='.$e;
        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                
    ?>

<div class="donor-section">
    <h1 class="menu-title">Edit Employee: </h1>
    <a href="employee.php" class="hlink cat-link">Back to Employee List</a>
    
        <form id="add-donor-form" name="donorform" action="edit-employee.php?e=<?php echo $e;?>" method="post">
       <br>
        <p class="form-text">Employee Name : 
            <span class="error" style="color: red;"><?php echo isset($error1) ? $error1 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : '' ;?></span>
        </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['EMP_NAME']?>">
        
        <p class="form-text">Salary : 
            <span class="error" style="color: red;"><?php echo isset($error2) ? $error2 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($salaryErr) ? $salaryErr : '' ;?></span>
        </p>
        <input name="salary" class="form-field" type="text" placeholder="Salary" value="<?php echo $row['EMP_SALARY']?>">
        
        <p class="form-text">Area : 
            <span class="error" style="color: red;"><?php echo isset($error3) ? $error3 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($areaErr) ? $areaErr : '' ;?></span>
        </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php echo $row['EMP_AREA']?>">
        
        <p class="form-text">Address : 
            <span class="error" style="color: red;"><?php echo isset($error4) ? $error4 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($addressErr) ? $addressErr : '' ;?></span>
        </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address" ><?php echo $row['EMP_ADDRESS']?></textarea>
        
        <p id="pcat" class="form-text">Select Branch : </p>
             <select name="branch" style="width: 100%;">
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
        
        <p class="form-text">Role : 
            <span class="error" style="color: red;"><?php echo isset($error5) ? $error5 : '' ;?></span>
            <span class="error" style="color: red;"><?php echo isset($roleErr) ? $roleErr : '' ;?></span>
        </p>
        <input name="role" class="form-field" type="text" placeholder="Role" value="<?php echo $row['EMP_ROLE']?>">
        
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
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update Employee" class="form-field">
        
    </form>
</div>
<?php 
    }
?>

<?php require_once('footer.php')?>
