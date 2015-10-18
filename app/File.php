<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\Flysystem\Util\MimeType;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['user_id', 'real_name', 'name', 'size', 'imageable_id', 'imageable_type'];

    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public function getExtensionAttribute(){
        $extension = pathinfo($this->attributes['name'], PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        if(in_array($extension, ['jpg','jpeg','png','bmp', 'gif'])){
            return 'image';
        }elseif(in_array($extension, ['pdf'])){
            return 'pdf';
        }elseif(in_array($extension, ['doc', 'docx'])){
            return 'doc';
        }elseif(in_array($extension, ['ppt', 'pptx'])){
            return 'ppt';
        }elseif(in_array($extension, ['xls', 'xlsx'])){
            return 'xls';
        }elseif(in_array($extension, ['txt'])){
            return 'txt';
        }elseif(in_array($extension, ['accdb', 'accdbx'])){
            return 'accdb';
        }elseif(in_array($extension, ['avi'])){
            return 'avi';
        }elseif(in_array($extension, ['mov'])){
            return 'mov';
        }elseif(in_array($extension, ['wav'])){
            return 'wav';
        }elseif(in_array($extension, ['mp3'])){
            return 'mp3';
        }

    }
}
