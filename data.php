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
