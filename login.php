<?php
include('config/constants.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>
<body>
<div id="main">
    <h1>Login</h1>
    <form method="post" class="login" >
        Username <input type="text" name="vardas" placeholder="Username:vardas" class="text" autocomplete="off" required>
        Password <input type="password" name="pass" placeholder="Password:pass" class="text" required>
        <input type="submit" name="login" id="sub">
    </form>
</div>

</body>
</html>
<?php
if (isset($_POST['login'])){
    $un=$_POST['vardas'];
    $pw=$_POST['pass'];

    if ($un=='vardas' && $pw=='pass'){
        header("location: index.php");
        exit();
    }
    else
        echo "Invalid username or password";

}

?>
