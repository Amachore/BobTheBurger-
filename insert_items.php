<?php
include "connect.php";

/*
CATEGORY IDs
1  Buns
2  Patties
3  Cheese
4  Veggies
5  Sauces
6  Add-ons
7  Sides
8  Drinks
9  Packaging
10 Consumables
11 Cooking Agents & Seasoning

STORAGE LOCATION IDs
1 Dry Storage
2 Refrigerator
3 Freezer
4 Prep Area
5 Cold Storage
6 Beverage Chiller
7 Packaging Area
*/

$sql = "
INSERT INTO purchase_order_items
(item_name, category_id, quantity, unit, price, expiration_date, location_id) VALUES

-- BUNS (expire)
('Sesame seed bun', 1, 100, 'pcs', 12.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 1),
('Brioche bun', 1, 100, 'pcs', 15.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 1),
('Whole wheat bun', 1, 80, 'pcs', 14.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 1),
('Lettuce wrap', 1, 80, 'pcs', 10.00, DATE_ADD(CURDATE(), INTERVAL 3 DAY), 2),
('Potato bun', 1, 100, 'pcs', 16.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 1),

-- PATTIES (frozen)
('Beef patty', 2, 60, 'pcs', 55.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Chicken patty', 2, 60, 'pcs', 45.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Fish fillet patty', 2, 50, 'pcs', 50.00, DATE_ADD(CURDATE(), INTERVAL 20 DAY), 3),

-- CHEESE (refrigerated)
('American cheese', 3, 80, 'slices', 20.00, DATE_ADD(CURDATE(), INTERVAL 14 DAY), 2),
('Cheddar cheese', 3, 80, 'slices', 22.00, DATE_ADD(CURDATE(), INTERVAL 14 DAY), 2),
('Swiss cheese', 3, 60, 'slices', 25.00, DATE_ADD(CURDATE(), INTERVAL 14 DAY), 2),
('Mozzarella cheese', 3, 60, 'slices', 24.00, DATE_ADD(CURDATE(), INTERVAL 10 DAY), 2),

-- VEGGIES (fresh)
('Lettuce', 4, 20, 'kg', 120.00, DATE_ADD(CURDATE(), INTERVAL 4 DAY), 2),
('Tomato', 4, 20, 'kg', 100.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 2),
('Onion (raw/grilled/caramelized)', 4, 20, 'kg', 90.00, DATE_ADD(CURDATE(), INTERVAL 10 DAY), 1),
('Pickles', 4, 15, 'kg', 130.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 1),
('Jalapeños', 4, 10, 'kg', 150.00, DATE_ADD(CURDATE(), INTERVAL 7 DAY), 2),
('Mushrooms', 4, 15, 'kg', 160.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 2),

-- SAUCES
('Ketchup', 5, 10, 'liters', 180.00, DATE_ADD(CURDATE(), INTERVAL 60 DAY), 1),
('Mustard', 5, 10, 'liters', 170.00, DATE_ADD(CURDATE(), INTERVAL 60 DAY), 1),
('Mayonnaise', 5, 10, 'liters', 200.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 2),
('BBQ sauce', 5, 8, 'liters', 220.00, DATE_ADD(CURDATE(), INTERVAL 60 DAY), 1),
('Hot sauce', 5, 6, 'liters', 210.00, DATE_ADD(CURDATE(), INTERVAL 90 DAY), 1),
('BOB burger sauce', 5, 8, 'liters', 250.00, DATE_ADD(CURDATE(), INTERVAL 20 DAY), 2),

