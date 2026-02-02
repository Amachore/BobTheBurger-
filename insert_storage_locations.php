<?php
include "connect.php";


$sql = "
INSERT INTO storage_locations (location_name) VALUES
('Dry Storage'),
('Refrigerator'),
('Freezer'),
('Prep Area'),
('Cold Storage'),
('Beverage Chiller'),
('Packaging Area')
";

if ($mysqli->query($sql)) {
    echo "Storage locations inserted successfully!";
} else {
    echo "Error inserting storage locations: " . $mysqli->error;
}

$mysqli->close();
?>
