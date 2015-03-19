# Photo_Bucket
This is a website to add and store photos. Created using PHP and MySQL
<?php
require_once('head.php');
?>
<div id="header">
<table width="100%" bgcolor="white" cellpadding="2" cellspacing="2">
   <tr>
     <td width="100/6%">
            <img src="home2.jpg" alt="" height="20" width="20">
            <span class="menu" > <a href="homepage.php"><b>HOME</b> </span>                        
     </td>
     <td width="100/6%">
            <img src="friends2.jpg" alt="" height="20" width="20"/>
            <span class="menu"> <a href="friends.php">FRIENDS</a> </span>                        
     </td>
     <td width="100/6%">
            <img src="camera2.png" alt="" height="20" width="20"/>
            <span class="menu"> <a href="photos.php">PHOTOS</a> </span>                        
     </td>
     <td width="100/6%	">
            <img src="mail3.jpg" alt="" height="20" width="20"/>
            <span class="menu"><a href="mail.php"> MAILS</a> </span>                        
     </td>
     <td width="100/6%">
            <img src="news1.png" alt="" height="20" width="20"/>
            <span class="menu"><a href="news.php"> NEWS </a></span>                        
     </td>
     <td width="100/6%">
            <img src="logout2.jpg" alt="" height="20" width="20"/>
            <span class="menu"> <a href="logout.php">LOGOUT</a> </span>                        
     </td>
  </tr> 
</table>
</div>
<div id="nav"> </div>
</div>
<div class="section" id="main4"> 
<?php
 include "file_constants.php";
?>
<?php 
     $link = mysqli_connect("$host", "$user", "$pass","$db");
     mysqli_select_db($link, $db);// or die(mysql_error());
     $sql = "SELECT image FROM test_image ORDER BY id DESC";
	  $result = mysqli_query($link, $sql);
     //echo sizeof($result);
     //exit();    
     //header('Content-type: image/jpeg');
     //mysqli_close($link);
    //$row = $result->fetch_assoc();
     //echo($row["image"]);
      //$images = array();
      $images = array();
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	array_push($images,$row['image']);
}
//while($row = $result->fetch_assoc())	 
//	 echo(sizeof($images));exit();
	 foreach ($images as $image){	 	
echo '<img src="data:image/jpeg;base64,'. base64_encode($image) .'" width="360" height="240"/>';
//echo '<img src="<?php echo $row["image"];?"width=360 height=360>';
}
?>
</li>
</div>
</body>
</html>
