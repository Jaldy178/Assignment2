<?php
session_start();
require_once 'database.php';

class User {
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = htmlspecialchars(strip_tags($name));
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST['name']) && !empty($_POST['email']) $$ !empty($_POST['password'])){
        $user = new User($_POST['name'], $_POST['email'], $_POST['password']);

        //store data in db
        $db= new Database();
        $pdo = $db->connect();

        $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$user->getName(), $user->getEmail(), $user->getPassword()]);

        //2FA-generate and send OTP
        $otp = rand(100000, 999999); //generate otp
        $_SESSION['otp'] = $otp; //store OTP in session
        mail($user->getEmail(), "Your OTP code, Your OTP cose is $otp.");//semd OTP via email

        echo "User registered successfully!! Check your email for the OTP.";
    }else {
        echo"All fields are  required.";
    }

}
?>

