<?php
include("db.php");

$order_id = $_GET['order_id'];

$query = "
SELECT 
orders.id AS order_id,
users.name AS customer_name,
products.name AS product_name,
products.category,
products.unit,
products.price,
order_items.quantity,
orders.status

FROM orders

JOIN users ON users.id = orders.user_id
JOIN order_items ON order_items.order_id = orders.id
JOIN products ON products.id = order_items.product_id

WHERE orders.id='$order_id'
";

$result = mysqli_query($conn,$query);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="invoice_'.$order_id.'.csv"');

$output = fopen("php://output","w");

fputcsv($output,[
"Order ID",
"Customer",
"Product",
"Category",
"Unit",
"Price",
"Quantity",
"Status"
]);

while($row = mysqli_fetch_assoc($result)){
    fputcsv($output,$row);
}

fclose($output);
exit();
?>