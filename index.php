<!DOCTYPE html><html lang='hu'><head><meta charset="utf8">
<title>nyugat.online</title>
<link href="def.css" rel="stylesheet" type="text/css" /><style> a { text-decoration: none; } </style></head>
<body><div class="cent"><center><a href="index.php"><h1>your.site</h1></a>

<?php if(isset($_GET["post"])){   

    $num = $_GET["post"];	
    $fp=fopen("count/".$num.".txt","r") or exit("File open err!");
    $nuc =fread($fp,filesize("count/".$num.".txt"));  	
    fclose($fp);	
    
    $nuc=$nuc+1;                        
    
    $fp = fopen("count/".$num.".txt","w") or exit("file open Err.");      
    fwrite($fp, $nuc);                  
    fclose($fp);                        
    $fp = fopen("posts/".$num.".txt","r") or exit("File open Err!");
	echo '</center><h5>&nbsp;';
	echo fgets($fp);
	echo '</h5><p>';

    fgets($fp);
    echo fread($fp,filesize("posts/".$num.".txt"));  
    fclose($fp);
    
  	echo " &#9829; ".chop($nuc);  
  	echo '<h3 align="center"><a href="index.php">your.site</h3></a></div>';

    $comm = file('comments/'.$num.'.txt');
    foreach($comm as $comment) { echo ' '.$comment.'<hr>';}
           
    echo '<p>Micro comment capability. <b>120</b> Chars. HTML not allowed:<form name="pop" action="commit.php" method="post">';    
    echo '<input type="text" name="ppst" size="100"/> ';
    echo '<input type="hidden" name="num" value="',$num,'">'; 
    echo '<input type="submit" name="submit" value="Send" /></form></p>';  
    }
        
else{
    echo '</center>';
    $i = 0;
    $dir = 'posts/';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){ if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) $i++;}}
    $x=1;         
    while($i >= $x) {
    echo "<a href=index.php?post=",$i,"><h4>"; 
    $file=fopen("posts/".$i.".txt","r") or exit("Open file Err!"); 
    echo "&nbsp; ".fgets($file)."</h4></a>";
    fclose($file); $i--;} 
    }                    
            
    $ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $dateTime = date('y.m.d G:i:s');
    $file = fopen("kerberos/visitors.txt", "a+");
    $data = "$ip - $dateTime - $browser.\n";
    fwrite($file, $data);
    fclose($file);
    
    echo '<h3><center> W. Weston - &#169; all nights deserved</center></h3><br><br>';
?>
</body>
</html>

