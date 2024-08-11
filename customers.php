<?php
include 'config.php';

// Initialize message variable
$message = '';

// Handle Create Operation
if (isset($_POST['create'])) {
    $customerID = $_POST['CustomerID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneNumber1 = $_POST['phoneNumber1'];
    $phoneNumber2 = $_POST['phoneNumber2'];

    try {
        $stmt = $pdo->prepare("INSERT INTO customers (CustomerID, Name, Address, PhoneNumber1, PhoneNumber2) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$customerID, $name, $address, $phoneNumber1, $phoneNumber2]);
        $message = 'Customer created successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Update Operation
if (isset($_POST['update'])) {
    $customerID = $_POST['CustomerID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneNumber1 = $_POST['phoneNumber1'];
    $phoneNumber2 = $_POST['phoneNumber2'];

    try {
        $stmt = $pdo->prepare("UPDATE customers SET Name = ?, Address = ?, PhoneNumber1 = ?, PhoneNumber2 = ? WHERE CustomerID = ?");
        $stmt->execute([$name, $address, $phoneNumber1, $phoneNumber2, $customerID]);
        $message = 'Customer updated successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Delete Operation
if (isset($_POST['delete'])) {
    $customerID = $_POST['CustomerID'];

    try {
        $stmt = $pdo->prepare("DELETE FROM customers WHERE CustomerID = ?");
        $stmt->execute([$customerID]);
        $message = 'Customer deleted successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Read Customers
try {
    $stmt = $pdo->query("SELECT * FROM customers");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #ccc 1px solid;
            text-align: center;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        form {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin: 10px 0 5px;
        }
        form input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            background: #333;
            color: #fff;
            border: 0;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        form button:hover {
            background: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f4f4f4;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Manage Customers</h1>
            <nav>
                <a href="trucks.php">Manage Trucks</a> | 
                 <a href="mechanics.php">Manage Mechanics</a>| 
                <a href="repairs.php">Manage Repairs</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Create Customer Form -->
        <h2>Create Customer</h2>
        <form action="customers.php" method="POST">
            <label for="CustomerID">Customer ID:</label>
            <input type="number" id="CustomerID" name="CustomerID" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phoneNumber1">Phone Number 1:</label>
            <input type="text" id="phoneNumber1" name="phoneNumber1" required>

            <label for="phoneNumber2">Phone Number 2:</label>
            <input type="text" id="phoneNumber2" name="phoneNumber2" required>

            <button type="submit" name="create">Create Customer</button>
        </form>

        <!-- Update Customer Form -->
        <h2>Update Customer</h2>
        <form action="customers.php" method="POST">
            <label for="update-CustomerID">Customer ID:</label>
            <input type="number" id="update-CustomerID" name="CustomerID" required>

            <label for="update-name">Name:</label>
            <input type="text" id="update-name" name="name" required>

            <label for="update-address">Address:</label>
            <input type="text" id="update-address" name="address" required>

            <label for="update-phoneNumber1">Phone Number 1:</label>
            <input type="text" id="update-phoneNumber1" name="phoneNumber1" required>

            <label for="update-phoneNumber2">Phone Number 2:</label>
            <input type="text" id="update-phoneNumber2" name="phoneNumber2" required>

            <button type="submit" name="update">Update Customer</button>
        </form>

        <!-- Delete Customer Form -->
        <h2>Delete Customer</h2>
        <form action="customers.php" method="POST">
            <label for="delete-CustomerID">Customer ID:</label>
            <input type="number" id="delete-CustomerID" name="CustomerID" required>

            <button type="submit" name="delete">Delete Customer</button>
        </form>

        <!-- Display Customers -->
        <h2>Customers List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number 1</th>
                <th>Phone Number 2</th>
            </tr>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo htmlspecialchars($customer['CustomerID']); ?></td>
                <td><?php echo htmlspecialchars($customer['Name']); ?></td>
                <td><?php echo htmlspecialchars($customer['Address']); ?></td>
                <td><?php echo htmlspecialchars($customer['PhoneNumber1']); ?></td>
                <td><?php echo htmlspecialchars($customer['PhoneNumber2']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
