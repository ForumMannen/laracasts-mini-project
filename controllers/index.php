<?php

$_SESSION['name'] = 'Linus';

view("index.view.php", [
    'heading' => 'Home'
]);
