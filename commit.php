<?php 
if(isset($_POST["num"])){
   $num = $_POST["num"];	
   $comm = $_POST['ppst'];	                    
   $comm = filter_var($comm, FILTER_SANITIZE_STRING);

   if (strlen($comm) > 120) { $comm = substr($comm,0,120); }
   $subDate  = date('y.m.d');
   $fp = fopen("comments/".$num.".txt","a+") or exit("File open Err.");  
   fputs($fp, $subDate.'&nbsp;&#149; '.$comm."\n");                  
   fclose($fp);       
   header('Location:index.php?post='.$num);} else { header('Location:index.php');}
?>
