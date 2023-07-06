<?php
require_once('DB.php');
require('image.php');

class user
{
    private $token = null;
    public $nextPage = null;
    public $cname = null;
    public $pwd = null;
    public $image = null;
    public $src = null;
    public $css_width = null;
    public $css_height = null;
    public $css_object_fit = null;

    function __construct($uid, $pwd, $timeout = 120)
    {
        DB::select('call login(?, ?)', function ($rows) use ($timeout) {
            $this->token = $rows[0]['token'];
            $this->nextPage = $rows[0]['result'];

            setcookie('token', $this->getToken(), time() + $timeout);
            setcookie('welcome', $this->nextPage, time() + $timeout);
        }, [$uid, $pwd]);

        $this->getInfo();
    }

    function redirect()
    {
        header("location: {$this->nextPage}");
    }
    
    function getInfo(){
        if ($this->token != null) {
            DB::select('select * from userinfo where token = ?', function ($rows) {
                $this->cname = $rows[0]['cname'];
                $this->pwd = $rows[0]['pwd'];
                $this->image = $rows[0]['image'];
                if ($this->image == null) {
                    $this->image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
                }
                // $photo = new Image($this->image);
                // $photo->resize(100, 100, 'fill');
                // list($this->src) = $photo->getImageSrc('thumb');
                // list($this->src, $this->css_width, $this->css_height, $this->css_object_fit) = $this->image->getImageSrc('thumb');

                $mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($this->image);
                $image_base64 = base64_encode($this->image);
                $this->src = "data:{$mine_type};base64,{$image_base64}";
            }, [$this->token]);
            $_SESSION['user'] = serialize($this);
        }
    }

    function redirect_logout()
    {
        session_destroy();
        setcookie("token", '', -1);
        setcookie("welcome", '', -1);
        setcookie("user", '', -1);

        DB::call('call logout(?)', [$this->token]);

        header("location: login_F.php");
    }

    function edituser($r_cname, $r_pwd, $r_image)
    {
        // $photo = file_get_contents($r_image);
        if ($r_cname || $r_pwd || $r_image != null) {
            $photo = new Image($r_image);
            $photo->resize(200, 200, 'fill');
            list($this->src) = $photo->getImageSrc('thumb');
            $photo = file_get_contents($this->src);

            // DB::update('update userinfo set cname= ?, pwd= ?, image = ? where token = ?', [$r_cname, $r_pwd, [$r_image], $this->token]);
            DB::update('update userinfo set cname= ?, pwd= ?, image = ? where token = ?', [$r_cname, $r_pwd, [$photo], $this->token]);
        }

        $this->getInfo();

        echo "修改成功! 三秒後自動跳轉";
        header("refresh:3;url=welcome.php");
    }

    // deprecated 已棄用,之後可能會移除
    // function login($uid, $pwd, $complete) {
    //     DB::select('call login(?, ?)', function($rows) {
    //         $this->token = $rows[0]['token'];
    //         $this->nextPage = $rows[0]['result'];
    //     }, [$uid, $pwd]);

    //     $complete($this->nextPage);
    // }

    function getToken()
    {
        return $this->token;
    }
}
