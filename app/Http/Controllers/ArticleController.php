<?php

namespace App\Http\Controllers;

use App\Article;
use App\Events\Notification;
use App\Repositories\FriendRepository;
use App\Stream;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Laracasts\Flash\Flash;
use Morilog\Jalali\jDate;

class ArticleController extends Controller
{
    public function create(){
        return view('profile.article')->with(['title'=>'مقاله جدید', 'for'=>'create']);
    }

    public function add(Request $request){
        $user = Auth::user();
        $input = $request->all();
        if($request->hasFile('image')){
            $imageName = str_random(20) . '.' .$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/img/files/'.$user->id, $imageName);
            $input['banner'] = $imageName;
        }
        $article = $user->articles()->create($input);
        Flash::success( trans('profile.articleAdded') );
        return redirect(route('profile.article.edit',['article'=>$article->id]));
    }

    public function edit(Article $article){
        $attachments = $article->files;
        $visitDiagramInfo = $this->visitorDiagramInfo($article);
        return view('profile.article', compact('article','attachments','visitDiagramInfo'))->with(['title'=>'ویرایش مقاله', 'for'=>'edit']);
    }

    public function update(Article $article, Request $request){
        $shouldPublish = 0;
        $input = $request->all();
        if($input['status']==1 and $article->is_published == 0){
            $input['is_published'] = 1;
            $shouldPublish = 1;
        }
        $article->update($input);
        if($shouldPublish){
            $this->stream($article);
        }
        Flash::success( trans('profile.articleEdited') );
        return redirect(route('profile.articles'));
    }

    public function banner(Article $article, Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'image' => 'required|image',
        ]);
        $imageName = $user->id.str_random(20) . '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/img/files/'.$user->id.'/', $imageName);
        $article->update(['banner'=>$user->id.'/'.$imageName]);
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>[
                'status'=> 1,
                'url'=> asset('img/files/'.$user->id.'/'.$imageName)
            ]
        ];
    }

    public function index(){
        $user=Auth::user();
        $articles = $user->articles()->with('user')->latest()->paginate(5);
        return view('profile.articlesList', compact('articles'))->with(['title'=>'لیست مقالات']);
    }

    public function preview(Article $article){
        $user = Auth::user();
        $attachments = $article->files;
        $article->visit();
        return view('profile.articlesPreview', compact('article', 'attachments','user'))->with(['title'=> $article->title ]);
    }

    public function delete(Article $article){
        $article->delete();
        Flash::success( trans('profile.articleDeleted') );
        return redirect(route('profile.articles'));
    }


    public function like(Article $article, Request $request){
        $user = Auth::user();
        $value= $request->input('value');
        $isLiked = $article->likedany($user->id);
        if(!$isLiked){
            if($value == 1){
                $article->like($user->id);
                $isLiked=1;
            }elseif($value == -1){
                $article->dislike($user->id);
                $isLiked=-1;
            }
        }elseif($isLiked == $value){
            $article->unlike($user->id);
            $isLiked=0;
        }elseif($isLiked != $value){
            $article->revertlike($user->id);
            if($isLiked==1){
                $isLiked = -1;
            }elseif($isLiked==-1){
                $isLiked = 1;
            }
        }
        return [
            'num_like'=>$article->num_like ,
            'is_liked'=>$isLiked
        ];
    }

    public function otherList(User $user){
        $articles = $user->articles()->with('user')->latest()->paginate(5);
        return view('home.articlesList', compact('articles', 'user'))->with(['title'=>'لیست مقالات']);
    }

    public function otherPreview(User $user ,Article $article){
        $attachments = $article->files;
        $article->visit();
        return view('home.articlesPreview', compact('article', 'attachments','user'))->with(['title'=> $article->title ]);
    }

    private function visitorDiagramInfo(Article $article){
        $chartDatas = Visit::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->where('visitable_id', $article->id)
            ->where('visitable_type','App\Article')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $chartDataByDay = [];
        $chartDataByDayShamsi = [];
        foreach($chartDatas as $data) {
            $chartDataByDay[$data->date] = $data->count;
        }
        $date = new Carbon;
        for($i = 0; $i < 30; $i++) {
            $dateString = $date->format('Y-m-d');
            if(!isset($chartDataByDay[ $dateString ])) {
                $chartDataByDay[ $dateString ] = 0;
            }
            $date->subDay();
        }
//        foreach($chartDataByDay as $date=>$value){
//            $chartDataByDayShamsi[jDate::forge($date)->format('date')] = $value;
//        }

        return $chartDataByDay;
    }

    private function stream($article){
        $user = Auth::user();
        $friendRepository = new FriendRepository();
        $friends = $friendRepository->myFriends();
        foreach($friends as $friend){
            Stream::create([
                'user_id'=>$friend->friend_info->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $article->id,
                'contentable_type'=> 'App\Article',
                'parentable_id'=>$user->id,
                'parentable_type'=>'App\User',
                'is_see'=>0
            ]);
            Event::fire(new Notification($friend->friend_info->id, 'App\Article', $article));

        }
        Stream::create([
            'user_id'=>$user->id,
            'edge_ranke'=> 0,
            'contentable_id'=> $article->id,
            'contentable_type'=> 'App\Article',
            'parentable_id'=>$user->id,
            'parentable_type'=>'App\User',
            'is_see'=>1
        ]);
    }

    /**
     * Created By Dara on 20/12/2015
     * user-article admin control
     */
    public function adminIndex(User $user){
        $articles=$user->articles()->paginate(20);
        return view('admin.article.index',compact('articles','user'))->with(['title'=>'User Article Management']);
    }

    public function adminChange(User $user,Article $article){
        if($article->active==0){ //the article is already disabled
            $article->update(['active'=>1]);
            Flash::success(trans('admin/messages.articleActivate'));
        }elseif($article->active==1){ //the article is already enabled
            $article->update(['active'=>0]);
            Flash::success(trans('admin/messages.articleBan'));
        }
        return redirect()->back();
    }

    public function adminDelete(User $user,Article $article){
        $article->delete();
        return redirect()->back();
    }




}
