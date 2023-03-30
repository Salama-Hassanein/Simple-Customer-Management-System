<?php
$error = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = uniqid(); // generate a unique id for the new customer
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    if (empty($id) || empty($firstname) || empty($lastname) || empty($email) || empty($gender)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $file = fopen("customers.txt", "a+");
        fwrite($file, $id . "," . $firstname . "," . $lastname . "," . $email . "," . $gender . "\n");
        fclose($file);
        $successMessage = "Data saved successfully.";
        header("Location: display.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="my-3" style="margin-left: 30px;"> <a href="display.php" class="btn btn-primary ">Display
            Customers</a>
    </div>
    <div class="container">
        <h1 class="text-center mt-5 mb-4">Registration Form</h1>
        <?php
        if (!empty($error)) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
        if (!empty($successMessage)) {
            echo '<div class="alert alert-success">' . $successMessage . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="setId()">
            <input type="hidden" id="id" name="id" value="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        placeholder="Enter first name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
            <div class="container d-flex  justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </form>

        <script>
        function setId() {
            var idField = document.getElementById("id");
            idField.value = Math.random().toString(36).substr(2, 9); // generate a random id
        }
        </script>
    </div>

</body>