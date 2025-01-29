<?php
session_start();

class AdminSession {
    public $adminId;
    public $adminEmail;

    public function __construct() {
        if (!isset($_SESSION['admin'])) {
            header("Location: Log-in.php");
            exit();
        }

        $admin = $_SESSION['admin']; 
        $this->adminId = $admin['ID_Admin'];
        $this->adminEmail = $admin['Email'];
    }
}

class GetFromDatabase {
    private $conn;

    public function __construct() {
        include('db_connection.php');
        $this->conn = $conn;
    }

    public function getOrders() {
        $query = "SELECT 
                    Porosite.ID_Porosit, 
                    users.Emri, 
                    users.Mbiemri, 
                    produktet.Emri_Produktit, 
                    Porosite.Sasia, 
                    produktet.Qmimi, 
                    Porosite.Data 
                  FROM Porosite 
                  INNER JOIN produktet ON Porosite.Product_ID = produktet.ID_Produktit 
                  INNER JOIN users ON Porosite.User_ID = users.ID_Klientit 
                  ORDER BY Porosite.ID_Porosit DESC"; 
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $price, $image, $adminId, $adminEmail) {
        $query = "INSERT INTO produktet (Emri_Produktit, Qmimi, Imazhi, Stok, Admin_ID, Admin_Email) VALUES (?, ?, ?, 0, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$name, $price, $image, $adminId, $adminEmail]);
    }

    public function getProductsWithAdmin() {
        $query = "SELECT 
                    produktet.ID_Produktit, 
                    produktet.Emri_Produktit, 
                    produktet.Qmimi, 
                    produktet.Imazhi, 
                    produktet.Admin_ID, 
                    produktet.Admin_Email 
                  FROM produktet";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$adminSession = new AdminSession();
$getFromDatabase = new GetFromDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];
    $adminId = $adminSession->adminId;
    $adminEmail = $adminSession->adminEmail;


    $getFromDatabase->addProduct($productName, $productPrice, $productImage, $adminId, $adminEmail);

    $_SESSION['message'] = "Produkti u shtua me sukses nga admini: $adminEmail!";
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();  
}

$orders = $getFromDatabase->getOrders();
$users = [];
$products = [];

if (isset($_GET['view_users'])) {
    $users = $getFromDatabase->getUsers();
}

if (isset($_GET['view_products'])) {
    $products = $getFromDatabase->getProductsWithAdmin();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

<div class="header">
    <h1>Mirë se vini në Admin Dashboard</h1>
</div>

<div class="content">
    <div class="admin-info">
        <h2>Informacioni i Administratorit</h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($adminSession->adminEmail); ?></p>
    </div>

    <div class="menu">
        <h2>Menyja</h2>
        <ul>
            <li><a href="admin_dashboard.php">Shiko Porositë</a></li>
            <li><a href="admin_dashboard.php?view_users=1">Shiko Përdoruesit e Regjistruar</a></li>
            <li><a href="admin_dashboard.php?view_products=1">Shiko Produktet e Shtuara</a></li>
        </ul>
    </div>

    <?php if (isset($_GET['view_users'])): ?>
        <h2>Përdoruesit e Regjistruar</h2>
        <?php if (count($users) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Emri</th>
                    <th>Mbiemri</th>
                    <th>Gjinia</th>
                    <th>Telefoni</th>
                    <th>Email</th>
                    <th>Data e Regjistrimit</th>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['ID_Klientit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['Emri'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['Mbiemri'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['Gjinia'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['Numri'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['Email'] ?? '') ?></td>
                    <td><?= htmlspecialchars($user['Data_Regjistrimit'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Asnjë përdorues i regjistruar nuk u gjet.</p>
        <?php endif; ?>

    <?php elseif (isset($_GET['view_products'])): ?>
        <h2>Produktet e Shtuara nga Administratorët</h2>
        <?php if (count($products) > 0): ?>
            <table>
                <tr>
                    <th>ID e Produktit</th>
                    <th>Emri i Produktit</th>
                    <th>Çmimi (€)</th>
                    <th>URL e Imazhit</th>
                    <th>ID e Administratorit</th>
                    <th>Emaili i Administratorit</th>
                </tr>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['ID_Produktit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($product['Emri_Produktit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($product['Qmimi'] ?? '') ?>€</td>
                    <td><?= htmlspecialchars($product['Imazhi'] ?? '') ?></td>
                    <td><?= htmlspecialchars($product['Admin_ID'] ?? '') ?></td>
                    <td><?= htmlspecialchars($product['Admin_Email'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Asnjë produkt nuk është shtuar.</p>
        <?php endif; ?>

    <?php else: ?>
        <h2>Detajet e Porosive</h2>
        <?php if (count($orders) > 0): ?>
            <table>
                <tr>
                    <th>ID e Porosisë</th>
                    <th>Emri i Përdoruesit</th>
                    <th>Emri i Produktit</th>
                    <th>Sasia</th>
                    <th>Çmimi Total (€)</th>
                    <th>Data e Porosisë</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                <?php $total_price = $order['Qmimi'] * $order['Sasia']; ?>
                <tr>
                    <td><?= htmlspecialchars($order['ID_Porosit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($order['Emri'] . " " . $order['Mbiemri'] ?? '') ?></td>
                    <td><?= htmlspecialchars($order['Emri_Produktit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($order['Sasia'] ?? '') ?></td>
                    <td><?= htmlspecialchars($total_price ?? '') ?>€</td>
                    <td><?= htmlspecialchars($order['Data'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Ende nuk janë vendosur porosi.</p>
        <?php endif; ?>
    <?php endif; ?>

    <h2>Shto Produkt të Ri</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="product_name">Emri i Produktit:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="product_price">Çmimi (€):</label>
        <input type="number" name="product_price" id="product_price" step="0.01" required><br><br>

        <label for="product_image">URL e Imazhit:</label>
        <input type="text" name="product_image" id="product_image" required><br><br>

        <button type="submit" name="add_product">Shto Produktin</button>
    </form>

    <form method="POST" action="Log-in.php">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

</body>
</html>
