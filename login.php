### login.php ###

```
<?php
session_start();
require_once 'config.php';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Gunakan fungsi PASSWORD() untuk mencocokkan dengan hash di database
    $query = "SELECT * FROM users WHERE username='$username' AND password=PASSWORD('$password')";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
            
        header("Location: index.php");
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div style="width: 100%; max-width: 400px; margin: 100px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">
        <h2 style="text-align: center; color: #007bff;">Login Form</h2>

        <?php if(isset($error)) { ?>
            <p style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php } ?>
        
        <form action="" method="POST" style="text-align: center;">
            <div style="margin-bottom: 15px;">
                <label for="username" style="font-weight: bold; color: #333;">Username:</label>
                <input type="text" id="username" name="username" required style="padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="font-weight: bold; color: #333;">Password:</label>
                <input type="password" id="password" name="password" required style="padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div>
                <input type="submit" name="login" value="Login" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            </div>
        </form>
    </div>
</body>
</html>

```
