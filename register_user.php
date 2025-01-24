<?php
include_once 'db_connection.php'; 

class UserRegistration {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }


    public function register($name, $surname, $gender, $phone, $email, $password) {
        if (empty($name) || empty($surname) || empty($gender) || empty($phone) || empty($email) || empty($password)) {
            return "All fields are required.";
        }

        if ($this->emailExists($email)) {
            return "Email is already registered.";
        }

        $sql = "INSERT INTO users (Emri, Mbiemri, Gjinia, Numri, Email, Password) 
                VALUES (:name, :surname, :gender, :phone, :email, :password)";
        $stmt = $this->conn->prepare($sql);


        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); 

      
        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Error: Could not register user.";
        }
    }

   
    private function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE Email = ?");
        $stmt->execute([$email]);

        return $stmt->rowCount() > 0;
    }
}


if (isset($_POST['register'])) {
    $name = $_POST['register_name'];
    $surname = $_POST['register_surname'];
    $gender = $_POST['register_gender'];
    $phone = $_POST['register_phone'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];

   
    $userRegistration = new UserRegistration($conn);

    $resultMessage = $userRegistration->register($name, $surname, $gender, $phone, $email, $password);

    echo $resultMessage;

    if ($resultMessage === "Registration successful!") {
        header("Location: Log-in.php");
        exit();
    }
}
?>
