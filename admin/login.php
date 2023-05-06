<?php session_start(); ?>
<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">

</head>
<?php
if (!empty($_SESSION['user'])) {
    header('Location: home.php');
}
/*if(isset($_POST['submit']))
    {
        login();
    }*/ if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
) {
    if (empty($_POST['username'])) {
        $error1 = '*Required';
    } else {
        $username = test_input($_POST['username']);
        if (!preg_match('/^([A-Za-z0-9-_]+)$/', $username)) {
            $usernameErr = '*Only letters and No white space';
        }
    }
    if (empty($_POST['password'])) {
        $error2 = '*Required';
    }
    if (empty($usernameErr)) {
        login();
    }
}
function login()
{
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conn = oci_connect('oracle', '1234', 'localhost/orcl:data');
        $stid = oci_parse(
            $conn,
            "SELECT * FROM user_info WHERE username='$username' AND password='$password'"
        );
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_BOTH);
        if ($row) {
            if (
                $username == $row['USERNAME'] &&
                $password == $row['PASSWORD']
            ) {
                $_SESSION['user'] = $username;
                header('Location: home.php');
            } /*if($username === $row['USERNAME'] && $password === $row['PASSWORD']) {
            $_SESSION['user'] = $username;
            header('Location: home.php');
        }*/
        } else {
            echo "<p id=\"warning\">Invalid login and password !</p>";
        }
    } else {
        echo "<p id=\"warning\">Fill All The Information !</p>";
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]>-->
<!--[if !IE]> <!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Login</title>
	
	<style>
            body {
            background: url('images/1.jpg') no-repeat fixed center center;
            background-size: cover;
            font-family: Montserrat;
        }

        .logo {
            width: 213px;
            height: 36px;
            margin: 50px auto;
        }

        .login-block {
            width: 320px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            border-top: 5px solid #ff656c;
            margin: 0 auto;
        }

        .login-block h1 {
            text-align: center;
            color: #000;
            font-size: 18px;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .login-block input {
            width: 100%;
            height: 42px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            font-family: Montserrat;
            padding: 0 20px 0 50px;
            outline: none;
        }

        .login-block input#username {
            background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
            background-size: 16px 80px;
            color: #ba2916;
        }

        .login-block input#username:focus {
            background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#password {
            background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#password:focus {
            background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input:active, .login-block input:focus {
            border: 1px solid #ff656c;
        }

        #login_submit {
            width: 100%;
            height: 40px;
            background: #ff656c;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #e15960;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            font-family: Montserrat;
            outline: none;
            cursor: pointer;
            padding-right: 45px;
        }

        #login_submit:hover {
            background: #ba2916;
        }

        #warning {
            background: red;
            padding: 15px 25px;
            width: 220px;
            margin: 0 auto;
            color: white;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }


    </style>

</head>

<body>

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <div class="logo"></div>
        <div class="login-block">
           <form action="login.php" method="post" name="loginform" id="loginform" >
                <h1>Blood Bank <br> Management System</h1>
                <span class="error" style="color: red;"><?php echo isset(
                    $check_login
                )
                    ? $check_login
                    : ''; ?></span>
                    <span class="error" style="color: red;"><?php echo isset(
                        $error1
                    )
                        ? $error1
                        : ''; ?></span>
                    <span class="error" style="color: red;"><?php echo isset(
                        $usernameErr
                    )
                        ? $usernameErr
                        : ''; ?></span>
                <input name="username" type="text" value="" placeholder="Username" id="username" />
                    <span class="error" style="color: red;"><?php echo isset(
                        $error2
                    )
                        ? $error2
                        : ''; ?></span>
                <input name="password" type="password" value="" placeholder="Password" id="password" />
                <input id="login_submit" type="submit" name="submit" value="Login">
            </form>
        </div>

</body> 

</html>

