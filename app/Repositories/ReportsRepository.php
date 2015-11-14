<?php
/**
 * Created by PhpStorm.
 * User: Ahmad
 * Date: 11/9/2015
 * Time: 4:36 PM
 */

namespace App\Repositories;


use App\Report;

class ReportsRepository
{
    public function generateLinks(Report $report){
        $item=$report->itemable;
        if($report->itemable_type=='App\Post'){
            return route('home.post.preview',['profile'=>$item->user->id,'post'=>$item->id]);
        }elseif($report->itemable_type=='App\Article'){
            return route('profile.article.preview',['article'=>$item->id]);
        }elseif($report->itemable_type=='App\Problem'){
            return route('group.problemPreview',['group'=>$item->parentable_id,'problem'=>$item->id]);
        }
    }
}