<?php 
    session_start();
    include 'comparer.php'; 
    require 'connect.php';
    $comparador = new comparadorImg(8); 

    for($i=0;$i<=4;$i++)
    {
        $al= "alphabet".$i;
        //echo $al;
      $alphabet=$_SESSION[$al]; 
       $f1 = 'ideal_img/'.$alphabet.'.jpg'; 
       $f2 = 'photo/'.$alphabet.'.jpg'; 
       //var_dump($f1);
       //var_dump($f2);
      $hash = $comparador->getHash_img($f1); 
       echo $hash; 
       $dif = $comparador->comparar_imgs($f1,$f2); 
    
       echo "<br><img src='".$f1."'><br><br>"; 
       echo "<img src='".$f2."'><br><br>"; 
        
       echo "<b>Diferencias</b> ".$dif."%<br>"; 
      echo "<b>Similitudes</b> ".(100-$dif)."%<br>";
    }
    /*$alphabet=$_SESSION['alphabet'];
    $alphabet1=$_SESSION['alphabet1'];
    $alphabet2=$_SESSION['alphabet2'];
    $alphabet3=$_SESSION['alphabet3'];
    $alphabet4=$_SESSION['alphabet4'];*/
    //$f1 = 'ideal_img/'.$alphabet.'.jpg'; 
    //$f2 = 'photo/'.$alphabet.'.jpg';
    /*$f1 = 'ideal_img/'.$alphabet1.'.jpg'; 
    $f2 = 'photo/'.$alphabet1.'.jpg';
    $f1 = 'ideal_img/'.$alphabet2.'.jpg'; 
    $f2 = 'photo/'.$alphabet2.'.jpg';
    $f1 = 'ideal_img/'.$alphabet3.'.jpg'; 
    $f2 = 'photo/'.$alphabet3.'.jpg';
    $f1 = 'ideal_img/'.$alphabet4.'.jpg'; 
    $f2 = 'photo/'.$alphabet4.'.jpg'; 
   // var_dump($f1);
    $hash = $comparador->getHash_img($f1); 
    echo $hash; 
    $dif = $comparador->comparar_imgs($f1,$f2); 
    
    echo "<br><img src='".$f1."'><br><br>"; 
    echo "<img src='".$f2."'><br><br>"; 
        
    echo "<b>Diferencias</b> ".$dif."%<br>"; 
    echo "<b>Similitudes</b> ".(100-$dif)."%<br>"; */
    
?> 