<?php
  session_start();//重要，沒有這行的話，session不會記錄上一個頁面的session給這個頁面


  //一、連結資料庫
  //建立連線
  $link = mysql_connect("localhost", "root", "tommy522588");
  //設定語系
  mysql_query("SET NAMES 'UTF-8'");
  //選擇資料庫
  mysql_select_db("Service_deskHW3") or die("無法選擇資料庫");


//取得使用者名稱
  $username=$_SESSION['username'];
//取得使用者名稱//
//將留言放到資料庫裡
  if(isset($_POST['guestContent'])){
	$guestContent=$_POST['guestContent'];//將由留言者的回覆儲存到guestContent裡
	$guestTime=date("Y:m:d H:i:s",time()+28800);
	$newData=mysql_query("insert into guest value('','$username','$guestTime','$guestContent')  ");//將資料存入guest的資料表裡
	header("location:board.php");
  }
//將留言放到資料庫裡
//判斷有無登入
  if(isset($_SESSION['v'])){//若有登入，不做動作

  }
  else{	
	$_SESSION['v']='';//若無登入，隨便設一個值

  }
//判斷有無登入//


//使用msg
  if(isset($_GET['msg']))
  {
    if($_GET['msg']=="logout")
    {

       //判斷是沒有點擊登出按鈕
       echo $_SESSION['v'];
       $_SESSION['v']='logout!';//點下logout鈕，將會把session變成空值
       echo $_SESSION['v'];
       header("location:login.php");    
       //判斷是沒有點擊登出按鈕//
    }
    else if($_GET['msg']=="delete"){
	//刪除非自己的留言，會導致錯誤
	if($_GET['msg_2']=="not_the_same_user"){
		echo "<script>alert('留言者才能刪除該留言');</script>";
	}
	//刪除非自己的留言，會導致錯誤//
	//刪除留言
	else{
		$id=$_GET['id'];
		mysql_query("DELETE FROM guest WHERE id='$id'");
		header("location:board.php");
	}
	//刪除留言
    }
    //修改留言
    else if($_GET['msg']=="fix_message"){
	if($_GET['msg_2']=="not_the_same_user"){
		echo "<script>alert('留言者才能修改該留言');</script>";
	}
    }
    //修改留言//
    //修改回覆
    else if($_GET['msg']=="fix_reply"){
	if($_GET['msg_2']=="not_the_same_user"){
		echo "<script>alert('回覆者才能修改該回覆');</script>";
	}
	
    }
    //修改回覆//
    //刪除回覆
    else if($_GET['msg']=="delete_reply"){
	if($_GET['msg_2']=="not_the_same_user"){
		echo "<script>alert('回覆者才能刪除該回覆');</script>";
	}
	else{
		$id=$_GET['replyID'];
		mysql_query("DELETE FROM reply WHERE id='$id'");
		header("location:board.php");
	}
    }
    //刪除回覆//
    
  }
//使用msg//

//抓取資料
  $data=mysql_query("select * from guest order by guestTime desc");//從資料庫裡抓資料
//抓取資料//

