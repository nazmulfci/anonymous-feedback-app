<?php
session_start();
class Registration{
    private $name;
    private $email;
    private $password;

    function __construct($name,$email,$password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
      }

      public function registration():bool{
        $user = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];

        $file = '../model/users.json';
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
    } else {
        $users = [];
    }

     // Check if the user exists and the password matches
     foreach ($users as $user) {
        if ($user['email'] == $this->email && password_verify($this->password, $user['password'])) {
            return 3; // user allready exist
        }
    }



    // Add the new user
    $users[] = $user;

    // Save users back to the file
    $saveUser = file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    if($saveUser){
    return 1;
    }
    else{
    return 2;
    }

      }

}


$registration = new Registration($_POST['name'],$_POST['email'],password_hash($_POST['password'], PASSWORD_BCRYPT));

if($registration->registration()==1){
    $_SESSION['status'] = 1;
    $_SESSION['message'] = 'Regirtration Successfull. plz login';
}
else if($registration->registration()==2){
    $_SESSION['status'] = 2;
    $_SESSION['message'] = 'Sorry! Not register.';
}
else if($registration->registration()==3){
    $_SESSION['status'] = 3;
    $_SESSION['message'] = 'User allready exist.';
}
else{
    $_SESSION['status'] = 4;
    $_SESSION['message'] = 'Sorry! ';
}

header("Location:../view/register.php");