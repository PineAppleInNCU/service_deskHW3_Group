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
      $_SESSION['v']='';//點下logout鈕，將會把session變成空值
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
