<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form received!<br>"; // Debug

    // Define sample items
    $items = [
        [
            'product_name' => 'Crochet Bag',
            'quantity' => 1,
            'price' => 20.00
        ],
        [
            'product_name' => 'Crochet Hat',
            'quantity' => 2,
            'price' => 15.00
        ]
    ];

    // Calculate total
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Store in session
    $_SESSION['order'] = [
        'order_id' => rand(1000, 9999),
        'order_date' => date('Y-m-d H:i:s'),
        'status' => 'Processing',
        'total' => $total,
        'shipping_address' => htmlspecialchars(trim($_POST['address'])),
        'items' => $items
    ];

    echo "Session set, redirecting...<br>"; // Debug

    // Redirect
    header('Location: order-details.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Aizlyn Crochet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="text-center mb-4">Checkout</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="address" class="form-label">Shipping Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
</body>
</html>
