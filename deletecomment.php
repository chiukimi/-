<?php
session_start();
$contentid = isset($_GET['contentid']) ? $_GET['contentid'] : "";

require_once("linkdb.php");
// echo $contentid;
$sql = "DELETE FROM comments WHERE contentid = :contentid and loginemail = :loginemail";
$sth = $db_link->prepare($sql);
$sth->bindValue(':contentid', $contentid);
$sth->bindValue(':loginemail',$_SESSION["loginemail"]);
// echo $_SESSION[":cont"];
$sth->execute();
try {
    if ($sth->rowCount()) {
        echo "
        <script>
            alert('刪除成功')
            window.location.replace('sucessloginindex.php');
        </script>
        ";
    } else {
        echo "
        <script>
            alert('刪除失敗');
            window.location.replace('sucessloginindex.php');
        </script>
        ";
    }
} catch (PDOException $e) {
    echo $e;
    // echo "
    //     <script>
    //         alert('刪除失敗2');
    //         window.location.replace('sucessloginindex.php');
    //     </script>
    //     ";
}
