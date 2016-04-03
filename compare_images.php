<?php 
    session_start();
    include 'comparer.php';
    include 'resizer.php'; 

    $comparador = new comparadorImg(8); 

    $result_dif=array(); 
    $result_sim=array();

    for($i=1; $i<=5;$i++)    
    {
        $al= "alphabet".$i;
      $alphabet=$_SESSION[$al]; 
       $ideal = 'processed_ideal/'.$alphabet.'.jpg'; 
       $uploaded = 'uploaded_photo/'.$alphabet.'.jpg'; 
       $resizedfile='resized_img/'.$alphabet.'.jpg';
       smart_resize_image($uploaded,null,450,450,false,$resizedfile,false,false,100);

      $hash = $comparador->getHash_img($ideal); 
       $dif = $comparador->comparar_imgs($ideal,$resizedfile);

       $result_dif[$i]=$dif;
       $sim=100-$dif;
       $result_sim[$i]=$sim;
    
       echo "Ideal Image<br><img src='ideal_img/".$alphabet.".jpg'><br><br>"; 
       echo " Uploaded Image <img src='uploaded_photo/".$alphabet.".jpg'><br><br>"; 
        
       echo "<b>Differences</b> ".$dif."%<br>"; 
      echo "<b>Similarities</b> ".(100-$dif)."%<br>";
    }

    $average = array_sum($result_sim) /5;
    $_SESSION['average'] = $average;

    echo '<form method="post" action="result.php"> <input type="submit">See Result Here</form>'    
?> 