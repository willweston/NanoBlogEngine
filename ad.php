<?php  if (!isset($_POST['submit'])) { ?>

<!DOCTYPE html><meta charset="UTF-8">
<html lang='hu'><head><title>add post</title>
<script type="text/javascript" src="e/ed.js"></script></head>
<body>
  <div id="main">
    <div id="caption" ><center>add post</center></div>
    <hr><center>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">    

    <?php
    $categ=file('categories.txt');
    foreach($categ as $catt) { 
    echo '<input type="radio" name="kat" value="'.$catt.'">'.$catt.'</input> |';}  
    ?>    

    <hr>
        Lead:&nbsp;
        <input type="text" name="title" size="70"/><br/><br/>


    <script>edToolbar('mytxtarea'); </script>
    <textarea name="mytxtarea" id="mytxtarea" class="ed" rows="24" cols="115"></textarea>

    <br>
    <center><input type="submit" name="submit" value="Save" /></center>
    </form> 
    </center><hr>
  </div>
</body>   

<?php } else {
   $catego      = isset($_POST['kat']) ? $_POST['kat'] : 'Untitled';
   $newsTitel   = isset($_POST['title']) ? $_POST['title'] : 'Untitled';
   $submitDate  = date('Y.m.d');
   $newsContent = isset($_POST['mytxtarea']) ? $_POST['mytxtarea'] : 'No content';
   
    $i = 1;
    $dir = 'posts/';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) $i++;}}

   settype($i,"string");
   $f = fopen('posts/'.$i.".txt","w+");
   $catego = rtrim($catego);
   
   fwrite($f,$newsTitel."\n");
   fwrite($f,$catego."\n");
   fwrite($f,$newsContent."\n");
   fwrite($f,"<p> <b> W. Weston</b> - ".$submitDate." ");
   fclose($f);

   $f = fopen('count/'.$i.".txt","w+");         
   fwrite($f,"0");
   fclose($f);
   
   $f = fopen('comments/'.$i.".txt","w+");         
   fclose($f);      
   header('Location:index.php');   }
?>