<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $article->update($request->all());
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




}
