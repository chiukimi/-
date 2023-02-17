<?php
$editcontnet = isset($_POST['content']) ? $_POST['content']: "";
$contentid = isset($_POST['id']) ? $_POST['id'] : "" ;
require_once('linkdb.php');

$data = [$editcontnet,$contentid];
$sql = 'UPDATE comments SET content = ? WHERE contentid = ?';
$sth = $db_link->prepare($sql);
try{
    if ($sth -> execute($data)){
        echo "
        <script>
            alert('編輯成功');
            window.location.replace('sucessloginindex.php');
        </script>
        ";
    } else {
        echo "
        <script>
            alert('編輯失敗".$editcontent." ".$contenid."');
            window.location.replace('sucessloginindex.php');
        </script>
        ";
    }
} catch (PDOException $e){
    echo "
        <script>
            alert('編輯失敗2');
            window.location.repalce('sucessloginindex.php');
        </script>
        ";
}