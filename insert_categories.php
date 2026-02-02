<?php
include "connect.php";

/* =========================
   INSERT CATEGORIES
========================= */

$sql = "
INSERT INTO categories (category_name) VALUES
('Buns'),
('Patties'),
('Cheese'),
('Veggies'),
('Sauces'),
('Add-ons'),
('Sides'),
('Drinks'),
('Packaging'),
('Consumables'),
('Cooking Agents & Seasoning')
";

if ($mysqli->query($sql)) {
    echo "Categories inserted successfully!";
} else {
    echo "Error inserting categories: " . $mysqli->error;
}

$mysqli->close();
?>
