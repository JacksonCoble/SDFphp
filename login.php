<?php

/**  @var $conn */

// the reason for these are quite simple to explain, the purpose once again is to simply give a space where the person can login.

if (isset($_POST['login'])) {
    $username = sanitiseData($_POST['username']);
    $password = sanitiseData($_POST['password']);


    $query = $conn->query("SELECT COUNT(*) as count, * FROM Customers WHERE `EmailAddress`='$username'");
    $row = $query->fetchArray();
    $count = $row['count'];

    // The code blow shows the customer where they can put in their infomation

    if ($count > 0) {
        if (password_verify($password, $row['HashedPassword'])) {
            $_SESSION["FirstName"] = $row['FirstName'];
            $_SESSION['EmailAddress'] = $row['EmailAddress'];
            $_SESSION['AccessLevel'] = $row['AccessLevel'];
            $_SESSION['CustomerID'] = $row['CustomerID'];
            $_SESSION["flash_message"] = "<div class='bg-success'>Login Successful</div>";
            header("location:index.php");
        } else {
            echo "<div class='alert alert-danger'>Invalid username or password</div>";
            $_SESSION["flash_message"] = "<div class='bg-danger'>Invalid Username or Password</div>";
            header("location:index.php");
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password</div>";
    }
}
?>