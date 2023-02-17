<?php
session_start();
// print($_COOKIE["name"]);
// setcookie("name", "", time()-3600);
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $loginemail = $_POST["loginemail"];
//     $password = $_POST["password"];
//     $membername = $_POST["membername"];
//     $sex = $_POST["sex"];
//     $skill = $_POST["skill"];
//     $year = $_POST["year"];
//     $cellphonenumber = $_POST["cellphonenumber"];
//     $epaper = isset($_POST["epaper"]) ? "是" : "否";

//     echo "會員帳號為：" . $loginemail . "<br>";
//     echo "會員密碼為：" . $password . "<br>";
//     echo "會員名稱為：" . $membername . "<br>";
//     echo "會員性別為：" . $sex . "<br>";
//     echo "選擇的技能：" . implode(", ", $skill) . "<br>";
//     echo "選擇的出生年分為：" . $year . "<br>";
//     echo "電話號碼為：" . $cellphonenumber . "<br>";
//     echo "是否訂電子報：" . $epaper . "<br>";
// }



    $loginemail=isset($_POST['loginemail'])?$_POST['loginemail']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";
    $membername=isset($_POST['membername'])?$_POST['membername']:"";   
    $sex=isset($_POST['sex'])?$_POST['sex']:"";
    $year=isset($_POST['year'])?$_POST['year']:"";
    $epaper=isset($_POST['epaper'][0]);

    print("輸入的會員帳號為".$loginemail."</br>");
    print("輸入的會員密碼為".$password."</br>");
    print("輸入的會員名稱為".$membername."</br>");

    if ($_POST['sex'] == 'male')
        print("選擇的會員性別為:男"."</br>");
        
    else
        print("選擇的會員性別為:女"."</br>");

    print("選擇的技能");

    if (isset($_POST['skill'])) 
    {
        // foreach ($_POST['skill'] as $skill) {
          
        // }
        
        $skill=implode(" " ,$_POST['skill']);
        print($skill." ");
    }
    else
    {   
        $skill="";
        print("未選擇技能");
    }
    
    switch ($_POST['year']) {
        case'1980':
            echo("選擇的出生年分為:1980"."</br>");
            break;
        case "2004":
            echo("選擇的出生年分為:2004"."</br>");
            break;
        case "2007":
            echo("選擇的出生年分為:2007"."</br>");
            break;
        case "1984":
            echo("<br>選擇的出生年分為:1984"."</br>");
            break;
    }
    $cellphonenumber=isset($_POST['cellphonenumber'])?$_POST['cellphonenumber']:"";
    print("輸入的電話號碼:".$cellphonenumber."</br>");

    if (isset ($_POST['epaper']))
        print("是否訂閱電子報:是"."</br>");
    else
        print("是否訂電子報 :否"."</br>");


    require_once("linkdb.php");
    $userdata = [$loginemail , password_hash($password ,PASSWORD_DEFAULT) , $membername , $sex,$skill,$year,$cellphonenumber,$epaper];
    $sql = 'INSERT INTO signin(loginemail,password, realname,sex,skill,year,phonenumber,epaper) VALUES (?,?,?,?,?,?,?,?)';
    $sth = $db_link->prepare($sql);
    try {
    if($sth -> execute($userdata )) {
            echo"
             <script>
                alert('註冊成功，請登入');
                window.location.replace('../0216/login.html');
             </script>    
            ";
        // echo "註冊成功";
        //throw $th;
    } 
    else {
        // echo "註冊失敗";
        echo "
        <script>
            alert('註冊失敗');
            window.location.replace('../0216/signin.html');
        </script>
        ";
    }
        
    }  catch (PDOException $e){
        
        // print($e);
         echo "
         <script>
             alert('信箱已註冊過');
             window.location.replace('../0216/login.html');
         </script>
             ";
    }
       
    ?>        
