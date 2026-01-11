<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: Log-in.php');
    exit();
}

include('db_connection.php');

include('cart.php');

$product = new Product($conn);
$order = new Order($conn);

if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = 1; 
    $user_id = $_SESSION['user']['ID_Klientit'];

    if ($product_id > 0 && $quantity > 0) {
        $orderCreated = $order->createOrder($user_id, $product_id, $quantity);
        if ($orderCreated) {
            $message = "Product added to cart successfully!";
        } else {
            $message = "Failed to add product to cart.";
        }
    } else {
        $message = "Invalid product or quantity.";
    }
}

if (isset($_POST['remove_item'])) {
    $order_id = intval($_POST['order_id']);
    $order->removeOrder($order_id);
    $message = "Item removed from cart.";
}

if (isset($_POST['update_quantity'])) {
    $order_id = intval($_POST['order_id']);
    $quantity = intval($_POST['quantity']);
    $order->updateOrderQuantity($order_id, $quantity);
    $message = "Quantity updated.";
}

$finished_order = false;
if (isset($_POST['finish_order'])) {
    $user_id = $_SESSION['user']['ID_Klientit'];
    $order->finishOrder($user_id);
    $message = "Order finished successfully!";
    $finished_order = true;
}

$user_id = $_SESSION['user']['ID_Klientit'];
$cartItems = $order->getUserOrders($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../CSS-Files/css_per_AddToCart.css">
    <script>
        function finishOrder() {
            alert("Your order is finished");
            window.location.href = "user_dashboard.php";
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Your Shopping Cart</h1>
        <?php if (isset($message)): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cartItems as $item): ?>
            <?php $total_price = $item['Sasia'] * $item['Qmimi']; ?>
            <tr>
                <td><?= $item['Emri_Produktit'] ?></td>
                <td>
                    <form action="AddToCart.php" method="POST" class="update-quantity-form">
                        <input type="number" name="quantity" value="<?= $item['Sasia'] ?>" min="1">
                        <input type="hidden" name="order_id" value="<?= $item['ID_Porosit'] ?>">
                        <button type="submit" name="update_quantity" class="btn btn-update">Update</button>
                    </form>
                </td>
                <td><?= $item['Qmimi'] ?>€</td>
                <td><?= $total_price ?>€</td>
                <td>
                    <form action="AddToCart.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $item['ID_Porosit'] ?>">
                        <button type="submit" name="remove_item" class="btn btn-remove">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <form action="AddToCart.php" method="POST">
            <button type="submit" name="finish_order" class="btn btn-finish">Finish Order</button>
        </form>
    </div>

    <?php if ($finished_order): ?>
        <script>
            finishOrder();
        </script>
    <?php endif; ?>
</body>
</html>



