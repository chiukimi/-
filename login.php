<?php
    session_start();
    $loginemail=isset($_POST['loginemail']) ? $_POST['loginemail'] : "";
    print("輸入的會員帳號:".$loginemail . "</br>");
    
    $password=isset($_POST['password']) ? $_POST['password'] : "";
    print("輸入的會員密碼:".$password."</br>");

    require_once("linkdb.php");
    $sql= 'SELECT loginemail,password,realname FROM signin WHERE loginemail=:loginemail';
    $sth=$db_link->prepare($sql);
    $sth -> bindvalue(':loginemail',$loginemail);
    $sth -> execute();
    $uesrdata = $sth -> fetch(PDO::FETCH_ASSOC);
    try {
        if (empty($uesrdata) != 1)
        {
            if (password_verify($password,$uesrdata['password'])){
                $_SESSION['loginemail'] = $uesrdata['loginemail'];
                echo "
                <script>
                    alert('login sucess');
                    window.location.replace('../0216/sucessloginindex.php');
                </script>
                ";
            }

            else {
                echo "
                    <script>
                    alert('acc or password error');
                    window.location.replace('../0216/login.html');
                </script>
                ";
                   }
        }
        else
        {
            echo "
                    <script>
                    alert('acc or password error');
                    window.location.replace('../0216/login.html');
                </script>
                ";
        }
    } catch (PDOException $e) {
        echo "
                    <scrit>
                    alert('acc or password error');
                    window.location.replace('../0216/login.html');
                </script>
                ";
    }

    $_SESSION['loginemail'] = $loginemail;
    
?>