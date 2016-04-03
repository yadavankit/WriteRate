<?php 
    session_start();
    include 'comparer.php'; 
    require 'connect.php';
    $comparador = new comparadorImg(8); 

    $alphabet=$_SESSION['alphabet'];
    $f1 = 'ideal_img/'.$alphabet.'.jpg'; 
    $f2 = 'photo/'.$alphabet.'.jpg'; 
   // var_dump($f1);
    $hash = $comparador->getHash_img($f1); 
    echo $hash; 
    $dif = $comparador->comparar_imgs($f1,$f2); 
    
    echo "<br><img src='".$f1."'><br><br>"; 
    echo "<img src='".$f2."'><br><br>"; 
        
    echo "<b>Diferencias</b> ".$dif."%<br>"; 
    echo "<b>Similitudes</b> ".(100-$dif)."%<br>"; 
    
?> 