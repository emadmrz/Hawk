<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 07/09/2015
 * Time: 05:31 PM
 */

namespace App\Repositories;


use Illuminate\Support\Facades\File;

class CropperRepository {

    public function crop($baseName, $directory, $src, $data) {
        $isDone=0;
        $data = json_decode(stripslashes($data));
        $dst = public_path() . '/img/'.$directory.'/'.$baseName.'.png';
        if (!empty($src) && !empty($dst) && !empty($data)) {
            switch (strtolower(File::extension($src))) { //exif_imagetype($src)
                case 'jpeg':
                case 'jpg':
                    $src_img = imagecreatefromjpeg($src);
                    break;

                case 'png':
                    $src_img = imagecreatefrompng($src);
                    break;
            }

            if (!$src_img) {
                $msg = "Failed to read the image file";
                return;
            }

            $size = getimagesize($src);
            $size_w = $size[0]; // natural width
            $size_h = $size[1]; // natural height

            $src_img_w = $size_w;
            $src_img_h = $size_h;

            $degrees = $data -> rotate;

            // Rotate the source image
            if (is_numeric($degrees) && $degrees != 0) {
                // PHP's degrees is opposite to CSS's degrees
                $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

                imagedestroy($src_img);
                $src_img = $new_img;

                $deg = abs($degrees) % 180;
                $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

                $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
                $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

                // Fix rotated image miss 1px issue when degrees < 0
                $src_img_w -= 1;
                $src_img_h -= 1;
            }

            $tmp_img_w = $data -> width;
            $tmp_img_h = $data -> height;
//            $dst_img_w = 220;
//            $dst_img_h = 220;
            $dst_img_w = $data -> width;
            $dst_img_h = $data -> height;

            $src_x = $data -> x;
            $src_y = $data -> y;

            if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
                $src_x = $src_w = $dst_x = $dst_w = 0;
            } else if ($src_x <= 0) {
                $dst_x = -$src_x;
                $src_x = 0;
                $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
            } else if ($src_x <= $src_img_w) {
                $dst_x = 0;
                $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
            }

            if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
                $src_y = $src_h = $dst_y = $dst_h = 0;
            } else if ($src_y <= 0) {
                $dst_y = -$src_y;
                $src_y = 0;
                $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
            } else if ($src_y <= $src_img_h) {
                $dst_y = 0;
                $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
            }

            // Scale to destination position and size
            $ratio = $tmp_img_w / $dst_img_w;
            $dst_x /= $ratio;
            $dst_y /= $ratio;
            $dst_w /= $ratio;
            $dst_h /= $ratio;

            $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

            // Add transparent background to destination image
            imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
            imagesavealpha($dst_img, true);

            $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

            if ($result) {
                if (!imagepng($dst_img, $dst)) {
                    $msg = "Failed to save the cropped image file";
                }else{
                    $isDone=1;
                    unlink($src);
                    $msg='Done';
                }
            } else {
                $msg = "Failed to crop the image file";
            }

            imagedestroy($src_img);
            imagedestroy($dst_img);

            $response = array(
                'state'  => 200,
                'message' => $msg,
                'result' => asset('img/'.$directory.'/'.$baseName.'.png'),
                'isDone' =>$isDone
            );

            return $response;
        }
    }

}