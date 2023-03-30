<?php
$id = $_GET['id'];
$customer_data = null;

// find the customer's data in the file
$fp = fopen('customers.txt', 'r');
while (!feof($fp)) {
    $line = fgets($fp);
    if (strpos($line, $id . ',') === 0) {
        $customer_data = explode(",", $line);
        break;
    }
}
fclose($fp);

if (!$customer_data) {
    // customer not found, redirect to index page
    header("Location: index.php");
    exit();
}

// remove customer from file
$customers = file("customers.txt");
$key = array_search($line, $customers);
if ($key !== false) {
    unset($customers[$key]);
    file_put_contents('customers.txt', implode('', $customers));
}

// redirect to index.php
header("Location: display.php");
exit();
