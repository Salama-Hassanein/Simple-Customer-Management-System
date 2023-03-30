<!DOCTYPE html>
<html>

<head>
    <title>Customers List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 d-flex justify-content-between align-items-center">
        <h2 class=" my-2">Customers List</h2>
        <a href="index.php" class="btn btn-primary mb-3">Add New Customer</a>
    </div>
    <div class="container mt-5 ">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Read the file and display customers data in table
                $file_path = "customers.txt";
                if (file_exists($file_path)) {
                    $customers = file($file_path);

                    if (is_array($customers) || is_object($customers)) {
                        $id = 1;
                        foreach ($customers as $customer) {
                            $customer_data = explode(",", $customer);
                            $id = $customer_data[0];
                            $firstname = $customer_data[1];
                            $lastname = $customer_data[2];
                            $email = $customer_data[3];
                            $gender = $customer_data[4];
                            echo "<tr>";
                            echo "<td>$id</td>";
                            echo "<td>$firstname</td>";
                            echo "<td>$lastname</td>";
                            echo "<td>$email</td>";
                            echo "<td>$gender</td>";
                            echo "<td>
									<a href='edit.php?id=$id' class='btn btn-primary btn-sm'>Edit</a>
									<a href='delete.php?id=$id' class='btn btn-danger btn-sm'>Delete</a>
								</td>";
                            echo "</tr>";
                            $id++;
                        }
                    } else {
                        echo "Error: Invalid data type in file.";
                    }
                } else {
                    echo "Error: File not found.";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>