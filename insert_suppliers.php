<?php
$mysqli = new mysqli("localhost", "root", "", "bob_the_burger_inventory");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "
INSERT INTO suppliers (supplier_name, contact_person, contact_number, address) VALUES
('Gardenia Bakeries Philippines', 'Mark Reyes', '09171234567', 'Laguna, Philippines'),
('Universal Robina Corporation (URC)', 'Anna Cruz', '09181234567', 'Pasig City, Philippines'),
('San Miguel Foods', 'John Lim', '09191234567', 'Mandaluyong City, Philippines'),
('Purefoods-Hormel Company', 'Carlo Dizon', '09201234567', 'Quezon City, Philippines'),
('Magnolia Dairy Products', 'Rachel Santos', '09211234567', 'Taguig City, Philippines'),

('Divisoria Fresh Produce Traders', 'Pedro dela Cruz', '09221234567', 'Tondo, Manila'),
('Benguet Vegetable Suppliers', 'Leo Bautista', '09231234567', 'La Trinidad, Benguet'),

('NutriAsia Inc.', 'Michelle Go', '09241234567', 'Muntinlupa City, Philippines'),
('Monde Nissin Corporation', 'Kevin Tan', '09251234567', 'Makati City, Philippines'),

('Coca-Cola Beverages Philippines', 'Arvin Flores', '09261234567', 'Sta. Rosa, Laguna'),
('Asia Brewery Inc.', 'Ryan Ong', '09271234567', 'Pasay City, Philippines'),

('Paper & Packaging Specialists Inc.', 'Grace Uy', '09281234567', 'Valenzuela City, Philippines'),
('Mega Global Packaging Corp.', 'Dennis Chua', '09291234567', 'Caloocan City, Philippines'),

('Food Service Solutions PH', 'Paolo Ramirez', '09301234567', 'Quezon City, Philippines'),
('Metro Disposable Supplies', 'Nina Lopez', '09311234567', 'Pasig City, Philippines')
";

if ($mysqli->query($sql) === TRUE) {
    echo "Suppliers inserted successfully!";
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
