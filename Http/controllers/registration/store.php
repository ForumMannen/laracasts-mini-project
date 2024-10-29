<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate form inputs
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valide email adress.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of atleast 7 characters.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if the account already exists
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    //then someone with that email already exists and has an account
    // if yes, redirect to login page.

    header('location: /');
    exit();
} else {
    // if not, save one to the database and login in the user and redirect
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login($user);
    // mark that the user has logged in
    // $_SESSION['user'] = [
    //     'email' => $email
    // ];

    header('location: /');
    exit();
}
