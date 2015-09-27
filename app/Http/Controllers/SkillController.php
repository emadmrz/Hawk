<?php

namespace App\Http\Controllers;

use App\Amount;
use App\Area;
use App\Category;
use App\Degree;
use App\Experience;
use App\Gallery;
use App\History;
use App\Honor;
use App\Paper;
use App\Province;
use App\Repositories\AmountRepository;
use App\Repositories\PaperRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\SkillRepository;
use App\Schedule;
use App\Skill;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class SkillController extends Controller
{
    public function index(){
        $user = Auth::user();
        $skills = $user->skills()->with(
            'experiences',
            'experiences.files',
            'degrees',
            'degrees.files',
            'honors',
            'honors.files',
            'histories',
            'histories.files',
            'tags',
            'schedules'
        )->get();
        return view('profile.skillList', compact('skills'))->with(['title'=>'لیست مهارت ها']);
    }

    public function create(SkillRepository $skillRepository){
        $categories = Category::where('parent_id', null)->lists('name', 'id');
        $my_rate = $skillRepository->my_rate();
        $statuses = $skillRepository->statuses();
        $all_tags = [];
        $sub_categories = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        return view('profile.newSkill', compact('categories', 'my_rate', 'all_tags', 'sub_categories', 'statuses'))->with(['title'=>'ثبت مهارت جدید', 'new_skill'=>1, 'edit_skill'=>0, 'step'=>1, 'hasEdit'=>0]);
    }

    public function edit(SkillRepository $skillRepository ,Skill $skill){
        $categories = Category::where('parent_id', null)->lists('name', 'id');
        $sub_categories = Category::findOrFail($skill->sub_category_id)->getSiblingsAndSelf()->lists('name','id');
        $all_tags = Tag::where('parent_id', $skill->sub_category_id)->lists('name', 'id');
        $my_rate = $skillRepository->my_rate();
        $statuses = $skillRepository->statuses();
        return view('profile.newSkill', compact('categories', 'my_rate', 'skill', 'sub_categories', 'all_tags', 'statuses'))->with(['title'=>'ثبت مهارت جدید', 'new_skill'=>1, 'edit_skill'=>0, 'step'=>1, 'hasEdit'=>1]);
    }

    public function add(Request $request){
        $user = Auth::user();
        $tags = $request->input('tags_list');
        $input = $request->except('tags_list');
        $new_tags=[];
        foreach ($tags as $tag) {
            if (!is_numeric($tag)) {
                $created=Tag::create(['name'=>$tag,'parent_id'=>$input['sub_category_id'] ]);
                $new_tags[]=$created->id;
            } else {
                $new_tags[]=intval($tag);
            }
        }
        $skill = $user->skills()->create($input);
        $skill->tags()->attach($new_tags);
        Flash::success(trans('profile.skillCreated'));
        return redirect(route('profile.skill.edit.step2',$skill->id));
    }

    public function update(Request $request, Skill $skill){
        $tags = $request->input('tags_list');
        $input = $request->except('tags_list');
        $new_tags=[];
        foreach ($tags as $tag) {
            if (!is_numeric($tag)) {
                $created=Tag::create(['name'=>$tag,'parent_id'=>$input['sub_category_id'] ]);
                $new_tags[]=$created->id;
            } else {
                $new_tags[]=intval($tag);
            }
        }
        $skill->update($input);
        $skill->tags()->sync($new_tags);
        Flash::success(trans('profile.skillUpdated'));
        return redirect(route('profile.skill.edit.step2',$skill->id));
    }

    public function skillTables(Skill $skill, PaperRepository $paperRepository){
        $experiences = $skill->experiences()->get();
        $degrees = $skill->degrees()->get();
        $honors = $skill->honors()->get();
        $histories = $skill->histories()->get();
        $papers = $skill->papers()->get();
        $papers_type = $paperRepository->type_name();
        return view('profile.newSkill', compact('skill', 'experiences', 'degrees', 'honors', 'histories','papers', 'papers_type'))->with(['title'=>'ثبت مهارت جدید', 'new_skill'=>0, 'edit_skill'=>1, 'step'=>2, 'hasEdit'=>1]);
    }

    public function addExperience(Request $request, Skill $skill){
        if(!$request->hasFile('sample_file')) return response('No file was sent',404);
        $file = $request->file('sample_file');
        $input = $request->except('sample_file');
        $user = Auth::user();

        $imageName = $user->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/', $imageName);
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB

        $experience = $skill->experiences()->create($input);
        Experience::where('id',$experience->id)->first()->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $imageName,
            'size'=>$size,
        ]);
        $input['file']=$imageName;
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_experiences',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->experiences()->with('files')->get()
        ];
    }

    public function deleteExperience(Request $request){
        Experience::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateExperience(Request $request){
        Experience::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function previewExperience(Request $request){
        return Experience::find($request->input('id'));
    }

    public function likeExperience(Request $request){
        $user = Auth::user();
        $id= $request->input('id');
        $value= $request->input('type');
        $experience = Experience::find($id);
        $isLiked = $experience->likedany($user->id);
        if(!$isLiked){
            if($value == 1){
                $experience->like($user->id);
                $isLiked=1;
            }elseif($value == -1){
                $experience->dislike($user->id);
                $isLiked=-1;
            }
        }elseif($isLiked == $value){
            $experience->unlike($user->id);
            $isLiked=0;
        }elseif($isLiked != $value){
            $experience->revertlike($user->id);
            if($isLiked==1){
                $isLiked = -1;
            }elseif($isLiked==-1){
                $isLiked = 1;
            }
        }
        return [
            'num_like'=>$experience->num_like ,
            'num_dislike'=>$experience->num_dislike ,
            'is_liked'=>$isLiked
        ];
    }

    public function addDegree(Request $request, Skill $skill){
        if(!$request->hasFile('sample_file')) return response('No file was sent',404);
        $file = $request->file('sample_file');
        $input = $request->except('sample_file');
        $user = Auth::user();

        $imageName = $user->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/', $imageName);
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB

        $degree = $skill->degrees()->create($input);
        Degree::where('id',$degree->id)->first()->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $imageName,
            'size'=>$size,
        ]);
        $input['file']=$imageName;
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_degrees',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->degrees()->with('files')->get()
        ];
    }

    public function deleteDegree(Request $request){
        Degree::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateDegree(Request $request){
        Degree::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function previewDegree(Request $request){
        return Degree::find($request->input('id'));
    }

    public function likeDegree(Request $request){
        $user = Auth::user();
        $id= $request->input('id');
        $value= $request->input('type');
        $degree = Degree::find($id);
        $isLiked = $degree->likedany($user->id);
        if(!$isLiked){
            if($value == 1){
                $degree->like($user->id);
                $isLiked=1;
            }elseif($value == -1){
                $degree->dislike($user->id);
                $isLiked=-1;
            }
        }elseif($isLiked == $value){
            $degree->unlike($user->id);
            $isLiked=0;
        }elseif($isLiked != $value){
            $degree->revertlike($user->id);
            if($isLiked==1){
                $isLiked = -1;
            }elseif($isLiked==-1){
                $isLiked = 1;
            }
        }
        return [
            'num_like'=>$degree->num_like ,
            'num_dislike'=>$degree->num_dislike ,
            'is_liked'=>$isLiked
        ];
    }

    public function addHonor(Request $request, Skill $skill){
        if(!$request->hasFile('sample_file')) return response('No file was sent',404);
        $file = $request->file('sample_file');
        $input = $request->except('sample_file');
        $user = Auth::user();

        $imageName = $user->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/', $imageName);
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB

        $honor = $skill->honors()->create($input);
        Honor::where('id',$honor->id)->first()->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $imageName,
            'size'=>$size,
        ]);
        $input['file']=$imageName;
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_honors',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->honors()->with('files')->get()
        ];
    }

    public function deleteHonor(Request $request){
        Honor::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateHonor(Request $request){
        Honor::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function previewHonor(Request $request){
        return Honor::find($request->input('id'));
    }

    public function likeHonor(Request $request){
        $user = Auth::user();
        $id= $request->input('id');
        $value= $request->input('type');
        $honor = Honor::find($id);
        $isLiked = $honor->likedany($user->id);
        if(!$isLiked){
            if($value == 1){
                $honor->like($user->id);
                $isLiked=1;
            }elseif($value == -1){
                $honor->dislike($user->id);
                $isLiked=-1;
            }
        }elseif($isLiked == $value){
            $honor->unlike($user->id);
            $isLiked=0;
        }elseif($isLiked != $value){
            $honor->revertlike($user->id);
            if($isLiked==1){
                $isLiked = -1;
            }elseif($isLiked==-1){
                $isLiked = 1;
            }
        }
        return [
            'num_like'=>$honor->num_like ,
            'num_dislike'=>$honor->num_dislike ,
            'is_liked'=>$isLiked
        ];
    }

    public function addHistory(Request $request, Skill $skill){
        $user = Auth::user();
        $input = $request->all();
        if($request->hasFile('sample_file')) {
            $file = $request->file('sample_file');
            $imageName = $user->id.str_random(20) . '.' .$file->getClientOriginalExtension();
            $file->move(public_path() . '/img/files/', $imageName);
            $real_name = $file->getClientOriginalName();
            $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB
            $input['file']=$imageName;
        }
        $history = $skill->histories()->create($input);
        if($request->hasFile('sample_file')) {
            History::where('id', $history->id)->first()->files()->create([
                'user_id' => $user->id,
                'real_name' => $real_name,
                'name' => $imageName,
                'size' => $size,
            ]);
        }
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_histories',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->histories()->with('files')->get()
        ];
    }

    public function deleteHistory(Request $request){
        History::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateHistory(Request $request){
        History::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function addPaper(Request $request, Skill $skill){
        $input = $request->all();
        $skill->papers()->create($input);
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_papers',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->papers()->get()
        ];
    }

    public function deletePaper(Request $request){
        Paper::find($request->input('id'))->delete();
        return 'done';
    }

    public function updatePaper(Request $request){
        Paper::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function scheduleInfo(Skill $skill){
        $schedules = $skill->schedules()->get();
        $scheduleRepository = new ScheduleRepository();
        $amountRepository = new AmountRepository();
        $amount_types = $amountRepository->type();
        $amount_per_units = $amountRepository->per_units();
        $amount_units = $amountRepository->units();
        $week_days = $scheduleRepository->week_days();
        $amounts = $skill->amounts()->get();
        $areas = $skill->areas()->get();
        $galleries = $skill->galleries()->get();
        $provinces = Province::where('parent_id', null)->lists('name', 'id');
        $cities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        return view('profile.newSkill', compact('skill', 'schedules', 'week_days','amounts','amount_types','amount_per_units','amount_units', 'areas', 'provinces', 'galleries', 'cities'))->with(['title'=>'ثبت مهارت جدید', 'new_skill'=>0, 'edit_skill'=>1, 'step'=>3, 'hasEdit'=>1]);
    }

    public function addSchedule(Request $request, Skill $skill){
        $input = $request->all();
        $conflict = $skill->schedules()
            ->whereRaw(
                '((start_time <= ? AND end_time >= ?) OR (start_time >= ? AND start_time <= ?) OR (end_time >= ? AND end_time <= ?) OR (start_time >= ? AND end_time <= ?)) AND (week_day = ?) ',
                [
                    $input['start_time'],
                    $input['end_time'],
                    $input['start_time'],
                    $input['end_time'],
                    $input['start_time'],
                    $input['end_time'],
                    $input['start_time'],
                    $input['end_time'],
                    $input['week_day']
                ])->count();
        if(!$conflict){
            $skill->schedules()->create($request->all());
            return [
                'hasCallback'=>'1',
                'callback'=>'skill_schedules',
                'hasMsg'=>1,
                'msg'=>'Inserted Successfully',
                'returns'=>$skill->schedules()->get()
            ];
        }else{
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msg'=>'faile Inserted Successfully',
                'msgType'=>'danger',
                'returns'=>''
            ];
        }

    }

    public function deleteSchedule(Request $request){
        Schedule::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateSchedule(Request $request){
        Schedule::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function addAmount(Request $request, Skill $skill){
        $input = $request->all();
        $skill->amounts()->create($input);
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_amounts',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->amounts()->get()
        ];
    }

    public function deleteAmount(Request $request){
        Amount::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateAmount(Request $request){
        Amount::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function addArea(Request $request, Skill $skill){
        $input = $request->all();
        $skill->areas()->create($input);
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_areas',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->areas()->get()
        ];
    }

    public function deleteArea(Request $request){
        Area::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateArea(Request $request){
        Area::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function addGallery(Request $request, Skill $skill){
        if(!$request->hasFile('sample_file')) return response('No file was sent',404);
        $file = $request->file('sample_file');
        $input = $request->except('sample_file');
        $user = Auth::user();

        $imageName = $user->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/', $imageName);
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB

        $gallery = $skill->galleries()->create($input);
        Gallery::where('id',$gallery->id)->first()->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $imageName,
            'size'=>$size,
        ]);
        $input['file']=$imageName;
        return [
            'hasCallback'=>'1',
            'callback'=>'skill_galleries',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->galleries()->with('files')->get()
        ];
    }

    public function deleteGallery(Request $request){
        Gallery::find($request->input('id'))->delete();
        return 'done';
    }

    public function updateGallery(Request $request){
        Gallery::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function previewGallery(Request $request){
        return Gallery::find($request->input('id'));
    }
}
