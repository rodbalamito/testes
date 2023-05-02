<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withDatabaseUri('https://teste-c7714-default-rtdb.firebaseio.com')
    ->withServiceAccount('/home1/revistaquilombo/public_html/csgo/teste-c7714-firebase-adminsdk-bvizn-85b764494f.json');

$database = $factory->createDatabase();



$reference = $database->getReference('usuarios');




$data = $reference->getValue();
?>