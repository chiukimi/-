<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="0216.css">
  <title>留言板</title>

</head>

<body>
  <?php
  session_start();
  require_once("linkdb.php");
  // $sql = 'SELECT time,content,realname,loginemail FROM comments,signin WHERE signin.loginemail=comments.loginemail;';
  // $sth = $db_link->prepare($sql);
  // try{
  //       $sth ->execute ();

  // while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <main class="board">　
    <div class="board__header">
      <div class="border__word-block">
        <h1 class="board__tittle">Comments</h1>
      </div>
      <div class="board__btn-block">
        <a class="board__btn" href="index.php">Log out</a>
        <P><?php echo $_SESSION["loginemail"] ?></p>


      </div>
    </div>

    <!-- 這是後端驗證；也可使用前端 JS 判斷，在提交表單時進行驗證 -->

    <!-- 如果為登入狀態（有username）即可看到表單 -->
    <!-- 提交表單後會導向 handle_add_comment.php 來新增留言 -->
    <form class="board__new-comment-form" method="POST" action="addcomment.php">
      <textarea name="content" rows="5" placeholder="請輸入留言..."></textarea>
      <input class="board__submit-btn" type="submit">
    </form>

    <div class="board__hr"></div>
    <section>
      <!-- 這邊有兩種做法： -->
      <!-- (1) 用 php 包住整個迴圈，但每段 class 都需用 echo 來跑 -->
      <!-- (2) 如下列方法，將 php 和 html 混用，php 只須包住迴圈條件式，較方便撰寫但不易閱讀-->
      <?php

      $sql = 'SELECT time,content,realname,comments.loginemail,contentid FROM comments,signin WHERE signin.loginemail=comments.loginemail;';
      $sth = $db_link->prepare($sql);
      // echo $_SESSION["loginemail"];
      // echo $sth->rowCount();
      try {
        $sth->execute();

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {

          // echo $row['loginemail'];
          if ($_SESSION["loginemail"] == $row['loginemail']) {

      ?>


            <div class="card">
              <div class="card__avatar"></div>
              <div class="card__body">
                <div class="card__info">
                  <!-- 將要輸出的資料改為 php echo -->
                  <span class="card__author"><?php echo $row['realname']; ?></span>
                  <span class="card__time"><?php echo $row['time']; ?></span>
                </div>
                <div class="board__hr"></div>
                <form action="edit.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['contentid'] ?>">
                  <textarea class="card__content" name="content"><?php echo $row['content']; ?></textarea>
                  <button style='background: transparent ;' class="board__btn" type="submit">編輯</button>
                </form>
                <button style='background: transparent ;' class="board__btn" type="submit" onclick="<?php echo 'location.href=`deletecomment.php?contentid=' . $row['contentid'] . '`' ?>">刪除</button>
              </div>
            </div>
          <?php

          } else { ?>
            <div class="card">
              <div class="card__avatar"></div>
              <div class="card__body">
                <div class="card__info">
                  <!-- 將要輸出的資料改為 php echo -->
                  <span class="card__author"><?php echo $row['realname']; ?></span>
                  <span class="card__time"><?php echo $row['time']; ?></span>
                </div>
                <div class="board__hr"></div>
                <p class="card__content"><?php echo $row['content']; ?></p>
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $row['contentid'] ?>">
      <?php
          }
        }
      } catch (PDOException $e) {
      }
      ?>
    </section>

  </main>
</body>

</html>