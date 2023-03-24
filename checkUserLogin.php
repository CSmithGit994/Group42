<?php

function verifyUsers () {
    session_start();
    //if (!isset($_POST['username']) or !isset($_POST['password'])) {
    //    return null;
    //}

    // Change file extension to location of db file
    $db = new SQLite3('C:\\xampp\\Storageforhallam\\Database.db');
    $username = $_POST['username'];
    $password =  $_POST['password'];
    // Sets username and password to users entered data and checks database for matching results
    // Selects matching result if one is found
    $sql = "SELECT * FROM logininfo WHERE username='$username' AND password='$password'";
    echo $sql;
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    // Sets session variables for username and user role
    $user = $result->fetchArray(SQLITE3_ASSOC);
    if ($user) {
        $_SESSION['username'] = $user['username'];
        return array(
            'user' => $user,
            'role' => $user['role']
        );
    } else {
        return null;
    }
}


?>

