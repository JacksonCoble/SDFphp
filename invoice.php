<?php include "template.php" ?>
<title>Invoice</title>
<body>

<?php

$invoiceNumber = intval(sanitiseData($_GET["invoiceNumber"]));
echo $invoiceNumber;

// Read the contents of the file
$currentRow = 1;
if (($handle = fopen("orders.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($currentRow == $invoiceNumber) {

            $numberOfRowsOfData = count($data);
            $currentRow++; //Add one to the current row

// Customer Details
            $cusNameFirst = $data[0];
            $cusNameSecond = $data[1];
            $cusAddress = $data[2];
            $cusEmail = $data[3];
            $cusPhone = $data[4];

// Product Quantities
            $prod1Quantity = $data[5];
            $prod2Quantity = $data[6];
            $prod3Quantity = $data[7];
            $prod4Quantity = $data[8];
            $prod5Quantity = $data[9];
        }
        $currentRow++; //add one to the current row
    }
fclose($handle);    //Closes the File

    $prod1ItemCost = 10.00;
    $prod2ItemCost = 5.00;
    $prod3ItemCost = 45.00;
    $prod4ItemCost = 19.99;
    $prod5ItemCost = 79.99;

    $prod1SubTotal = $prod1Quantity * $prod1ItemCost;
    $prod2SubTotal = $prod2Quantity * $prod2ItemCost;
    $prod3SubTotal = $prod3Quantity * $prod3ItemCost;
    $prod4SubTotal = $prod4Quantity * $prod4ItemCost;
    $prod5SubTotal = $prod5Quantity * $prod5ItemCost;
    $invoiceTotal = $prod1SubTotal + $prod2SubTotal + $prod3SubTotal + $prod4SubTotal + $prod5SubTotal;
}
?>
<!--Customer Details-->
<h1 class="text-primary">Invoice</h1>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-secondary">Customer Details</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 text-primary">
            Customer Name
        </div>
        <div class="col-md-6 text-bg-light">
            <?= $cusNameFirst . " " . $cusNameSecond ?>
        </div>
        <div class="col-md-6 text-primary">
            Address
        </div>
        <div class="col-md-6 text-bg-light">
            <?= $cusAddress ?>
        </div>

        <div class="col-md-6 text-primary">
            Email
        </div>
        <div class="col-md-6 text-bg-light">
            <?= $cusEmail ?>
        </div>

        <div class="col-md-6 text-primary">
            Phone
        </div>
        <div class="col-md-6 text-bg-light">
            <?= $cusPhone ?>
        </div>
    </div>
</div>
<!--Products ordered -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-secondary">Products Ordered</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">Product 1</div>
        <div class="col-lg-3">$<?= $prod1ItemCost ?></div>
        <div class="col-lg-3"><?= $prod1Quantity ?></div>
        <div class="col-lg-3">$<?= $prod1SubTotal ?></div>
    </div>
    <div class="row">
        <div class="col-lg-3">Product 2</div>
        <div class="col-lg-3">$<?= $prod2ItemCost ?></div>
        <div class="col-lg-3"><?= $prod2Quantity ?></div>
        <div class="col-lg-3">$<?= $prod2SubTotal ?></div>
    </div>
    <div class="row">
        <div class="col-lg-3">Product 3</div>
        <div class="col-lg-3">$<?= $prod3ItemCost ?></div>
        <div class="col-lg-3"><?= $prod3Quantity ?></div>
        <div class="col-lg-3">$<?= $prod3SubTotal ?></div>
    </div>
    <div class="row">
        <div class="col-lg-3">Product 4</div>
        <div class="col-lg-3">$<?= $prod4ItemCost ?></div>
        <div class="col-lg-3"><?= $prod4Quantity ?></div>
        <div class="col-lg-3">$<?= $prod4SubTotal ?></div>
    </div>
    <div class="row">
        <div class="col-lg-3">Product 5</div>
        <div class="col-lg-3">$<?= $prod5ItemCost ?></div>
        <div class="col-lg-3"><?= $prod5Quantity ?></div>
        <div class="col-lg-3">$<?= $prod5SubTotal ?></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-secondary text-sm-end">$<?= $invoiceTotal ?></h2>
        </div>
    </div>
</div>

<?php echo footer() ?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>
