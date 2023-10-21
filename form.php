<?php
require_once "db.php";

//  Register button clicked//
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Register'])) {
    //Fetch data from html form
        $name = $POST['name'];
        $surname = $POST['surname'];
        $username = $POST['username'];
        $pwd = $POST['pwd'];
        $email = $POST['email'];
        $created_at = $POST['created_at'];
        $

//   Validate the data before accepting it into the system
        if (empty($name) || empty($surname) || empty($username) || empty($pwd) || empty($email) || empty($created_at)) {
            $error = 'Please fill in the all the fields';
        } else {
            // check if the email already is registered
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
                $error = 'email already exists.Please choose a different email.';
            } else {
//    Hash or hide the passowrd
                $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

//    Insert the user into the database
                $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
                if (mysqli_query($conn, $query)) {
                    $sucess = 'Registration successful! Please log in.';
                } else {
                    $error = 'error: ' . mysqli_error($conn);
                }
            }    
        }
    }

//  Log in button clicked//
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Login'])) {
    //Fetch data from html form
        $email = $POST['email'];
        $pwd = $POST['pwd'];

//   Validate the data before accepting it into the system
        if (empty($email) || empty($pwd)) {
            $error = 'Please fill in the all the fields';
        } else {
//   Retrive the user from the database 
     $query = "SELECT FROM users WHERE email = '$email'";
     $result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
     
// Verify the password
            if (password_verify($pwd, $user['pwd'])) {
                $sucess = 'Login successful.';
            } else {
                $error = 'Invalid email or pwd.';
            } else {
                $error = 'Invalid email or pwd.';
            }
     }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration & Login</title>
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <main class="main">
        <img src="/logo.png" height="180" width="400" alt="techeduconnectlogo" class="logo">
        <div class="buttons_container" style="display: flex;">
            <div class="left">
                <h2>Create a new Account</h2>
                <button id="createAccountBtn">New Account</button>
            </div>
            <div class="right">
                <h2>Login As</h2>
                <button id="educatorLoginBtn">Educator</button>
                <button id="learnerLoginBtn">Learner</button>
            </div>
        </div>

        <!-- Create Account Modal -->
        <div class="modal_container" style="display: none;">
            <div class="modal">
                <h2>Create an Account</h2>
                <?php if (isset($error) && isset($_POST['register'])) { ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php} ?>

                <?php if (isset($error) && isset($_POST['register'])) { ?>
                    <p style="color: green;"><?php echo $success; ?></p>
                <?php} ?>

                <form method="POST" action="">
                <input type="text" placeholder="Name">
                <input type="text" placeholder="email">
                <input type="password" placeholder="password">
                <button type="submit">Register</button>
                <button class="close_btn" id="closeCreateAccountBtn">X</button>
                </form>
            </div>
        </div>

        <!-- Login As Educator Modal -->
        <div class="modal_container" style="display: none;">
            <div class="modal">
                <h2>Educator Login</h2>
                <?php if (isset($error) && isset($_POST['register'])) { ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php} ?>

                <?php if (isset($error) && isset($_POST['register'])) { ?>
                    <p style="color: green;"><?php echo $success; ?></p>
                <?php} ?>

                <form method="POST" action="">
                <input type="text" placeholder="email">
                <input type="password" placeholder="password">
                <span>Forgot Password?</span>
                <button type="submit">Login</button>
                <button class="close_btn" id="closeEducatorLoginBtn">X</button>
                </form>
            </div>
        </div>

        <!-- Login As Learner Modal -->
        <div class="modal_container" style="display: none;">
            <div class="modal">
                <h2>Learner Login</h2>
                <?php if (isset($error) && isset($_POST['register'])) { ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php} ?>

                <?php if (isset($error) && isset($_POST['register'])) { ?>
                    <p style="color: green;"><?php echo $success; ?></p>
                <?php} ?>

                <form method="POST" action="">
                <input type="text" placeholder="email">
                <input type="password" placeholder="password">
                <span>Forgot Password?</span>
                <button type="submit">Login</button>
                <button class="close_btn" id="closeLearnerLoginBtn">X</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        // JavaScript code here
        const createAccountBtn = document.getElementById("createAccountBtn");
        const closeCreateAccountBtn = document.getElementById("closeCreateAccountBtn");
        const educatorLoginBtn = document.getElementById("educatorLoginBtn");
        const closeEducatorLoginBtn = document.getElementById("closeEducatorLoginBtn");
        const learnerLoginBtn = document.getElementById("learnerLoginBtn");
        const closeLearnerLoginBtn = document.getElementById("closeLearnerLoginBtn");
        const createAccountModal = document.querySelector(".modal_container");
        const educatorModal = document.querySelectorAll(".modal_container")[1];
        const learnerModal = document.querySelectorAll(".modal_container")[2];

        createAccountBtn.addEventListener("click", () => {
            createAccountModal.style.display = "flex";
        });

        closeCreateAccountBtn.addEventListener("click", () => {
            createAccountModal.style.display = "none";
        });

        educatorLoginBtn.addEventListener("click", () => {
            educatorModal.style.display = "flex";
        });

        closeEducatorLoginBtn.addEventListener("click", () => {
            educatorModal.style.display = "none";
        });

        learnerLoginBtn.addEventListener("click", () => {
            learnerModal.style.display = "flex";
        });

        closeLearnerLoginBtn.addEventListener("click", () => {
            learnerModal.style.display = "none";
        });
    </script>
</body>
</html>
