<?php
$db_host = "127.0.0.1";
$db_port=3306;
$db_username = "root";
$db_password = "";
$db_name = "test";
// 資料庫連線
try {
    $db_link = new PDO(
        "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8",
        $db_username,
        $db_password
    );
    // print "資料庫連結成功<br>";
} catch (PDOException $e) {
    print "$e<br>";
    print($e);
    die();
}

//關閉資料庫
// unset($db_link);
?>