<?php namespace App\Libs;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: qdladoooo
 * Date: 14/7/13
 * Time: PM9:39
 */

class Utils {
    //产生指定长度的随机字符串
    public static function getRandStr($length, $type = 'mixed') {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if( $type == 'number' ) {
            $str = '0123456789';
        }

        $randString = '';
        $len = strlen($str)-1;
        for($i = 0;$i < $length;$i ++){
            $num = mt_rand(0, $len);
            $randString .= $str[$num];
        }
        return $randString;
    }

    //获取验证码
    public static function getAuthImage($text) {
        $im_x = 160;
        $im_y = 40;
        $im = imagecreatetruecolor($im_x,$im_y);
        $text_c = ImageColorAllocate($im, mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
        $tmpC0=mt_rand(100,255);
        $tmpC1=mt_rand(100,255);
        $tmpC2=mt_rand(100,255);
        $buttum_c = ImageColorAllocate($im,$tmpC0,$tmpC1,$tmpC2);
        imagefill($im, 16, 13, $buttum_c);

        $font = storage_path() . '/fonts/t1.ttf';

        for ($i=0;$i<strlen($text);$i++)
        {
            $tmp =substr($text,$i,1);
            $array = array(-1,1);
            $p = array_rand($array);
            $an = $array[$p]*mt_rand(1,10);//角度
            $size = 28;
            imagettftext($im, $size, $an, 15+$i*$size, 35, $text_c, $font, $tmp);
        }


        $distortion_im = imagecreatetruecolor ($im_x, $im_y);

        imagefill($distortion_im, 16, 13, $buttum_c);
        for ( $i=0; $i<$im_x; $i++) {
            for ( $j=0; $j<$im_y; $j++) {
                $rgb = imagecolorat($im, $i , $j);
                if( (int)($i+20+sin($j/$im_y*2*M_PI)*10) <= imagesx($distortion_im)&& (int)($i+20+sin($j/$im_y*2*M_PI)*10) >=0 ) {
                    imagesetpixel ($distortion_im, (int)($i+10+sin($j/$im_y*2*M_PI-M_PI*0.1)*4) , $j , $rgb);
                }
            }
        }
        //加入干扰象素;
        $count = 160;//干扰像素的数量
        for($i=0; $i<$count; $i++){
            $randcolor = ImageColorallocate($distortion_im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($distortion_im, mt_rand()%$im_x , mt_rand()%$im_y , $randcolor);
        }

        $rand = mt_rand(5,30);
        $rand1 = mt_rand(15,25);
        $rand2 = mt_rand(5,10);
        for ($yy=$rand; $yy<=+$rand+2; $yy++){
            for ($px=-80;$px<=80;$px=$px+0.1)
            {
                $x=$px/$rand1;
                if ($x!=0)
                {
                    $y=sin($x);
                }
                $py=$y*$rand2;

                imagesetpixel($distortion_im, $px+80, $py+$yy, $text_c);
            }
        }

        //设置文件头;
        Header("Content-type: image/JPEG");

        //以PNG格式将图像输出到浏览器或文件;
        ImagePNG($distortion_im);

        //销毁一图像,释放与image关联的内存;
        ImageDestroy($distortion_im);
        ImageDestroy($im);
    }

    //分页
    public static function paginator($url, $page, $max_page, $sample = false, $label_num = 5) {
        $content = '<div class="pages ac">';
        $content .='<span>共 ' . $max_page . '页</span>';
        if($page != 1) {
            $content .= '<a class="pageTxt" href="' . $url . 'p=1">首页</a>';
            if(!$sample) {
                $content .= '<a class="pageTxt" href="' . $url . 'p=' . ($page-1) . '">上一页»</a>';
            }
        }

        $start = ($page - floor($label_num/2));
        $start = ($start > 0) ? $start : 1;
        $end = $start + $label_num;
        $end = ($end < $max_page) ? $end : $max_page;
        for($item=$start; $item<=$end; $item++) {
            if($item == $page) {
                $content .= "<strong>{$item}</strong>";
            } else {
                $content .= '<a href="' . $url . 'p=' . $item . '">' . $item . '</a>';
            }
        }
        if($page != $max_page) {
            if(!$sample) {
                $content .= '<a class="pageTxt" href="' . $url . 'p=' . ($page+1) . '">下一页»</a>';
            }
            $content .= '<a class="pageTxt" href="' . $url . 'p=' . $max_page . '">末页</a>';
        }
        $content .='</div>';

        return $content;
    }
}
