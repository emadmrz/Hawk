<?php

namespace App;

use App\Repositories\PaperRepository;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'papers';
    protected $fillable = ['skill_id', 'title', 'type' ,'publish_year', 'publisher', 'description', 'num_like', 'num_dislike'];
    protected $appends = ['type_name'];

    public function getTypeNameAttribute(){
        $PaperRepository = new PaperRepository();
        $name = $PaperRepository->type_name();
        return $name[$this->attributes['type']];
    }
}
