<?php

namespace Application\Captcha;

class Captcha
{

    const IMG = __DIR__ . '/../../inc/noise.jpg';
    const FONT = __DIR__ . '/../../inc/bellb.ttf';
    const STR_LENGTH = 5;
    const CAPTCHA = __DIR__ . '/../../inc/captcha.jpg';

    private $img;
    private $string;
    private $color;

    public function __construct()
    {
        $this->img = imagecreatefromjpeg(self::IMG);
        $this->string = $this->createRandStr(self::STR_LENGTH);
        $this->color = imagecolorallocate($this->img, 108, 108, 108);
        $this->createCaptcha();
        $this->captchaSession();
    }

    public function createCaptcha()
    {
        imageantialias($this->img, true);
        $x = 20;
        $y = 20;
        for ($i = 0; $i < self::STR_LENGTH; $i++) {
            $size = rand(16, 30);
            $angle = -30 + rand(0, 60);
            imagettftext($this->img, $size, $angle, $x, $y, $this->color, self::FONT, $this->string[$i]);
            $x += 40;
        }
        imagejpeg($this->img, self::CAPTCHA, 50);
    }

    public function createRandStr($length)
    {
        $string = '';
        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }
        return strtolower($string);
    }

    public function captchaSession()
    {
        session_start();
        $_SESSION['captcha'] = $this->string;
    }

}