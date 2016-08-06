<?php
  session_start();//重要，沒有這行的話，session不會記錄上一個頁面的session給這個頁面


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
       echo $_SESSION['v'];
       $_SESSION['v']='logout!';//點下logout鈕，將會把session變成空值
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

                <a href="board.php?msg=logout"><button>登出</button></a>

        </body>
</html>
