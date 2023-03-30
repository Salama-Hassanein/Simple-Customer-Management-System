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

$customer_id = $customer_data[0]; // get the customer ID from the data
$firstname = $customer_data[1];
$lastname = $customer_data[2];
$email = $customer_data[3];
$gender = $customer_data[4];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // make sure the ID in the URL parameter matches the ID in the customer data
    if ($id != $customer_id) {
        header("Location: index.php");
        exit();
    }

    // update customer data in file
    $new_customer_data = $customer_id . ',' . $_POST['firstname'] . ',' . $_POST['lastname'] . ',' . $_POST['email'] . ',' . $_POST['gender'] . "\n";

    // replace the old customer data with the new one
    $file_contents = file_get_contents('customers.txt');
    $file_contents = str_replace($line, $new_customer_data, $file_contents);
    file_put_contents('customers.txt', $file_contents);

    header("Location: display.php");
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Edit customer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit customer</h2>
        <form method="post">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastname ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($gender == 'male') echo 'checked' ?>>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($gender == 'female') echo 'checked' ?>>
                    <label class="form-check-label" for="female">
                        Female
                    </label>


                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="display.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>