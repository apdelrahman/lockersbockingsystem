<?php

$dns = "mysql:host=localhost;dbname=lockerbookingsystemdb"; 
$user= "root"; // root is default value until you change it 
$pass= "Ab*015*200#";

// Now we will check if the connection is ok or no

try{
    // trying the connection
    $connect = new PDO($dns, $user, $pass);
}catch (PDOException $e){ 
    // catch for if there is a problem with server, the PDO solve it and handling the error
    echo "Failed To Connect With Data Base" . $e->getMessage(); 
}

?>

