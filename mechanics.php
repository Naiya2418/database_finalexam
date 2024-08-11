<?php
include 'config.php';

// Handle Create Operation
if (isset($_POST['create'])) {
    $employeeID = $_POST['EmployeeID'];
    $specializedBrand = $_POST['SpecializedBrand'];

    try {
        $stmt = $pdo->prepare("INSERT INTO mechanics (EmployeeID, SpecializedBrand) VALUES (?, ?)");
        $stmt->execute([$employeeID, $specializedBrand]);
        $message = 'Mechanic record created successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Update Operation
if (isset($_POST['update'])) {
    $mechanicID = $_POST['MechanicID'];
    $employeeID = $_POST['EmployeeID'];
    $specializedBrand = $_POST['SpecializedBrand'];

    try {
        $stmt = $pdo->prepare("UPDATE mechanics SET EmployeeID = ?, SpecializedBrand = ? WHERE MechanicID = ?");
        $stmt->execute([$employeeID, $specializedBrand, $mechanicID]);
        $message = 'Mechanic record updated successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Delete Operation
if (isset($_POST['delete'])) {
    $mechanicID = $_POST['MechanicID'];

    try {
        $stmt = $pdo->prepare("DELETE FROM mechanics WHERE MechanicID = ?");
        $stmt->execute([$mechanicID]);
        $message = 'Mechanic record deleted successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Read Mechanics
try {
    $stmt = $pdo->query("SELECT * FROM mechanics");
    $mechanics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mechanics</title>
    <style>
        /* Same styles as previous pages */
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
            <h1>Manage Mechanics</h1>
            <nav>
                <a href="customers.php">Manage Customers</a> | 
                <a href="trucks.php">Manage Trucks</a> | 
                <a href="repairs.php">Manage Repairs</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Create Mechanic Form -->
        <h2>Create Mechanic Record</h2>
        <form action="mechanics.php" method="POST">
            <label for="EmployeeID">Employee ID:</label>
            <input type="number" id="EmployeeID" name="EmployeeID" required>

            <label for="SpecializedBrand">Specialized Brand:</label>
            <input type="text" id="SpecializedBrand" name="SpecializedBrand" required>

            <button type="submit" name="create">Create Mechanic</button>
        </form>

        <!-- Update Mechanic Form -->
        <h2>Update Mechanic Record</h2>
        <form action="mechanics.php" method="POST">
            <label for="update-MechanicID">Mechanic ID:</label>
            <input type="number" id="update-MechanicID" name="MechanicID" required>

            <label for="update-EmployeeID">Employee ID:</label>
            <input type="number" id="update-EmployeeID" name="EmployeeID" required>

            <label for="update-SpecializedBrand">Specialized Brand:</label>
            <input type="text" id="update-SpecializedBrand" name="SpecializedBrand" required>

            <button type="submit" name="update">Update Mechanic</button>
        </form>

        <!-- Delete Mechanic Form -->
        <h2>Delete Mechanic Record</h2>
        <form action="mechanics.php" method="POST">
            <label for="delete-MechanicID">Mechanic ID:</label>
            <input type="number" id="delete-MechanicID" name="MechanicID" required>

            <button type="submit" name="delete">Delete Mechanic</button>
        </form>

        <!-- Display Mechanics -->
        <h2>Mechanics List</h2>
        <table>
            <tr>
                <th>Mechanic ID</th>
                <th>Employee ID</th>
                <th>Specialized Brand</th>
            </tr>
            <?php foreach ($mechanics as $mechanic): ?>
            <tr>
                <td><?php echo htmlspecialchars($mechanic['MechanicID']); ?></td>
                <td><?php echo htmlspecialchars($mechanic['EmployeeID']); ?></td>
                <td><?php echo htmlspecialchars($mechanic['SpecializedBrand']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
