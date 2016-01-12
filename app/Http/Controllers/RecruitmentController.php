<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\recruitmentConfirmed;
use App\Recruitment;
use App\RecruitmentQuestionnaire;
use App\RecruitmentRequester;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;

class RecruitmentController extends Controller
{
    public function edit(Recruitment $recruitment)
    {
        $user = Auth::user();
        $main_categories = [];
        $all_main_categories = Category::where('parent_id', null)->lists('name', 'id');
        $main_categories[0] = 'انتخاب کنید';
        foreach ($all_main_categories as $key => $value) {
            $main_categories[$key] = $value;
        }
        if ($recruitment->category_id) {
            $sub_categories = Category::findOrFail($recruitment->category_id)->getSiblingsAndSelf()->lists('name', 'id');
            $all_tags = Tag::where('parent_id', $recruitment->category_id)->lists('name', 'id');
            $recruitment->tags_list = $recruitment->tags()->lists('id')->toArray();
        } else {
            $sub_categories = [];
            $all_tags = [];
        }

        return view('store.recruitment.edit', compact('user', 'recruitment'))->with([
            'title' => 'ویرایش آگهی استخدام',
            'main_categories' => $main_categories,
            'sub_categories' => $sub_categories,
            'all_tags' => $all_tags
        ]);
    }

    public function create(Recruitment $recruitment, Request $request)
    {
        //check if the recruitment is valid regarding expiration date and status
        if ($recruitment->valid() && $recruitment->status == 1) {
            $this->validate($request, [
                'tags_list' => 'required',
                'group_title' => 'required'
            ]);
            $user = Auth::user();
            $input = $request->all();
            //checking authentication

            //importing logo image
            if (isset($input['image'])) { //if the image was set
                $data = $request->input('cropper_json');
                $data = json_decode(stripslashes($data));
                $image = $input['image'];
                $imageName = $user->id . str_random(20) . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/img/files/' . $user->id, $imageName);
                $src = public_path() . '/img/files/' . $user->id . '/' . $imageName;
                $img = Image::make($src);
                $img->rotate($data->rotate);
                $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y));
                $img->resize(851, 360);
                $img->save($src, 90);
                $savedImageName = $user->id . '/' . $imageName;
            } else {
                if ($recruitment->image) {
                    $savedImageName = $recruitment->image;
                } else {
                    $savedImageName = null;
                }

            }

            //add the form information into recruitments table
            $recruitment->update([
                'category_id' => $input['category_id'],
                'group_title' => $input['group_title'],
                'job_title' => $input['job_title'],
                'job_description' => $input['job_description'],
                'job_responsibility' => $input['job_responsibility'],
                'job_condition' => $input['job_condition'],
                'job_office' => $input['job_office'],
                'job_style' => $input['job_style'],
                'image' => $savedImageName
            ]);

            //sync the tags into pivot table
            $recruitment->tags()->sync($input['tags_list']);

