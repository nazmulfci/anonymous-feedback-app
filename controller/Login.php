<?php
session_start();
class Login{
    private $email;
    private $password;

    function __construct($email,$password) {
        $this->email = $email;
        $this->password = $password;
      }

      public function login():bool{
         

        // Load users from JSON file
    $file = '../model/users.json';
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);

        // Check if the user exists and the password matches
        foreach ($users as $user) {
            if ($user['email'] == $this->email && password_verify($this->password, $user['password'])) {
                $status = 1;
                exit;
            }
        }
    }

    $status = 2;

    return $status;

      }

}



$login = new Login($_POST['email'],password_hash($_POST['password'], PASSWORD_BCRYPT));

if($login->login()==1){
    $_SESSION['status'] = 1;
    $_SESSION['message'] = 'Login Successfull.';
    header("Location:../view/dashboard.php");
}
else{
    $_SESSION['status'] = 2;
    $_SESSION['message'] = 'Sorry! ';

    header("Location:../view/login.php");
}

