<?php

require_once __DIR__.'/lib_u/load_twig.php';

// Create a product list
$products = [
    [
        'name'          => 'Personal Computer',
        'description'   => 'Core i5',
        'value'         =>  560.00,
        'date_register' => '2017-06-22',
    ],
    [
        'name'          => 'Mouse',
        'description'   => 'Razer',
        'value'         =>  125.00,
        'date_register' => '2017-10-25',
    ],
    [
        'name'          => 'Keyboard',
        'description'   => 'Mechanical Keyboard',
        'value'         =>  250.00,
        'date_register' => '2017-06-23',
    ],
];

// Render our view
echo $twig->render('ro.tpl', ['products' => $products] );