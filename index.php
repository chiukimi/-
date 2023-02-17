<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="0216.css">
    <title>留言板</title>
  
  </head>
  <body>
    
    <!-- <header class="warning">
      注意！本站為練習用網站，註冊時請勿使用任何真實的帳號或密碼。
    </header> -->
  
    <main class="board">　
      <div class="board__header">   
        <div class="border__word-block">
          <h1 class="board__tittle">Comments</h1>
        </div>
        <div class="board__btn-block">
                <a class="board__btn" href="signin.html">signin</a>
          <a class="board__btn" href="login.html">Login</a>
          
        </div>
      </div>
   
      <!-- 這是後端驗證；也可使用前端 JS 判斷，在提交表單時進行驗證 -->
      
      <!-- 如果為登入狀態（有username）即可看到表單 -->
            <h3>請登入發布留言</h3>
        
    <div class="board__hr"></div>
  
    <section>
        <!-- 這邊有兩種做法： -->
        <!-- (1) 用 php 包住整個迴圈，但每段 class 都需用 echo 來跑 -->
        <!-- (2) 如下列方法，將 php 和 html 混用，php 只須包住迴圈條件式，較方便撰寫但不易閱讀-->
        <?php
            require_once("linkdb.php");
            $sql = 'SELECT time,content,realname FROM comments,signin WHERE signin.loginemail=comments.loginemail;';
            $sth = $db_link->prepare($sql);
            try{
                  $sth ->execute ();
            
            while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="card">
              <div class="card__avatar"></div>
                <div class="card__body">
                  <div class="card__info">
                    <!-- 將要輸出的資料改為 php echo -->
                    <span class="card__author"><?php echo $row['realname'];?></span>
                    <span class="card__time"><?php echo $row['time'];?> </span>
                 </div>
                 <div class="board__hr"></div>
                <p class="card__content"><?php echo $row['content'];?></p><h1></h1><p></p>
              </div>
            </div>
            
            
            <?php }} catch (PDOException $e){}
             ?>
       </section>
    </main>
  
  
  
  </body>
  
</html>