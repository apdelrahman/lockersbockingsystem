<?php

$serverName ="sql208.infinityfree.com";
$userName ="if0_36644442";
$password ="lockers2024";
$dbName ="if0_36644442_lockersdb";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection has error: " . $e->getMessage();
}

function addData($conn, $tableName, $data)
{
    $keys = implode(', ', array_keys($data));
    $values = implode(', ', array_map(function ($val) {
        return "'" . $val . "'";
    }, $data));

    $sql = "INSERT INTO `$tableName` ($keys) VALUES ($values)";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $conn->lastInsertId();
}

// function updateData($conn, $tableName, $data, $idCol, $id)
// {
//     $setValues = implode(', ', array_map(function ($key, $val) {
//         return "`$key` = '$val'";
//     }, array_keys($data), $data));

//     $sql = "UPDATE `$tableName` SET $setValues WHERE `$idCol` = :id";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':id', $id);
//     $stmt->execute();
//     return $id;
// }

function updateData($conn, $tableName, $data, $idCol, $id)
{
    $setValues = implode(', ', array_map(function ($key) {
        return "`$key` = :$key";
    }, array_keys($data)));

    $sql = "UPDATE `$tableName` SET $setValues WHERE `$idCol` = :id";
    $stmt = $conn->prepare($sql);

    foreach ($data as $key => $val) {
        if ($val === null) {
            $stmt->bindValue(":$key", $val, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(":$key", $val);
        }
    }

    $stmt->bindValue(':id', $id);
    $stmt->execute();

    return $id;
}


function deleteData($conn, $tableName, $colName, $id)
{
    $sql = "DELETE FROM `$tableName` WHERE `$colName` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $id;
}

function getData($conn, $tableName)
{
    $sql = "SELECT * FROM `$tableName`";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$usersData = getData($conn, 'users');
$lockersData = getData($conn, 'lockers');

?>