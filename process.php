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
        //Proceed to db storage
    }else{
        echo "ALL fields are required."
    }
    
}


