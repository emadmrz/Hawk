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
        }elseif(in_array($extension, ['doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt'])){
            return 'file';
        }elseif(in_array($extension, ['avi', 'ogg', 'wmv'])){
            return 'video';
        }

    }
}
