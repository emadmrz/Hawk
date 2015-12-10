<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\History;
use App\Paper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function comment(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'type' => 'required|in:1,-1',
        ]);
        $user = Auth::user();
        $id= $request->input('id');
        $value= $request->input('type');
        $comment = Comment::find($id);
        $isLiked = $comment->likedany($user->id);
        if(!$isLiked){
            if($value == 1){
                $comment->like($user->id);
                $isLiked=1;
            }elseif($value == -1){
                $comment->dislike($user->id);
                $isLiked=-1;
            }
        }elseif($isLiked == $value){
            $comment->unlike($user->id);
            $isLiked=0;
        }elseif($isLiked != $value){
            $comment->revertlike($user->id);
            if($isLiked==1){
                $isLiked = -1;
            }elseif($isLiked==-1){
                $isLiked = 1;
            }
        }
        return [
            'hasCallback'=>1,
            'callback'=>'comment_liked',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'num_like'=>$comment->num_like ,
                'num_dislike'=>$comment->num_dislike ,
                'is_liked'=>$isLiked
            ]
        ];
    }

    public function paper(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'type' => 'required|in:1,-1',
        ]);
        $user = Auth::user();
        $id= $request->input('id');
        $value= $request->input('type');
        $paper = Paper::find($id);
        $isLiked = $this->commit($user, $paper, $id, $value);
        return [
            'hasCallback'=>1,
            'callback'=>'paper_liked',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'num_like'=>$paper->num_like ,
                'num_dislike'=>$paper->num_dislike ,
                'is_liked'=>$isLiked
            ]
        ];
    }

    public function history(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'type' => 'required|in:1,-1',
        ]);
        $user = Auth::user();
        $id= $request->input('id');
        $value= $request->input('type');
        $history = History::find($id);
        $isLiked = $this->commit($user, $history, $id, $value);
        return [
            'hasCallback'=>1,
            'callback'=>'history_liked',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'num_like'=>$history->num_like ,
                'num_dislike'=>$history->num_dislike ,
                'is_liked'=>$isLiked
            ]
        ];
    }

    private function commit($user, $item, $id, $value){
        $isLiked = $item->likedany($user->id);
        if(!$isLiked){
            if($value == 1){
                $item->like($user->id);
                $isLiked=1;
            }elseif($value == -1){
                $item->dislike($user->id);
                $isLiked=-1;
            }
        }elseif($isLiked == $value){
            $item->unlike($user->id);
            $isLiked=0;
        }elseif($isLiked != $value){
            $item->revertlike($user->id);
            if($isLiked==1){
                $isLiked = -1;
            }elseif($isLiked==-1){
                $isLiked = 1;
            }
        }
        return $isLiked;
    }

}
