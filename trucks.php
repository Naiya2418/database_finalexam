<?php
include 'config.php';

// Initialize message variable
$message = '';

// Handle Create Operation
if (isset($_POST['create'])) {
    
    $brand = $_POST['brand'];
    $load_1 = $_POST['load_1'];
    $capacity = $_POST['capacity'];
    $year = $_POST['year'];
    $repairs = $_POST['repairs'];

    try {
        $stmt = $pdo->prepare("INSERT INTO Trucks (Brand, Load_1, Capacity, Year, NumberOfRepairs) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$brand, $load_1, $capacity, $year, $repairs]);
        $message = 'Truck created successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Update Operation
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $load_1 = $_POST['load_1'];
    $capacity = $_POST['capacity'];
    $year = $_POST['year'];
    $repairs = $_POST['repairs'];

    try {
        $stmt = $pdo->prepare("UPDATE Trucks SET Brand = ?, Load_1 = ?, Capacity = ?, Year = ?, NumberOfRepairs = ? WHERE TruckID = ?");
        $stmt->execute([$brand, $load_1, $capacity, $year, $repairs, $id]);
        $message = 'Truck updated successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Delete Operation
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM Trucks WHERE TruckID = ?");
        $stmt->execute([$id]);
        $message = 'Truck deleted successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Read Trucks
try {
    $stmt = $pdo->query("SELECT * FROM Trucks");
    $trucks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trucks</title>
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
            <h1>Manage Trucks</h1>
            <nav>
        <a href="customers.php">Manage Customers</a> | 
         <a href="mechanics.php">Manage Mechanics</a>| 
        <a href="repairs.php">Manage Repairs</a>
    </nav>
        </div>
    </header>

    <div class="container">
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Create Truck Form -->
        <h2>Create Truck</h2>
        <form action="trucks.php" method="POST">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>

            <label for="load_1">Load:</label>
            <input type="number" id="load_1" name="load_1" step="0.01" required>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" step="0.01" required>

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>

            <label for="repairs">Number of Repairs:</label>
            <input type="number" id="repairs" name="repairs" required>

            <button type="submit" name="create">Create Truck</button>
        </form>

        <!-- Update Truck Form -->
        <h2>Update Truck</h2>
        <form action="trucks.php" method="POST">
            <label for="update-id">Truck ID:</label>
            <input type="number" id="update-id" name="id" required>

            <label for="update-brand">Brand:</label>
            <input type="text" id="update-brand" name="brand" required>

            <label for="update-load">Load:</label>
            <input type="number" id="update-load" name="load_1" step="0.01" required>

            <label for="update-capacity">Capacity:</label>
            <input type="number" id="update-capacity" name="capacity" step="0.01" required>

            <label for="update-year">Year:</label>
            <input type="number" id="update-year" name="year" required>

            <label for="update-repairs">Number of Repairs:</label>
            <input type="number" id="update-repairs" name="repairs" required>

            <button type="submit" name="update">Update Truck</button>
        </form>

        <!-- Delete Truck Form -->
        <h2>Delete Truck</h2>
        <form action="trucks.php" method="POST">
            <label for="delete-id">Truck ID:</label>
            <input type="number" id="delete-id" name="id" required>

            <button type="submit" name="delete">Delete Truck</button>
        </form>

        <!-- Display Trucks -->
        <h2>Trucks List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Load</th>
                <th>Capacity</th>
                <th>Year</th>
                <th>Number of Repairs</th>
            </tr>
            <?php foreach ($trucks as $truck): ?>
            <tr>
                <td><?php echo htmlspecialchars($truck['TruckID']); ?></td>
                <td><?php echo htmlspecialchars($truck['Brand']); ?></td>
                <td><?php echo htmlspecialchars($truck['Load_1']); ?></td>
                <td><?php echo htmlspecialchars($truck['Capacity']); ?></td>
                <td><?php echo htmlspecialchars($truck['Year']); ?></td>
                <td><?php echo htmlspecialchars($truck['NumberOfRepairs']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
