<?php
class Image
{
    public $width = 0; // php加上this預設就為0,因此可不填寫
    public $height = 0; // php加上this預設就為0,因此可不填寫
    public $url = null;
    public $data = null;
    public $origin = null;
    public $thumb = null;
    public $css_object_fit = 'fill';
    private $x;
    private $y;

    // getimagesizefromstring($str)
    function __construct($data)
    {
        $this->data = $data;
        list($this->width, $this->height) = getimagesizefromstring($data); // 傳回陣列 一長一寬
    }

    function resize($x, $y, $mode)
    {
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
        // $origin = imagecreatefromjpeg($this->url);
        $origin = imagecreatefromstring($this->data);
        imagecopyresized(
            $gc,
            $origin,
            0,
            0,
            0,
            0,
            $newwidth,
            $newheight,
            $this->width,
            $this->height
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

    function getImageSrc($type)
    {
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

// $data = file_get_contents('https://i.ppfocus.com/2020/12/23214bdb6d9a.jpg');
// $image = new Image($data);
// // $image = new Image('https://i.ppfocus.com/2020/12/23214bdb6d9a.jpg');
// $image->resize(500, 500, 'fill'); // fill, aspectfill, aspectfit
// list($src, $css_width, $css_height, $css_object_fit) = $image->getImageSrc('thumb');
?>