            Flash::success(trans('messages.recruitmentCreated'));
            return redirect()->back();
        } else {
            //the recruitment in invalid
            return redirect()->back();
        }

    }

    public function editQuestion(Recruitment $recruitment)
    {
        $user = Auth::user();
        $defaultQuestions = RecruitmentQuestionnaire::where('user_id', null)->orWhere('user_id', $user->id)->get();

        //form model binding
        $model = [];
        foreach ($defaultQuestions as $key => $question) {
            $model[$key] = new RecruitmentQuestionnaire();
            $model[$key]->id = $question->id;
            $model[$key]->user_id = $question->user_id;
            $model[$key]->content = $question->content;
            $model[$key]->created_at = $question->created_at;
            $model[$key]->updated_at = $question->updated_at;
            if ($question->recruitments()->where('id', $recruitment->id)->exists()) {
                $model[$key]->selected = true;
            } else {
                $model[$key]->selected = false;
            }
        }

        return view('store.recruitment.editQuestion', compact('recruitment', 'user'))->with([
            'title' => 'تکمیل فرم استخدام',
            'defaultQuestions' => $model
        ]);
    }

    public function submitQuestion(Recruitment $recruitment, Request $request)
    {
        $user = Auth::user();

        //check if the recruitment is valid
        if ($recruitment->valid() && $recruitment->status == 1) {
            $recruitment->questions()->sync($request->input('question'));
            return redirect()->back();
        } else {
            //the recruitment is invalid
            return redirect()->back();
        }


    }

    public function addQuestion(Recruitment $recruitment, Request $request)
    {
        $user = Auth::user();

        //check if the recruitment is valid
        if ($recruitment->valid() && $recruitment->status == 1) {
            //check if the current question was asked by him/her before
            $count = RecruitmentQuestionnaire::where('user_id', $user->id)->where('content', $request->input('question'))->count();
            if ($count > 0) { //already asked

            } else {
                RecruitmentQuestionnaire::create([
                    'user_id' => $user->id,
                    'content' => $request->input('question')
                ]);
            }

            return redirect()->back();
        } else {
            //the recruitment is invalid
            return redirect()->back();
        }


    }

    /**
     * Created By Dara on 4/1/2016
     * recruitment public preview
     */
    public function publicPreview(User $user, Recruitment $recruitment)
    {
        $questions = $recruitment->questions()->get();
        return view('home.recruitmentPreview', compact('user', 'recruitment', 'questions'))->with(['title' => 'آگهی استخدام']);
    }

    /**
     * Created By Dara on 5/1/2016
     * recruitment profile preview
     */
    public function profilePreview(Recruitment $recruitment){
        $user=Auth::user();
        $questions = $recruitment->questions()->get();
        return view('profile.recruitmentPreview',compact('user','recruitment','questions'))->with(['title'=>'آگهی استخدام']);
    }

    /**
     * Created By Dara on 5/1/2016
     * recruitment requester preview
     */
    public function requesterPreview(Recruitment $recruitment,RecruitmentRequester $recruitmentRequester){
        $user=Auth::user();
        return view('profile.recruitmentRequesterPreview',compact('user','recruitment','recruitmentRequester'))->with(['title'=>'متقاضی شغل']);
    }

    /**
     * Created By Dara on 5/1/2016
     * recruitment requester preview for others in /profile/recruitment/...
     */
    public function publicRequesterPreview(Recruitment $recruitment,RecruitmentRequester $recruitmentRequester){
        $user=Auth::user();
        return view('profile.recruitment.recruitmentPreview',compact('user','recruitment','recruitmentRequester'))->with(['title'=>'متقاضی شغل']);
    }

    /**
     * Created By Dara on 5/1/2016
     * my related recruitment control
     */
    public function recruitmentIndex(){
        $user=Auth::user();
        $relatedRecruitments=$this->getRelatedRecruitments($user);
        $main_categories = [];
        $all_main_categories = Category::where('parent_id', null)->lists('name', 'id');
        $main_categories[0] = 'انتخاب کنید';
        foreach ($all_main_categories as $key => $value) {
            $main_categories[$key] = $value;
        }
        return view('profile.recruitment.index',compact('user','relatedRecruitments'))->with([
            'title'=>'آگهی های استخدام',
            'main_categories'=>$main_categories
        ]);

    }

    /**
     * Created By Dara on 6/1/2016
     * recruitment search
     */
    public function recruitmentSearch(Request $request){
        $user=Auth::user();
        $this->validate($request,[
            'first_category'=>'required|integer',
            'second_category'=>'required|integer'
        ]);
        $sub_category_id=intval($request->input('second_category'));
        $relatedRecruitments=Recruitment::where('category_id',$sub_category_id)->where('active',1)->get();
        $main_categories = [];
        $all_main_categories = Category::where('parent_id', null)->lists('name', 'id');
        $main_categories[0] = 'انتخاب کنید';
        foreach ($all_main_categories as $key => $value) {
            $main_categories[$key] = $value;
        }
        return view('profile.recruitment.index',compact('user','relatedRecruitments'))->with([
            'title'=>'آگهی های استخدام',
            'main_categories'=>$main_categories
        ]);
        dd($relatedRecruitments);
    }

    /**
     * Created By Dara on 4/1/2016
     * apply for job
     */
    public function submitRecruitment(User $user, Recruitment $recruitment, Request $request)
    {
        $requester = Auth::user();
        $questions = $recruitment->questions()->lists('id')->toArray();

        //check if the recruitment is valid or not
        if ($recruitment->status != 2 || $recruitment->active != 1 || $recruitment->expired_at <= Carbon::now()) {
            Flash::error(trans('messages.recruitmentInvalid'));
            return redirect()->back();
        } else {
            $this->validate($request, [
                'phone_number' => 'required',
                'question' => 'required'
            ]);
            foreach ($questions as $question) {
                if ($request->input('question')[$question] == "") { //the answer is empty
                    Flash::error(trans('messages.recruitmentAnswerEmpty'));
                    return redirect()->back();
                }
            }

            //check if the user has submitted this before or not
            if($requester->recruitmentRequesters()->where('recruitment_id',$recruitment->id)->exists()){
                Flash::error(trans('messages.recruitmentRequestAlreadyExists'));
                return redirect()->back();
            }else{
                //everything looks good
                $requester->recruitmentRequesters()->create([
                    'recruitment_id' => $recruitment->id,
                    'phone_number' => $request->input('phone_number')
                ]);
                //add to answer table
                $answers=$request->input('question');
                foreach($answers as $key=>$answer){
                    $requester->recruitmentAnswers()->create([
                        'question_id'=>$key,
                        'content'=>$answer,
                        'recruitment_id'=>$recruitment->id
                    ]);
                }
                Flash::success(trans('messages.recruitmentSent'));
                return redirect(route('profile.recruitment'));
            }
        }

    }

    /**
     * Created By Dara on 5/1/2016
     * get all the recruitments related to the specific user
     */
    private function getRelatedRecruitments($user)
    {
        $recruitments = DB::table('users')->join('skills', function ($join) use($user) {
            $join->on('skills.user_id', '=', 'users.id')
                ->where('users.id', '=', $user->id);
        })->join('categories', 'categories.id', '=', 'skills.sub_category_id')
            ->join('tags', 'categories.id', '=', 'tags.parent_id')
            ->join('skill_tag', function ($join) {
                $join->on('skill_tag.tag_id', '=', 'tags.id')
                    ->on('skill_tag.skill_id', '=', 'skills.id');
            })
            ->join('recruitment_tag', 'tags.id', '=', 'recruitment_tag.tag_id')
            ->join('recruitments', 'recruitment_tag.recruitment_id', '=', 'recruitments.id')
            ->where('recruitments.user_id', '!=', Auth::user()->id)
            ->where('recruitments.active','=',1)
            ->groupBy('recruitments.id')
            ->select('recruitments.*')
            ->get();
        $relatedRecruitments=[];
        foreach($recruitments as $key=>$recruitment){
            $relatedRecruitments[$key]=new Recruitment();
            $relatedRecruitments[$key]->id=$recruitment->id;
            $relatedRecruitments[$key]->user_id=$recruitment->user_id;
            $relatedRecruitments[$key]->category_id=$recruitment->category_id;
            $relatedRecruitments[$key]->group_title=$recruitment->group_title;
            $relatedRecruitments[$key]->job_title=$recruitment->job_title;
            $relatedRecruitments[$key]->job_description=$recruitment->job_description;
            $relatedRecruitments[$key]->job_responsibility=$recruitment->job_responsibility;
            $relatedRecruitments[$key]->job_certification=$recruitment->job_certification;
            $relatedRecruitments[$key]->job_condition=$recruitment->job_condition;
            $relatedRecruitments[$key]->job_office=$recruitment->job_office;
            $relatedRecruitments[$key]->job_style=$recruitment->job_style;
            $relatedRecruitments[$key]->image=$recruitment->image;
            $relatedRecruitments[$key]->status=$recruitment->status;
            $relatedRecruitments[$key]->active=$recruitment->active;
            $relatedRecruitments[$key]->created_at=$recruitment->created_at;
            $relatedRecruitments[$key]->updated_at=$recruitment->updated_at;
        }
        return $relatedRecruitments;
    }

    public function finalSubmit(Recruitment $recruitment)
    {
        $recruitment->update(['status' => 2]); //used and can not be edited and ready to be verified by the admin
        return redirect(route('profile.management.addon.recruitment'));
    }

    public function adminIndex(User $user)
    {
        $recruitments = $user->recruitments()->paginate(20);
        return view('admin.recruitment.index', compact('user', 'recruitments'))->with(['title' => 'Recruitment Addon Management']);
    }

    public function adminChange(User $user, Recruitment $recruitment)
    {
        if ($recruitment->active == 0) { //the recruitment is already disabled
            $recruitment->update(['active' => 1]);

            //fire an event to spread the recruitment
            Event::fire(new recruitmentConfirmed($recruitment));

            Flash::success(trans('admin/messages.recruitmentActivate'));
        } elseif ($recruitment->active == 1) { //the recruitment is already enabled
            $recruitment->update(['active' => 0]);
            Flash::success(trans('admin/messages.recruitmentBan'));
        }
        return redirect()->back();
    }
}
