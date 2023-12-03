<?php 

if(isset($_POST['submitbt']) && isset($_POST['file'])){
        $file=$_FILES['file'];
       $filename=$_FILES['file']['name'];
       $filetype=$_FILES['file']['type'];
       $filetmpname=$_FILES['file']['tmp_name'];
       $filesize=$_FILES['file']['size'];
       $fileerror=$_FILES['file']['error'];

       $fileExt= explode('.',$filename);
       $fileActualExt= strtolower(end($fileExt));

       $allowed = array('jpg','jpeg','png','pdf');
   
       if(in_array($fileActualExt,$allowed)){
         if($fileerror===0){
            if($filesize < 1000000){
                $fileNameNew=uniqid('',true).".". $fileActualExt;
                $filedestination='uploads/'. $fileNameNew;
                move_uploaded_file(  $filetmpname , $filedestination);
               $add=$dns->prepare('INSERT INTO files SET filename=? ');
               $ok=$add->execute(array($fileNameNew));
               if($ok){
                echo 'the file is saved ';

               }else{
                echo 'the file is not saved';
               }

            }else{
                echo "your file is too big";
            }

         }else{
            echo "there was an error uploading your file";
         }
       }else{
        $fileerror="<p>you can not upload files of this type</p>";
       }

     }
     ?>

     <!DOCTYPE html>
     <html lang="en">
     <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
       .card{
        width: 800px;
        height: 600px;
        background-color: beige;
        color:azure;
       }
        </style>
     </head>
     <body>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
     <div class="card">
		    <label class="form-label">des photos d'incident</label>
		    <input type="file" 
		           class="file"
		           name="file">
		  </div><br>
            <input type="submit" name="submitbt"  class="signupbt" value="Submit"> 
    </form>
        
     </body>
     </html>