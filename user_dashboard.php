<?php
session_start();

class UserSession {
    public $userId;
    
    public function __construct() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $this->userId = $user['ID_Klientit']; 
        }
         else {
            header('Location: Log-in.php');
            exit();
        }
    }
}

class Database {
    private $conn;

    public function __construct() {
        include('db_connection.php');
        $this->conn = $conn;
    }

    public function getProducts() {
        $query = "SELECT * FROM produktet";  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$userSession = new UserSession();
$database = new Database();
$products = $database->getProducts();

// Retrieve products posted by admin
$adminProducts = isset($_SESSION['products']) ? $_SESSION['products'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosova Clothes</title>
    <link rel="stylesheet" href="Style1.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="user_dashboard.php">
                    <img src="logo.png" alt="Logo" />
                </a>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="user_dashboard.php">Home</a></li>
                    <li><a href="KoleksioniIRI.php">Koleksioni i ri</a></li>
                    <li><a href="KoleksioniMeshkuj.php">Meshkuj</a></li>
                    <li><a href="KoleksioniFemra.php">Femra</a></li>
                    <li><a href="KoleksioniPerFemije.php">Femije</a></li>
                    <li><a href="KoleksioniAksesore.php">Aksesore</a></li>
                    <li><a href="#">Zbritje</a></li>
                </ul>
            </nav>
            <div class="right-section">
                <a href="AddToCart.php">
                    <img src="shopping cart.png" alt="Small Image" class="small-image" />
                </a>
            </div>
        </div>
    </header>

    <div class="img-statik">
        <img src="img-1.jpg" alt="Fotoja per Zbritje" class="img-1">
    </div>

    <div class="payment-slider">
    <div class="payment-text">
        <span id="paymentTextBold" class="bold-text" style="opacity: 1;"></span><br>
        <span id="paymentTextNormal" style="opacity: 1;"></span>
    </div>
</div>

    <br><br><br>

    <div class="carousel-container">
        <div class="carousel-wrapper" id="carouselWrapper">
            <img src="Nike.png" class="carousel-image" alt="Imazhi 1">
            <img src="adidas.jpg" class="carousel-image" alt="Imazhi 2">
            <img src="Lacoste.jpg" class="carousel-image" alt="Imazhi 3">
            <img src="Dior.png" class="carousel-image" alt="Imazhi 4">
            <img src="CAT.png" class="carousel-image" alt="Imazhi 5">
            <img src="Illyrian.jpg" class="carousel-image" alt="Imazhi 6">
            <img src="PhilippPlein.png" class="carousel-image" alt="Imazhi 7">
            <img src="Reebok.png" class="carousel-image" alt="Imazhi 8">
        </div>
    </div>

    <div style="width: 100%; height: 18rem;"></div>

    <div class="container">
        <?php 
        // Merge both database products and admin products
        $allProducts = array_merge($products, $adminProducts);
        
        foreach ($allProducts as $product): ?>
        <div class="item">
            <div class="images">
                <div class="image-container">
                    <img src="<?= htmlspecialchars($product['Imazhi']) ?>" alt="<?= htmlspecialchars($product['Emri_Produktit']) ?>">
                    <p><strong><?= htmlspecialchars($product['Emri_Produktit']) ?></strong></p>
                    <p>Çmimi: <?= htmlspecialchars($product['Qmimi']) ?>€</p>

                    <form action="AddToCart.php" method="POST">
                      <input type="hidden" name="product_id" value="<?= isset($product['ID_Produktit']) ? htmlspecialchars($product['ID_Produktit']) : '' ?>"> 
                      <button type="submit" name="add_to_cart" class="btn">SHTO NE SHPORTE</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <br><br><br>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
                <p>Phone: +1 (234) 567-890</p>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
            </div>
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Kosova Clothes eshte distributor direkt i brendeve: Nike, Adidas, Puma, Reebok, Lacoste, etj.</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Kosova Clothes. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"> </script>
</body>
</html>