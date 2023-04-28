<?php include "template.php";
/** @var $conn */
?>
<title>User Registration</title>
<h1 class='text-primary'>User Registration</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->

            <div class="col-md-6">
                <h2>Account Details</h2>
                <p>Please enter wanted username and password:</p>
                <p>Email Address<input type="text" name="username" class="form-control" required="required"></p>
                <p>Password<input type="password" name="password" class="form-control" required="required"></p>

            </div>
            <div class="col-md-6">
                <h2>More Details</h2>
                <!--Product List-->
                <p>Please enter More Personal Details:</p>
                <p>Name<input type="text" name="FirstName" class="form-control" required="required"></p>
                <p>Second<input type="password" name="password" class="form-control" required="required"></p>
                <p>Address<input type="text" name="Address" class="form-control" required="required"></p>
                <p>Phone Number<input type="text" name="PhoneNumber" class="form-control" required="required"></p>

            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitiseData($_POST['username']);
    $password = sanitiseData($_POST['password']);
    $FirstName = sanitiseData($_POST['firstname']);
    $SecondName = sanitiseData($_POST['secondname']);
    $address = sanitiseData($_POST['address']);
    $phonenumber = sanitiseData($_POST['phonenumber']);

    // Check if username/email address already exists in the database
$query = $conn->query("SELECT COUNT(*) FROM Customers WHERE EmailAddress='$username'");
$data = $query->fetchArray();
$numberOfUsers = (int)$data(0);

if ($numberOfUsers > 0) {
    echo "Sorry, an imposta has stolen your name";
} else {
    // the username has entered is unique ( doesn't already exist )
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sqlStmt = $conn->prepare("INSERT INTO Customers (EmailAddress,HashedPassword, FirstName, SecondName, Address, PhoneNumber )VALUES ((:EmailAddress :HashedPassword ,FirstName ,SecondName :Address :PhoneNumber)");
    $sqlStmt->bindParam(':EmailAddress', $username);
    $sqlStmt->bindParam('HashedPassword', $hashedPassword);
    $sqlStmt->bindParam('FirstName', $FirstName);
    $sqlStmt->bindParam('SecondName', $SecondName);
    $sqlStmt->bindParam('Address', $Address);
    $sqlStmt->bindParam('PhoneNumber', $PhoneNumber);
    $sqlStmt->execute();

}

}
?>