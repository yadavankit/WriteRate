<?php 

class comparadorImg 
{ 
    private $size; 
    
    public function comparadorImg($size) 
    { 
        $this->size=$size; 
    } 
    
    //Achicar la imagen. 
    private function resizeImage($type,$file,$w,$h) 
    { 
        $img_original = null; 
        
        if ($type=='png') 
            $img_original = imagecreatefrompng($file); 

        if ($type=='jpg') 
            $img_original = imagecreatefromjpeg($file); 
            
        $max_ancho = $w; 
        $max_alto = $h; 
        list($ancho,$alto) = getimagesize($file); 
        $x_ratio = $max_ancho/$ancho; 
        $y_ratio = $max_alto/$alto; 
        
        if(($ancho<=$max_ancho)&&($alto<=$max_alto)) 
        { 
            $ancho_final = $ancho; 
            $alto_final = $alto; 
        } 
        elseif (($x_ratio * $alto) < $max_alto) 
        { 
            $alto_final = ceil($x_ratio * $alto); 
            $ancho_final = $max_ancho; 
        } 
        else 
        { 
            $ancho_final = ceil($y_ratio * $ancho); 
            $alto_final = $max_alto; 
        } 
        
        $tmp = imagecreatetruecolor($ancho_final,$alto_final); 
        imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto); 
        imagedestroy($img_original); 
        
        return $tmp; 
    } 
    
    //Guardar en disco el archivo. 
    private function save_resizeImage($type,$fileOrigen,$fileSalida,$w,$h,$calidad) 
    { 
        $img = resizeImage($fileOrigen,$w,$h); 
        //resizeImage($type,$tmp,$fileSalida,$calidad); 
    } 
    
    //Salida por browser. 
    private function show_resizeImage($type,$file,$w,$h) 
    { 
        if ($type=='png') 
        { 
            header("Content-type: image/png"); 
            $img = $this->resizeImage($type,$file,$w,$h); 
            imagepng($img); 
        } 
        
        if ($type=='jpg') 
        { 
            header("Content-type: image/jpeg"); 
            $img = $this->resizeImage($type,$file,$w,$h); 
            imagejpeg($img); 
        } 
    } 
  
    //Convertir imagen a escala de grises. 
    private function convertir_BW($img) 
    { 
        imagefilter($img, IMG_FILTER_GRAYSCALE); 
    } 

    //Calcula cual es el color promedio más usado. 
    private function average($img) 
    { 
        $w = imagesx($img); 
        $h = imagesy($img); 
        $r = $g = $b = 0; 
        
        for($y = 0; $y < $h; $y++) 
        { 
            for($x = 0; $x < $w; $x++) 
            { 
                $rgb = imagecolorat($img, $x, $y); 
                $r += $rgb >> 16; 
            } 
        } 
        
        $pxls = $w * $h; 
        $r = (round($r / $pxls)); 

        //return $r ."," . $g .",". $b; 
        if($r<10) 
            $r=0; 
            
        if($r>245) 
            $r=255; 
            
        return $r; 
    } 
    
    //Obtengo un array con el hash. 
    private function ComputeHash($img, $avg = 100) 
    { 
        $w = imagesx($img); 
        $h = imagesy($img); 
        
        $matrix = array(); 
        
        $r = $g = $b = 0; 
        
        for($y = 0; $y < $h; $y++) 
        { 
            $fila = ""; 
            
            for($x = 0; $x < $w; $x++) 
            { 
                $rgb = imagecolorat($img, $x, $y); 
                $r = $rgb >> 16; 
                
                if($r <= $avg) 
                    $fila = $fila."0"; 
                else 
                    $fila = $fila."1"; 
            } 
            $matrix[$y]=$fila; 
        } 
        
        return $matrix; 
    } 
    
    //Vuelco el array a un string. 
    private function concatenar_array($array) 
    { 
        $txt =""; 
        
        for ($i=0;$i<=count($array)-1;$i++) 
        { 
            $tmp = $array[$i]; 
            $txt = $txt.$tmp; 
        } 
        
        return $txt; 
    } 
    
    //Armo el color que se aplicara a un pixel. 
    private function crear_color($img,$r,$g,$b) 
    { 
        return imagecolorallocate($img,$r,$g,$b); 
    } 
    
    //Transformar el hash a una imagen. 
    private function hash_img_bits($img,$hashMatrix) 
    { 
        $w = imagesx($img); 
        $h = imagesy($img); 
        
        $deltaImg = imagecreatetruecolor($w, $h); 
        imagecopy($deltaImg, $img,0,0,0,0,$w,$h); 
        
        $negro = imagecolorallocate( $deltaImg , 0 , 0 , 0); 
        $blanco = imagecolorallocate( $deltaImg , 255 , 255 , 255); 
        
        $x = 0; 
        $y = 0; 
        
        for($y=0; $y < $h; $y++) 
        { 
            for($x=0; $x < $w; $x++) 
            { 
                $tmp = $hashMatrix[$y]; 
                $bit = $tmp[$x]; 
            
                if ($bit=='1') 
                    imagesetpixel($deltaImg, $x,$y,$blanco); 
                else 
                    imagesetpixel($deltaImg, $x,$y,$negro); 
            } 
        } 

        return $deltaImg; 
    } 
    
    //Genera todo el proceso de hasheo de una imagen. 
    private function hash_img($file,$type,$size) 
    { 
        $img = $this->resizeImage($type,$file,$size,$size); 
        $this->convertir_BW($img); 
        $avg = $this->average($img); 
        $hash = $this->ComputeHash($img,$avg); 
        
        return $hash; 
    } 
    
    //Calcula el porcentaje de diferencias. 
    private function calc_dif_porc_hash($h1,$h2) 
    { 
        $fail = 0; 
        
        for($x=0;$x <=strlen($h2)-1;$x++) 
        { 
            if($h1[$x] != $h2[$x]) 
                $fail++; 
        } 
        
        $delta = ($fail*100)/strlen($h2); 
        
        return $delta; 
    } 
    
    //Obtengo la extension del archivo. 
    private function get_file_ext($file) 
    { 
        return pathinfo($file, PATHINFO_EXTENSION); 
    } 
    
    //Obtengo el hash de una imagen. 
    public function getHash_img($img) 
    { 
        $ext = $this->get_file_ext($img); 
        $hash1 = $this->hash_img($img,$ext,$this->size); 
        return $this->concatenar_array($hash1); 
    } 
    
    //Comparar dos imagenes. 
    public function comparar_imgs($img1,$img2) 
    { 
        $ext1 = $this->get_file_ext($img1); 
        $hash1 = $this->hash_img($img1,$ext1,$this->size); 
        $hash1_str = $this->concatenar_array($hash1); 
        
        $ext2 = $this->get_file_ext($img2); 
        $hash2 = $this->hash_img($img2,$ext2,$this->size); 
        $hash2_str = $this->concatenar_array($hash2); 
        
        $dif = $this->calc_dif_porc_hash($hash1_str,$hash2_str); 
        return $dif; 
    } 
} 
    
?> 