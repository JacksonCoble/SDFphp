<?php
include "template.php";
/**  @var $conn */
/*
 * The invoices page has a number of use cases to satisfy:
        1. If user is not logged in, then redirect them to index.php
        2. Users to view their "open" orders as a list.
        3. Users to view invoices from individual orders (using the order variable in url, e.g `invoice.php?order=234`)
        4. Inform users if they have not previously made any orders.
        5. Administrators to view all orders
        6. Administrators can OPEN and CLOSE orders

  @var $conn
 */
if (!isset($_SESSION["CustomerID"])) {
    // Case 1. The user is not logged in.
    header("Location:index.php");
}
if (empty($_GET["order"])) {
    // Case 2 - no 'order' variable detected in the url.
    $custID = $_SESSION['CustomerID'];
    if ($_SESSION["AccessLevel"] == 1) {
        // Case 5 - Generate a list of all invoices for administrators
        $query = $conn->query("SELECT OrderNumber FROM Order");
        $count = $conn->querySingle("SELECT OrderNumber FROM Order");
    } else {
        // Case 2 - Generate a list of open invoices for user
        $query = $conn->query("SELECT OrderNumber FROM Order WHERE CustomerID='$custID' AND Status='OPEN'");
        $count = $conn->querySingle("SELECT OrderNumber FROM Order WHERE customerID='$custID' AND status='OPEN'");
    }
    $orderCodesForUser = [];

    if ($count > 0) {  // Has the User made orders previously?
        // Case 2: Display open orders
        while ($data = $query->fetchArray()) {
            $orderCode = $data[0];
            array_push($orderCodesForUser, $orderCode);
        }
//Gets the unique order numbers from the extracted table above.
        $unique_orders = array_unique($orderCodesForUser);

    } else {
        // Case 4: No orders found for the logged in user.
        echo "<div class='badge bg-danger text-wrap fs-5'>You don't have any open orders. Please make an order to view them</div>";

    }
} else {
    // Case 3 - 'order' variable detected.
}
echo "<div class='container-fluid'>";
// Produce a list of links of the Orders for the user.
