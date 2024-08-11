<?php
// Database connection
include 'config.php';
// Handle Create Operation
if (isset($_POST['create'])) {
    $truckID = $_POST['TruckID'];
    $mechanicID = $_POST['MechanicID'];
    $estimatedRepairTimeDays = $_POST['EstimatedRepairTimeDays'];

    try {
        $stmt = $pdo->prepare("INSERT INTO repairs (TruckID, MechanicID, EstimatedRepairTimeDays) VALUES (?, ?, ?)");
        $stmt->execute([$truckID, $mechanicID, $estimatedRepairTimeDays]);
        $message = 'Repair record created successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Update Operation
if (isset($_POST['update'])) {
    $repairID = $_POST['RepairID'];
    $truckID = $_POST['TruckID'];
    $mechanicID = $_POST['MechanicID'];
    $estimatedRepairTimeDays = $_POST['EstimatedRepairTimeDays'];

    try {
        $stmt = $pdo->prepare("UPDATE repairs SET TruckID = ?, MechanicID = ?, EstimatedRepairTimeDays = ? WHERE RepairID = ?");
        $stmt->execute([$truckID, $mechanicID, $estimatedRepairTimeDays, $repairID]);
        $message = 'Repair record updated successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Handle Delete Operation
if (isset($_POST['delete'])) {
    $repairID = $_POST['RepairID'];

    try {
        $stmt = $pdo->prepare("DELETE FROM repairs WHERE RepairID = ?");
        $stmt->execute([$repairID]);
        $message = 'Repair record deleted successfully!';
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

// Read Repairs
try {
    $stmt = $pdo->query("SELECT * FROM repairs");
    $repairs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Repairs</title>
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
            <h1>Manage Repairs</h1>
            <nav>
                <a href="customers.php">Manage Customers</a> | 
                <a href="trucks.php">Manage Trucks</a> | 
                <a href="mechanics.php">Manage Mechanics</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Create Repair Form -->
        <h2>Create Repair Record</h2>
        <form action="repairs.php" method="POST">
            <label for="TruckID">Truck ID:</label>
            <input type="number" id="TruckID" name="TruckID" required>

            <label for="MechanicID">Mechanic ID:</label>
            <input type="number" id="MechanicID" name="MechanicID" required>

            <label for="EstimatedRepairTimeDays">Estimated Repair Time (Days):</label>
            <input type="number" id="EstimatedRepairTimeDays" name="EstimatedRepairTimeDays" required>

            <button type="submit" name="create">Create Repair</button>
        </form>

        <!-- Update Repair Form -->
        <h2>Update Repair Record</h2>
        <form action="repairs.php" method="POST">
            <label for="update-RepairID">Repair ID:</label>
            <input type="number" id="update-RepairID" name="RepairID" required>

            <label for="update-TruckID">Truck ID:</label>
            <input type="number" id="update-TruckID" name="TruckID" required>

            <label for="update-MechanicID">Mechanic ID:</label>
            <input type="number" id="update-MechanicID" name="MechanicID" required>

            <label for="update-EstimatedRepairTimeDays">Estimated Repair Time (Days):</label>
            <input type="number" id="update-EstimatedRepairTimeDays" name="EstimatedRepairTimeDays" required>

            <button type="submit" name="update">Update Repair</button>
        </form>

        <!-- Delete Repair Form -->
        <h2>Delete Repair Record</h2>
        <form action="repairs.php" method="POST">
            <label for="delete-RepairID">Repair ID:</label>
            <input type="number" id="delete-RepairID" name="RepairID" required>

            <button type="submit" name="delete">Delete Repair</button>
        </form>

        <!-- Display Repairs -->
        <h2>Repairs List</h2>
        <table>
            <tr>
                <th>Repair ID</th>
                <th>Truck ID</th>
                <th>Mechanic ID</th>
                <th>Estimated Repair Time (Days)</th>
            </tr>
            <?php foreach ($repairs as $repair): ?>
            <tr>
                <td><?php echo htmlspecialchars($repair['RepairID']); ?></td>
                <td><?php echo htmlspecialchars($repair['TruckID']); ?></td>
                <td><?php echo htmlspecialchars($repair['MechanicID']); ?></td>
                <td><?php echo htmlspecialchars($repair['EstimatedRepairTimeDays']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
