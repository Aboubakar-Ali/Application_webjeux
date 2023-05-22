<?php

// DATABASE
$config=array(
    'DB_HOST'=>'localhost',
    'DB_USERNAME'=>'root',
    'DB_PASSWORD'=>'',
    'DB_DATABASE'=>'appweb'
);

try
{
    
    $host=$config['DB_HOST'];
    $dbname=$config['DB_DATABASE'];

    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$config['DB_USERNAME'],$config['DB_PASSWORD']);
    
}
catch(PDOException $e)
{
    echo "Error:".$e->getMessage();
}