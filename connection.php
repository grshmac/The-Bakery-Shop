<?php
function openConnection() {
    $conn = mysqli_connect("localhost", "root", "");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database if it doesn't exist
    $dbName = 'bakefinal';
    $createDB = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    mysqli_query($conn, $createDB);

    // Select the database
    mysqli_select_db($conn, $dbName);
    mysqli_set_charset($conn, "utf8mb4");

    return $conn;
}

function closeConnection($conn) {
    mysqli_close($conn);
}
?>


// <?php
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'bakefinal');
//
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//
// function openConnection() {
//     global $conn;
//     $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
//     if (!$conn->select_db(DB_NAME)) {
//         createDatabase($conn);
//         $conn->select_db(DB_NAME);
//         createTables($conn);
//         insertData($conn);
//     }
//     $conn->set_charset("utf8mb4");
// }
//
// function closeConnection() {
//     global $conn;
//     if (isset($conn)) $conn->close();
// }
//
// ?>
