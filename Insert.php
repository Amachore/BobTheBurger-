INSERT INTO inventory_transactions 
(item_id, user_id, location_id, transaction_type, quantity, unit, transaction_date, remarks) 
VALUES
(101, 1, 2, 'IN', 50, 'pcs', '2026-01-29', 'Initial stock delivery'),
(101, 1, 2, 'OUT', 10, 'pcs', '2026-01-29', 'Used for burger prep'),
(102, 2, 3, 'IN', 20, 'kg', '2026-01-29', 'Supplier restock'),
(102, 2, 3, 'OUT', 5, 'kg', '2026-01-29', 'Kitchen usage'),
(103, 1, 4, 'IN', 100, 'slices', '2026-01-29', 'Cheese delivery'),
(103, 1, 4, 'OUT', 15, 'slices', '2026-01-29', 'Daily consumption');