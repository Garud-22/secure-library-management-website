<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viweport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
</head>

<body>
    <?php
    $std_email_msg = "";
    $std_pass_msg = "";
    $msg = "";
    $admin_email_msg = "";
    $admin_pass_msg = "";
    if (!empty($_REQUEST['admin_email_msg'])) {
        $admin_email_msg = $_REQUEST['admin_email_msg'];
    }
    if (!empty($_REQUEST['admin_pass_msg'])) {
        $admin_pass_msg = $_REQUEST['admin_pass_msg'];
    }
    if (!empty($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
    }
    if (!empty($_REQUEST['std_email_msg'])) {
        $std_email_msg = $_REQUEST['std_email_msg'];
    }
    if (!empty($_REQUEST['std_pass_msg'])) {
        $std_pass_msg = $_REQUEST['std_pass_msg'];
    }
    ?>

    <div>
        <div style="text-align:center;color:red">
            <h4><?php echo $msg ?></h4>
        </div>
        <div class="flex-container">
            <div class="flex-child green">
                <form action="std_login_page.php" method="get">
                    <fieldset>
                        <legend>
                            <h2>Student Login</h2>
                        </legend>
                        <div class="form-style">
                            <input type="text" name="login_email" placeholder="Enter Email">
                        </div>
                        <label style="color:red"><?php echo $std_email_msg ?></label>
                        <div class="form-style">
                            <input type="password" name="login_pass" placeholder="Enter Password">
                        </div>
                        <label style="color:red"><?php echo $std_pass_msg ?></label>
                        <div class="form-style">
                            <input type="submit" class="login-btn" value="Login">
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="flex-child yellow">
                <form action="admin_login_page.php" method="get">
                    <fieldset>
                        <legend>
                            <h2>Administrator Login</h2>
                        </legend>
                        <div class="form-style">
                            <input type="text" name="login_email" placeholder="Enter Email">
                        </div>
                        <label style="color:red"><?php echo $admin_email_msg ?></label>
                        <div class="form-style">
                            <input type="password" name="login_pass" placeholder="Enter Password">
                        </div>
                        <label style="color:red"><?php echo $admin_pass_msg ?></label>
                        <div class="form-style">
                            <input type="submit" class="login-btn" value="Login">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</body>

</html>