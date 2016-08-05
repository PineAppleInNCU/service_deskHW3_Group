<?php

  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");

?>
<!DOCTYPE html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>登入</title>
                <link rel="stylesheet" href="css/login.css" charset="utf-8">
        </head>
        <body class="bg-info">
                <?php
                        echo "Hello world!";
                ?>

                <div id="div">asdkj;</div>


                <script type="text/javascript" src="js/login.js"></script>
                
        </body>
</html>
