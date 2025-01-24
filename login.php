<?php

include('db_connection.php');

session_start(); 

class UserLogin {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            return "Please fill in both email and password fields!";
        }

        $email = trim($email);
        $password = trim($password);

        $stmt_users = $this->conn->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt_users->bindParam(':email', $email);
        $stmt_users->execute();

        $user = $stmt_users->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if ($user['Password'] === $password) {
                session_start();  
                $_SESSION['user'] = $user;

                echo "User session set: " . $_SESSION['user']['Email'];

                header("Location: user_dashboard.php");  
                exit();
            } else {
                return "Invalid email or password!";
            }
        }

        $stmt_admin = $this->conn->prepare("SELECT * FROM admin_access WHERE Email = :email");
        $stmt_admin->bindParam(':email', $email);
        $stmt_admin->execute();

        $admin = $stmt_admin->fetch(PDO::FETCH_ASSOC);
        if ($admin) {
            if ($admin['Password'] === $password) {
                session_start(); 
                $_SESSION['admin'] = $admin;

                echo "Admin session set: " . $_SESSION['admin']['Email'];

                header("Location: admin_dashboard.php"); 
                exit();
            } else {
                return "Invalid email or password!";
            }
        }

        return "Invalid email or password!";  
    }
}


if (isset($_POST['login'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $userLogin = new UserLogin($conn);
    $loginMessage = $userLogin->login($email, $password);

    if ($loginMessage !== true) {
        echo $loginMessage;  
    }
}
?>