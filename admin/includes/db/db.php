<?php

$dns = "mysql:host=sql208.infinityfree.com;dbname=if0_36644442_lockersdb"; 
$user= "if0_36644442"; // root is default value until you change it 
$pass= "lockers2024";

// Now we will check if the connection is ok or no

try{
    // trying the connection
    $connect = new PDO($dns, $user, $pass);
}catch (PDOException $e){ 
    // catch for if there is a problem with server, the PDO solve it and handling the error
    echo "Failed To Connect With Data Base" . $e->getMessage(); 
}

?>

