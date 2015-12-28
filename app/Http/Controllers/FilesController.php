<?php

namespace App\Http\Controllers;

use App\Article;
use App\Biography;
use App\File;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    /**
     * Created by Emad Mirzaie on 12/09/2015.
     * Upload Image For Biography text
     */
    public function upload(Request $request){
        $user = Auth::user();
        $biography = Biography::where('user_id',$user->id)->first();
        $real_name = $request->file('file')->getClientOriginalName();
        $size = $request->file('file')->getClientSize()/(1024*1024); //calculate the file size in MB
        $imageName = str_random(20) . '.' .$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path() . '/img/files/'.$user->id.'/', $imageName);
        $biography->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $user->id.'/'.$imageName,
            'size'=>$size,
        ]);
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add

        return asset('img/files/'.$user->id.'/'.$imageName);
    }

    /**
     * Created by Emad Mirzaie on 12/09/2015.
     * Biography Attachments
     */
    public function attachment(Request $request){
        $user = Auth::user();
        $biography = Biography::where('user_id',$user->id)->first();
        $real_name = $request->file('aaa')->getClientOriginalName();
        $size = $request->file('aaa')->getClientSize()/(1024*1024); //calculate the file size in MB
        $imageName = str_random(20) . '.' .$request->file('aaa')->getClientOriginalExtension();
        $request->file('aaa')->move(public_path() . '/img/files/'.$user->id.'/', $imageName);
        $biography->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $user->id.'/'.$imageName,
            'size'=>$size,
        ]);
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add

        return $biography->files;
    }

    public function deleteAttachment(Request $request){
        $user = Auth::user();
        $file = File::find($request->input('attachment'));
        if($user->id == $file->user_id){
            $file->delete();
        }
    }

    public function articleAttachment(Request $request){
        $user = Auth::user();
        $article = Article::where('id',$request->input('article'))->first();
        $real_name = $request->file('aaa')->getClientOriginalName();
        $size = $request->file('aaa')->getClientSize()/(1024*1024); //calculate the file size in MB
        $imageName = str_random(20) . '.' .$request->file('aaa')->getClientOriginalExtension();
        $request->file('aaa')->move(public_path() . '/img/files/'.$user->id.'/', $imageName);
        $article->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $user->id.'/'.$imageName,
            'size'=>$size,
        ]);
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add

        return $article->files;
    }

    public function deleteArticleAttachment(Request $request){
        $user = Auth::user();
        $file = File::find($request->input('attachment'));
        if($user->id == $file->user_id){
            $file->delete();
        }
    }

    public function articleUpload(Request $request){
        $user = Auth::user();
        $article = Article::where('id',$request->input('article'))->first();
        $real_name = $request->file('file')->getClientOriginalName();
        $size = $request->file('file')->getClientSize()/(1024*1024); //calculate the file size in MB
        $imageName = str_random(20) . '.' .$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path() . '/img/files/', $imageName);
        $article->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $imageName,
            'size'=>$size,
        ]);
        return asset('img/files/'.$imageName);
    }

    /**
     * Created By Dara on 28/12/2015
     * user-files management
     */
    public function adminIndex(User $user){
        $files=$user->files()->latest()->paginate(20);
        return view('admin.file.index',compact('user','files'))->with(['title'=>'User File Management']);
    }
}
