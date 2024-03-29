<?php include "template.php";
/** @var $conn */
?>
    <title>Contact Us</title>

<body>
<h1>Contact Us</h1>

<div class="container-fluid">
    <h1 class="text-primary">Please Send us a Message</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label for="contactEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="contactEmail" name="contactEmail"
                   placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="contactMessage" class="form-label">Message</label>
            <textarea class="form-control" id="contactMessage" name="contactMessage" rows="3"></textarea>
        </div>
        <button type="submit" name="formSubmit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php
if (empty($_POST['inputEmail'])) {
    $formError = true;
    echo "Enter an email address.";
}
if (empty($_POST['inputMessage'])) {
    $formError = true;
    echo "Enter a message to submit.";
}

if (isset($_POST['formSubmit'])) {
    $userEmail = sanitiseData($_POST['contactEmail']) ;
    $userMessage = sanitiseData($_POST['contactMessage']);

    $SQLStmt = $conn->prepare("INSERT INTO Contact (ContactEmail, ContactMessage)VALUES (:ContactEmail, :ContactMessage)");
    $SQLStmt->bindParam(':ContactEmail', $userEmail);
    $SQLStmt->bindParam('ContactMessage', $userMessage);
    $SQLStmt->execute();





// $csvFile = fopen("contact.csv","a");
// fwrite($csvFile,$userEmail.",".$userMessage."\n");
// fclose($csvFile);
}

?>


<?php echo footer() ?>
</body>
</html>

1
