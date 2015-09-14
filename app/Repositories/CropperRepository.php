<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 07/09/2015
 * Time: 05:31 PM
 */

namespace App\Repositories;


use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CropperRepository {

    public function crop($imageName, $directory, $data) {
        $isDone=0;
        $msg ='';
        $src = public_path() . '/img/'.$directory.'/'.$imageName;
        $data = json_decode(stripslashes($data));
        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y) );
        if($directory == 'persons'){
            $img->resize(200, 200);
        }
        elseif($directory == 'cover'){
            $img->resize(1140, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->save($src, 90);
        $msg = 'Done';
        $isDone=1;

        $response = array(
            'state'  => 200,
            'message' => $msg,
            'result' => asset('img/'.$directory.'/'.$imageName),
            'isDone' =>$isDone
        );

        return $response;
        }


    }
