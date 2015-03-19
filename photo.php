# Photo_Bucket
This is a website to add and store photos. Created using PHP and MySQL
<?php
require_once('head.php');
?>
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
<div id="nav"> </div>
<div id="main2"> 
<p>Please Choose a File and click Submit</p>
<form enctype="multipart/form-data" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<input name="userfile" type="file" />
<input type="submit" value="Submit" />
</form>
<?php
// check if a file was submitted
if(!isset($_FILES['userfile']))
{
    echo '<p>Please select a file</p>';
}
else
{
    try {
    $msg= upload();  //this will upload your image
    echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
    echo $e->getMessage();
    echo 'Sorry, could not upload file';
    }
}
// the upload function
function upload() {
    include "file_constants.php";
    $maxsize = 10000000; //set to approx 10 MB
    //check associated error code
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    
            //checks size of uploaded image on server side
            if( $_FILES['userfile']['size'] < $maxsize) {  
               //checks whether uploaded file is of image type
              //if(strpos(mime_content_type($_FILES['userfile']['tmp_name']),"image")===0) {
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    
                    // prepare the image for insertion
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
                    // put the image in the db...
                    // database connection
                    @$abc = mysqli_connect($host, $user, $pass, $db);// OR DIE (mysql_error());
                    // select the db
                    //                                     mysql_select_db ($db) OR DIE ("Unable to select db".mysql_error());
                    // our sql query
                    $sql = "INSERT INTO test_image
                    (image, name)
                    VALUES
                    ('{$imgData}', '{$_FILES['userfile']['name']}');";
                    // insert the image
                    mysqli_query($abc, $sql); // or die("Error in Query: " . mysql_error());
                    $msg='<p>Image successfully saved in database with id ='. mysqli_insert_id($abc).' </p>';
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
             else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
                ' bytes</div><hr />';
                }
        }
        else
            $msg="File not uploaded successfully.";
    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    return $msg;
}
// Function to return error message based on error code
function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>                                       
                                                      <!-- ends -->                                       

</div>
<div class="section" id="main3"> 
<li><a href="family_photos.php">FAMILY PHOTOS</a>
<!--
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
-->
</li>
</div>
</body>
</html>
