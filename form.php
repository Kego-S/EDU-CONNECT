<?php
require_once "db.php";

// SignUp button clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
// Fetch data from the html form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

// Validate the data before accepting it into the system
    if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
        $error = 'Please fill in all the fields.';
    } else {
        // Check if the email is already registered
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $error = 'Email already exists. Please choose a different email.';
        } else {
// Hash or hide the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the user into the database
            $query = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$hashedPassword')";
            if (mysqli_query($conn, $query)) {
                $success = 'Registration successful! Please log in.';
            } else {
                $error = 'Error: ' . mysqli_error($conn);
            }
        }
    }
}

// Sign In button clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
// Fetch data from the html form
    $email = $_POST['email'];
    $password = $_POST['password'];

// Validate or check if the fields in the form are the right standard
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all the fields.';
    } else {
        // Retrieve the user from the database
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

// Verify the password
            if (password_verify($password, $user['password'])) {
                $success = 'Login successful!';
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
            $error = 'Invalid email or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup & Login</title>
    <style type="text/css">
        body {
                    background-color: darkgray;
                    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                    font-size: 14px;
                    line-height: 1.5;
                }
                form {
                    display: inline-block;
                }
      body form input{
     border: none;
     border-radius:5px !important;
    
      }
        </style>
</head>
<body>
    <h1>Signup</h1>

    <?php if (isset($error) && isset($_POST['signup'])) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($success) && isset($_POST['signup'])) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" class="inputs" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" class="inputs" id="email" name="email"><br><br>

        <label for="mobile">Mobile:</label><br>
        <input type="text" class="inputs" id="mobile" name="mobile"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" class="inputs" id="password" name="password"><br><br>

        <input type="submit" name="signup" value="Sign Up">
    </form>

    <hr>

    <h1>Login</h1>

    <?php if (isset($error) && isset($_POST['signin'])) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($success) && isset($_POST['signin'])) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" name="signin" value="Sign In">
    </form>
</body>
</html>
