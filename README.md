# Road Freight Transportation Management System

## Overview

The Road Freight Transportation Management System is designed for a transportation company to efficiently manage its fleet of trucks, employees, customers, shipments, and trips. The system allows for easy tracking of truck attributes, employee roles (drivers and mechanics), shipment details, and trip records.

## Features

- **Truck Management**: Track truck details such as brand, load capacity, year, and repair history.
- **Employee Management**: Manage employee details, including roles as drivers and mechanics.
- **Repair Tracking**: Log truck repairs along with the mechanics responsible and estimated repair times.
- **Shipment Management**: Receive and manage shipments from customers, detailing weights, values, origins, and destinations.
- **Trip Management**: Record trips with details about routes, trucks, and driver participation.

## Database Schema

The database consists of the following tables:

- `customers`
- `employees`
- `drivers`
- `mechanics`
- `repairs`
- `shipments`
- `trucks`
- `trucktrips`
- `tripdrivers`
- `tripshipments`

### Database Structure

```sql
-- SQL Dump of the database (truckmanagment)

-- Database: `truckmanagment`

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber1` varchar(20) DEFAULT NULL,
  `PhoneNumber2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Surname` varchar(100) DEFAULT NULL,
  `Seniority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `drivers` (
  `DriverID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `mechanics` (
  `MechanicID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `SpecializedBrand` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `repairs` (
  `RepairID` int(11) NOT NULL,
  `TruckID` int(11) DEFAULT NULL,
  `MechanicID` int(11) DEFAULT NULL,
  `EstimatedRepairTimeDays` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `shipments` (
  `ShipmentID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Weight` decimal(10,2) DEFAULT NULL,
  `Value` decimal(10,2) DEFAULT NULL,
  `Origin` varchar(255) DEFAULT NULL,
  `Destination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `trucks` (
  `TruckID` int(11) NOT NULL,
  `Brand` varchar(100) DEFAULT NULL,
  `Load_1` decimal(10,2) DEFAULT NULL,
  `Capacity` decimal(10,2) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `NumberOfRepairs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `trucktrips` (
  `TripID` int(11) NOT NULL,
  `TruckID` int(11) DEFAULT NULL,
  `RouteFrom` varchar(255) DEFAULT NULL,
  `RouteTo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tripdrivers` (
  `TripID` int(11) DEFAULT NULL,
  `DriverID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tripshipments` (
  `TripID` int(11) DEFAULT NULL,
  `ShipmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

###Pages

customers.php
Manage customer information (Create, Read, Update, Delete).
Fields: Name, Address, Phone Numbers.
mechanics.php
Manage mechanic details (Create, Read, Update, Delete).
Fields: Employee ID, Specialized Brand.
Manage Repairs
Record and manage truck repairs (Create, Read, Update, Delete).
Fields: Truck ID, Mechanic ID, Estimated Repair Time.
truck.php
Manage truck information (Create, Read, Update, Delete).
Fields: Brand, Load, Capacity, Year, Number of Repairs.

-- Start transaction for migration

START TRANSACTION;

-- --------------------------------------------------------
-- Data Migration for `customers`
-- --------------------------------------------------------
INSERT INTO `customers` (`CustomerID`, `Name`, `Address`, `PhoneNumber1`, `PhoneNumber2`) VALUES
(1, 'Alice Smith', '1234 Maple Ave, Milton', '555-1111', '555-2222'),
(2, 'Bob Johnson', '5678 Oak St, Milton', '555-3333', '555-4444'),
(3, 'Charlie Brown', '9101 Pine Dr, Oakville', '555-5555', '555-6666');

-- --------------------------------------------------------
-- Data Migration for `employees`
-- --------------------------------------------------------
INSERT INTO `employees` (`EmployeeID`, `Name`, `Surname`, `Seniority`) VALUES
(1, 'David', 'Williams', 5),
(2, 'Emily', 'Clark', 4),
(3, 'Frank', 'Miller', 3);

-- --------------------------------------------------------
-- Data Migration for `drivers`
-- --------------------------------------------------------
INSERT INTO `drivers` (`DriverID`, `EmployeeID`, `Category`) VALUES
(1, 1, 'Class A'),
(2, 2, 'Class B'),
(3, 3, 'Class C');

-- --------------------------------------------------------
-- Data Migration for `mechanics`
-- --------------------------------------------------------
INSERT INTO `mechanics` (`MechanicID`, `EmployeeID`, `SpecializedBrand`) VALUES
(1, 1, 'Volvo'),
(2, 2, 'Honda'),
(3, 3, 'Toyota');

-- --------------------------------------------------------
-- Data Migration for `trucks`
-- --------------------------------------------------------
INSERT INTO `trucks` (`TruckID`, `Brand`, `Load_1`, `Capacity`, `Year`, `NumberOfRepairs`) VALUES
(1, 'Volvo FH', 9000.00, 16000.00, 2019, 1),
(2, 'Scania R', 8500.00, 15000.00, 2018, 2),
(3, 'Mercedes Actros', 8000.00, 14000.00, 2020, 0);

-- --------------------------------------------------------
-- Data Migration for `repairs`
-- --------------------------------------------------------
INSERT INTO `repairs` (`RepairID`, `TruckID`, `MechanicID`, `EstimatedRepairTimeDays`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 1),
(3, 3, 3, 3);

-- --------------------------------------------------------
-- Data Migration for `shipments`
-- --------------------------------------------------------
INSERT INTO `shipments` (`ShipmentID`, `CustomerID`, `Weight`, `Value`, `Origin`, `Destination`) VALUES
(1, 1, 200.00, 1000.00, 'Milton', 'Toronto'),
(2, 2, 300.00, 1500.00, 'Milton', 'Hamilton'),
(3, 3, 150.00, 500.00, 'Oakville', 'Mississauga');

-- --------------------------------------------------------
-- Data Migration for `trucktrips`
-- --------------------------------------------------------
INSERT INTO `trucktrips` (`TripID`, `TruckID`, `RouteFrom`, `RouteTo`) VALUES
(1, 1, 'Milton', 'Toronto'),
(2, 2, 'Oakville', 'Hamilton'),
(3, 3, 'Mississauga', 'Brampton');

-- --------------------------------------------------------
-- Data Migration for `tripdrivers`
-- --------------------------------------------------------
INSERT INTO `tripdrivers` (`TripID`, `DriverID`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------
-- Data Migration for `tripshipments`
-- --------------------------------------------------------
INSERT INTO `tripshipments` (`TripID`, `ShipmentID`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Commit transaction
COMMIT;