?>
<!DOCTYPE html>
<html>
        <head>
		<title>留言板</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/board.css" charset="utf-8">

        </head>
        <body class="bg-info">
          <!-- 輸入留言 -->
          <?php if(isset($_SESSION['v']))if($_SESSION['v']=="yes"){ ?>

            <div><?php //確定是使用者，才顯示這一個區塊?>
              <P><font><?php echo "$username" ?></font>來說點甚麼吧</P>
              <div>
                <form id="form1" name="form1" method="post" action="">
                  <textarea class="post" rows="8" id="guestContent" name="guestContent"></textarea>
                  <?php echo "</br>"?>
                  <input type="submit" name="button" id="button" value="確認" />
                </form>
                <div>
                  <a href="board.php?msg=logout"><span>登出</span></a>
                </div>
                <div >
                  <a href="php_adminfix.php"><span>帳密修改</span></a>
                </div>
              </div>
            </div>
          <?php }?>
          <!-- 輸入留言 -->
	  <!-- 留言板  -->
          <?php
	  	for($i=1;$i<=mysql_num_rows($data);$i++){
			$rs=mysql_fetch_assoc($data);

          ?>

	  <table height="300"  border="1px" style="margin:auto;">
		<thead>
			<?php if($_SESSION['v']=="yes" ){//登入才顯示此列 ?>
				<tr> <!-- 回覆、刪除、修改欄位 -->
					<td>			
						<a href="reply.php?replyID=none&messageID=<?php echo htmlentities($rs['id']) ?>&msg=normal">回覆</a><!-- 前往id為guestID的回覆頁面 -->			
					</td>
					<td>
						<?php if($_SESSION['v']!="yes"){?>
							<a href="board.php?msg='dont_delete'">刪除</a>
						<?php }else if($username!=$rs['username']){ ?>
							<a href="board.php?msg=delete&msg_2=not_the_same_user">刪除</a>
						<?php }else{ ?>
							<a href="board.php?id=<?php echo htmlentities($rs['id'])?>&msg=delete">刪除</a>
						<?php } ?>		
					</td>
					<td>
						<?php if($_SESSION['v']!="yes"){?>
							<a href="php_replyerror.php?msg='notlogin'">修改留言</a>
						<?php }else if($username!=$rs['username']){ ?>
							<a href="board.php?msg=fix_message&msg_2=not_the_same_user">修改留言</a>
						<?php }else{ ?>
							<!--<a href="php_fixpost.php?id=<?php echo htmlentities($rs['id']) ?>">修改</a> -->
							<a href="reply.php?replyID=none&messageID=<?php echo htmlentities($rs['id']) ?>&msg=fix_message">修改留言</a>

						<?php } ?>			
					</td>

				</tr>
						<?php } ?>
		</thead>
				<tr>
					<td>username</td>
					<td colspan="2"  width="500" ><?php echo htmlentities($rs['username']);?></td>
				</tr>
				<tr>
					<td>留言時刻</td>
					<td colspan="2"  width="500"><?php echo $rs['guestTime'];?></td>
				</tr>
				<tr>
					<td>留言內容</td>
					<td colspan="2"  width="500" height="300px" >
					<p style="word-break:break-all"><?php echo htmlentities($rs['content']) ;?></td>
					</p>
				</tr>


			<?php 
					$result=mysql_query("select * from reply");
					while($row_result=mysql_fetch_assoc($result)){//將留言內容從資料表{reply}抓出
						if($row_result['messageId']==htmlentities($rs['id'])){
							//if($rs['replyer']!=''){ 
			?>
				<tr>
					<td colspan="3" ><?php echo  $row_result['username'] ?>回覆</td><?php //變成假如沒有人回應，就隱藏此欄位  可以用資料儲存replyer的欄位  if replyer 存在 再顯示此欄位?>
				</tr>
				<tr>
					<td>回覆時刻</td>
					<td colspan="2"  width="500">
						<?php echo $row_result['replyTime'];?>
					</td>
				</tr>
				<tr>
					<td colspan="3"	width="500">
						<p style="word-break:break-all"><?php echo htmlentities($row_result['content']);?></p>
					</td>
				</tr>

			<?php if($_SESSION['v']=="yes" ){//登入才顯示此列 ?>
				<tr><!-- 修改回覆欄位 -->
					<td colspan="3"	width="500">
					<?php if($_SESSION['v']!="yes"){?>
						<a href="php_replyerror.php?msg=''">修改回覆</a>				
					<?php }else if($username!=$row_result['username']){ ?>
						<a href="board.php?msg=fix_reply&msg_2=not_the_same_user">修改回覆</a>
					<?php }else{ ?>
						<a href="reply.php?replyID=<?php echo $row_result['id'] ?>&messageID=<?php echo htmlentities($rs['id']) ?>&msg=fix ">修改回覆</a>
					</td>		
				</tr>
					<?php } ?>
					<?php if($_SESSION['v']=="yes" ){//登入才顯示此列 ?>
						<tr><!-- 刪除回覆欄位 -->
							<td colspan="3">
								<?php if($_SESSION['v']!="yes"){?>
										<a href="php_replyerror.php?msg=''">刪除回覆</a>
									
								<?php }else if($username!=$row_result['username']){ ?>										
										<a href="board.php?msg=delete_reply&msg_2=not_the_same_user">刪除回覆</a>

								<?php }else{ ?>
										<a href="board.php?replyID=<?php echo $row_result['id'] ?>&guestID=<?php echo htmlentities($rs['id']) ?>&msg=delete_reply ">刪除回覆</a>
								<?php } ?>

								<?php }
									} ?><!--  end of 抓取replyer的資料  -->


							</td>
						</tr>
						<?php } ?>

					<?php } ?>


				</table>
				<?php echo "</br>" ?>
			<?php
				}
			?>	
	  <!-- 留言板  -->


                <a href="board.php?msg=logout"><button>登出</button></a>

        </body>
</html>

<!-- 接下來做留言功能，先做好資料表，再寫php  done -->
<!-- 這部分做好後，開始做回覆頁面，更改密碼頁面 刪除留言-->
	<!-- 刪除留言  done-->
	<!-- 新增回覆  done -->
	<!-- 更改回覆  done -->
	<!-- 更改留言  與更改回覆用同一個file，用msg的訊息區別用途   done  -->
	<!-- 刪除回覆       done -->


	
<!-- 帳密部分還沒有防各種注入 -->
<!-- 此網頁撰寫方式很容易被有心人士刪除留言，只要知道url的構造，就很容易假造刪除留言 -->

<!-- 留言板裡的字，不知道為什麼是白色的  done>>use css >>color:black;-->
