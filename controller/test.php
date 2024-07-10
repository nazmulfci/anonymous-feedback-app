<?php
$email = 'infonazmulfci@gmail.com';
$password = '12';

        $file = '../model/users.json';
        if (file_exists($file)) {
            $users = json_decode(file_get_contents($file), true);
            
            var_dump($users);
            echo '<br>';
            foreach($users as $user){
                echo password_verify($password, $user['password']);

                // if($email == $user['email']){
                //     echo 'successfull.';
                // }
                // else{
                //     echo 'fail';
                // }
            }

        }




// Check if the user exists and the password matches
    // foreach ($users as $user) {
    //     if ($user['email'] == $email && password_verify($password, $user['password'])) {
    //         $status = 1;
    //         exit;
    //     }
    // }