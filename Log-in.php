<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style1.css">
    <link rel="stylesheet" href="Style2.css">

    <title>Login and Registration</title>
</head>
<body>

    <!-- Pjesa e Headerit -->
    
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="Faqja1.html">
                <img src="logo.png" alt="Logo" />
                </a>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="Faqja1.html">Home</a></li>
                    <li><a href="KoleksioniIRI.html">Koleksioni i ri</a></li>
                    <li><a href="KoleksioniMeshkuj.html">Meshkuj</a></li>
                    <li><a href="KoleksioniFemra.html">Femra</a></li>
                    <li><a href="KoleksioniPerFemije.html">Femije</a></li>
                    <li><a href="KoleksioniAksesore.html">Aksesore</a></li>
                    <li><a href="#">Zbritje</a></li>
                </ul>
            </nav>
            <div class="right-section">
                <a href="Log-in.html">
                    <img src="shopping cart.png" alt="Small Image" class="small-image" />
                </a>
                <a href="Log-in.html" class="login-button">Log In</a>
            </div>
        </div>
    </header>

    <!-- Pjesa e Body -->

    <!-- Pjesa e login formes -->
<div class="container">
    <div class="form-container">
        <h2>Login</h2>  <!-- Thirrja e login.php per verifikimin e login  -->
        <form id="login-form" action="login.php" method="POST">
            <div class="form-group">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="login-email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="login-password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </div>

    <div class="form-container">
        <h2>Register</h2>
                                    <!-- Pjesa e Formes shtimit -->
                         <!-- Validimi me javascript, Metoda post me i shtu userat ne databaze dhe thirrja e register_user -->
        <form id="register-form" onsubmit="return validateRegisterForm()" method="POST" action="register_user.php">
            <div class="form-group">
                <label for="register-name">Name:</label>
                <input type="text" id="register-name" name="register_name" required>
            </div>
            <div class="form-group">
                <label for="register-surname">Surname:</label>
                <input type="text" id="register-surname" name="register_surname" required>
            </div>
            <div class="form-group">
                <label for="register-gender">Gender:</label>
                <select id="register-gender" name="register_gender" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="register-phone">Phone Number:</label>
                <input type="tel" id="register-phone" name="register_phone" required>
            </div>
            <div class="form-group">
                <label for="register-email">Email:</label>
                <input type="email" id="register-email" name="register_email" required>
            </div>
            <div class="form-group">
                <label for="register-password">Password:</label>
                <input type="password" id="register-password" name="register_password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="register">Register</button>
            </div>
        </form>
    </div>
</div>

<!-- Pjesa e footerit --> 
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
            <p>Phone: +1 (234) 567-890</a></p>
        </div>
        <div class="footer-section">
            <h3>Follow Us</h3>
            <a href="https://www.facebook.com" target="_blank">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="https://www.instagram.com" target="_blank">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8a5 5 0 0 1-3-3Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <div class="footer-section">
            <h3>About Us</h3>
            <p>Kosova Clothes eshte distributor direkt i brendeve: Nike, Adidas, Puma, Reebok, Lacoste  
                si dhe shites i licensuar i brendave: Champion, Under Armour, etj.</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Kosova Clothes. All rights reserved.</p>
    </div>
</footer>

<script src="script.js"></script>
</body>
</html>