-- ADD-ONS
('Bacon strips', 6, 10, 'kg', 420.00, DATE_ADD(CURDATE(), INTERVAL 15 DAY), 3),
('Fried egg', 6, 50, 'pcs', 15.00, DATE_ADD(CURDATE(), INTERVAL 3 DAY), 2),
('Extra patty', 6, 30, 'pcs', 55.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Onion rings', 6, 40, 'pcs', 20.00, DATE_ADD(CURDATE(), INTERVAL 10 DAY), 3),
('Hash brown', 6, 40, 'pcs', 18.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),

-- SIDES
('Fries (sour cream flavor)', 7, 25, 'kg', 180.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Fries (BBQ flavor)', 7, 25, 'kg', 180.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Fries (cheese flavor)', 7, 25, 'kg', 190.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Onion rings (side)', 7, 20, 'kg', 200.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),
('Hash browns (side)', 7, 20, 'kg', 190.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 3),

-- DRINKS
('Bottled Coca-Cola', 8, 120, 'bottles', 35.00, DATE_ADD(CURDATE(), INTERVAL 180 DAY), 6),
('Bottled Royal', 8, 120, 'bottles', 35.00, DATE_ADD(CURDATE(), INTERVAL 180 DAY), 6),
('Bottled Sprite', 8, 120, 'bottles', 35.00, DATE_ADD(CURDATE(), INTERVAL 180 DAY), 6),
('Iced tea (lemon)', 8, 80, 'packs', 25.00, DATE_ADD(CURDATE(), INTERVAL 120 DAY), 1),
('Red tea (powdered)', 8, 80, 'packs', 25.00, DATE_ADD(CURDATE(), INTERVAL 120 DAY), 1),
('Bottled water', 8, 150, 'bottles', 20.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 6),

-- PACKAGING (no expiration)
('Burger greaseproof paper', 9, 500, 'pcs', 2.00, NULL, 7),
('Burger box (clamshell)', 9, 300, 'pcs', 6.00, NULL, 7),
('French fry carton', 9, 300, 'pcs', 4.00, NULL, 7),
('Paper drink cup', 9, 300, 'pcs', 5.00, NULL, 7),
('Plastic cup lid', 9, 300, 'pcs', 2.00, NULL, 7),
('Paper straws', 9, 500, 'pcs', 1.00, NULL, 7),
('Take-out paper bag (small)', 9, 200, 'pcs', 7.00, NULL, 7),
('Take-out paper bag (large)', 9, 200, 'pcs', 9.00, NULL, 7),
('Cup carrier', 9, 150, 'pcs', 8.00, NULL, 7),

-- CONSUMABLES
('Table napkins', 10, 1000, 'pcs', 0.50, NULL, 7),
('Plastic spoons', 10, 500, 'pcs', 1.00, NULL, 7),
('Plastic forks', 10, 500, 'pcs', 1.00, NULL, 7),
('Wet wipes (sachet)', 10, 400, 'pcs', 2.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1),
('Disposable gloves', 10, 300, 'pairs', 5.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1),

-- COOKING AGENTS & SEASONING
('Cooking oil (vegetable)', 11, 20, 'liters', 150.00, DATE_ADD(CURDATE(), INTERVAL 180 DAY), 1),
('Unsalted butter', 11, 10, 'kg', 420.00, DATE_ADD(CURDATE(), INTERVAL 30 DAY), 2),
('Refined salt', 11, 15, 'kg', 60.00, DATE_ADD(CURDATE(), INTERVAL 720 DAY), 1),
('Black pepper (ground)', 11, 8, 'kg', 520.00, DATE_ADD(CURDATE(), INTERVAL 720 DAY), 1),
('All-purpose seasoning', 11, 10, 'kg', 380.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1),
('Sugar/Syrup', 11, 12, 'kg', 140.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1),
('Sour cream powder', 11, 8, 'kg', 450.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1),
('BBQ powder', 11, 8, 'kg', 460.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1),
('Cheese powder', 11, 8, 'kg', 480.00, DATE_ADD(CURDATE(), INTERVAL 365 DAY), 1)
";

if ($mysqli->query($sql)) {
    echo "Items with expiration dates inserted successfully!";
} else {
    echo "Error inserting items: " . $mysqli->error;
}

$mysqli->close();
?>
