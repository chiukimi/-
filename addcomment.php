<?php 
    session_start();
    $content=isset($_POST['content'])?$_POST['content']:"";

    require_once("linkdb.php");

    $userconnent = [$content,$_SESSION["loginemail"]];

    $sql = 'INSERT INTO comments (content,loginemail) VALUES (?,?)';
    $sth = $db_link->prepare($sql);
    try{
        if($sth ->execute ($userconnent)){
            echo
            "
            <script>
                alert('留言成功');
                window.location.replace('../0216/sucessloginindex.php');
             </script> 
            ";
        }
        else
        echo "
        <script>
            alert('留言失敗');
            window.location.replace('../0216/sucessloginindex.php');
        </script>
        ";
    } catch (PDOException $e){
        echo "
        // <script>
        //     alert('信箱已註冊過');
        //     window.location.replace('../0216/login.html');
        // </script>
        //     ";
        print("伺服器連接問題");
    }
?>