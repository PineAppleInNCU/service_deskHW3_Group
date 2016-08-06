<?php

  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");

  if(isset($_GET['msg']))
  {
    if($_GET['msg']=="logout")
    {
      
      $_SESSION['v']='logout~!';//點下logout鈕，將會把session變成空值
      echo $_SESSION['v'];
      header("location:login.php");
    }
  }


?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        </head>
        <body class="bg-info">
          <?php
            echo "Hello world!";
          ?>
          <!-- 輸入留言 -->
          <?php if(isset($_SESSION['v']))if($_SESSION['v']=="yes"){ ?>

            <div><?php //確定是使用者，才顯示這一個區塊?>
              <P><font><?php echo "$guestName" ?></font>來說點甚麼吧</P>
              <div>
                <form id="form1" name="form1" method="post" action="">
                  <textarea class="post" style="width:600px;color:white" rows="8" id="guestContent" name="guestContent"></textarea>
                  <?php echo "</br>"?>
                  <input type="submit" name="button" id="button" value="確認" />
                </form>
                <div>
                  <a href="php_newboard.php?msg=logout" style="text-decoration:none;color: #3D59AB;font-family: Verdana, sans-serif;"><span style="font-weight: bold;font-size: 18px;color: #ffffff;">登出</span></a>
                </div>
                <div >
                  <a href="php_adminfix.php"><span>帳密修改</span></a>
                </div>
              </div>
            </div>
            <!-- 輸入留言 -->
          <?php }?>




                <a href="board.php?msg=logout"><button>登出</button></a>

        </body>
</html>

<!-- 留言板裡的字，不知道為什麼是白色的 -->