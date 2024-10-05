class User {
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = htmlspecialchars(strip_tags($name));
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }