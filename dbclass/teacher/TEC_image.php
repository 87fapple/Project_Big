<?php
class Image {
   public $origin = null;
   public $thumb = null;
   public $css_object_fit = 'fill';
   private $x;
   private $y;


   function __construct($url) {
       $this->url = $url;
       list($this->width, $this->height) = getimagesize($url);
   }


   function resize($x, $y, $mode) {
       $this->x = $x;
       $this->y = $y;
       $ratio = $this->width / $this->height;
       switch ($mode) {
           case 'fill':
               $this->css_object_fit = 'fill';
               $newwidth = $x;
               $newheight = $y;
               break;
              
           case 'aspectfill':
               $this->css_object_fit = 'cover';
               if ($y > $x) {
                   $newwidth = $x;
                   $newheight = (int)($newwidth / $ratio);
               } else {
                   $newheight = $y;
                   $newwidth = (int)($newheight * $ratio);
               }
               break;


           case 'aspectfit':
               $this->css_object_fit = 'contain';
               if ($y > $x) {
                   $newheight = $y;
                   $newwidth = (int)($newheight * $ratio);
               } else {
                   $newwidth = $x;
                   $newheight = (int)($newwidth / $ratio);
               }
               break;
       }


       $gc = imagecreatetruecolor($newwidth, $newheight);
       $origin = imagecreatefromjpeg($this->url);
       imagecopyresized(
           $gc,
           $origin,
           0, 0, 0, 0,
           $newwidth, $newheight, $this->width, $this->height
       );


       ob_start();
       imagejpeg($gc);
       $this->thumb = ob_get_contents();
       ob_end_clean();


       ob_start();
       imagejpeg($origin);
       $this->origin = ob_get_contents();
       ob_end_clean();   
   }


   function getImageSrc($type) {
       switch ($type) {
           case 'origin':
               $mime_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($this->origin);
               $base64 = base64_encode($this->origin);
               $src = "data:{$mime_type};base64,{$base64}";
               break;


           case 'thumb':
               $mime_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($this->thumb);
               $base64 = base64_encode($this->thumb);
               $src = "data:{$mime_type};base64,{$base64}";
               break;
       }
       return [$src, $this->x . 'px', $this->y . 'px', $this->css_object_fit];
   }
}


$image = new Image('https://animals.sandiegozoo.org/sites/default/files/2016-08/hero_zebra_animals.jpg');
$image->resize(200, 200, 'aspectfit');    // fill, aspectfill, aspectfit
list($src, $css_width, $css_height, $css_object_fit) = $image->getImageSrc('thumb');  // origin, thumb
// die($css_object_fit);
?>


<html>
<style>
.image {
   object-fit: <?= $css_object_fit ?>;
   /* object-position: 50% 50%; */
   width: <?= $css_width ?>;
   height: <?= $css_height ?>;
   border: solid 2px red;
}
</style>
<body>
   <img class="image" src="<?= $src ?>">
</body>
</html>
