<?php

namespace App\Http\Controllers;

use App\Group;
use App\Repositories\GroupRepository;
use App\Repositories\StreamRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class GroupController extends Controller
{
    private $groupRepository;
    public function __construct(GroupRepository $groupRepository){
        $this->groupRepository=$groupRepository;
    }

    public function create()
    {
        $user = Auth::user();
        return view('profile.group.create', compact('user'))->with(['title' => 'ایجاد گروه جدید']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'cropper_json' => 'required',
            'inputBanner' => 'required|image'
        ]);
        $user = Auth::user();
        $file = $request->file('inputBanner');
        $data = $request->input('cropper_json');
        $data = json_decode(stripslashes($data));

        $imageName = $user->id . str_random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/' . $user->id . '/', $imageName);
        $src = public_path() . '/img/files/' . $user->id . '/' . $imageName;
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize() / (1024 * 1024); //calculate the file size in MB

        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y));
        $img->resize(1036, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($src, 90);

        $user->usage->add(filesize(public_path() . '/img/files/' . $user->id . '/' . $imageName) / (1024 * 1024));// storage add
        $group = Group::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'banner' => $user->id . "/" . $imageName,
        ]);
        $user->groups()->attach($group->id);
        return redirect(route('profile.group.list'));

    }

    public function edit(Group $group)
    {
        $user = Auth::user();
        return view('profile.group.edit', compact('group', 'user'))->with(['title' => 'ویرایش گروه']);
    }

    public function update(Group $group, Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|min:3'
        ]);
        if ($request->file('inputBanner') != null) {
            $this->validate($request, [
                'cropper_json' => 'required',
                'inputBanner' => 'required|image'
            ]);
            $file = $request->file('inputBanner');
            $data = $request->input('cropper_json');
            $data = json_decode(stripslashes($data));

            $imageName = $user->id . str_random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/files/' . $user->id . '/', $imageName);
            $src = public_path() . '/img/files/' . $user->id . '/' . $imageName;
            $real_name = $file->getClientOriginalName();
            $size = $file->getClientSize() / (1024 * 1024); //calculate the file size in MB

            $img = Image::make($src);
            $img->rotate($data->rotate);
            $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y));
            $img->resize(1036, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($src, 90);

            $user->usage->add(filesize(public_path() . '/img/files/' . $user->id . '/' . $imageName) / (1024 * 1024));// storage add
            $group->update([
                'name' => $request->input('name'),
                'banner' => $user->id . "/" . $imageName
            ]);
            return redirect()->back();

        } else {
            $group->update(['name' => $request->input('name')]);
            return redirect()->back();
        }

    }

    /**
     * Created By Dara on 31/10/2015
     * show all the groups related to the user
     */
    public function allGroups()
    {
        $user = Auth::user();
        $groups = $user->groups()->get();
        return view('profile.group.allGroups', compact('user', 'groups'))->with(['title' => 'گروه های کاربر']);
    }

    public function delete(Group $group)
    {
        $user = Auth::user();
        if ($user->cannot('delete-group', [$group])) {
            abort(403);
        }
        $group->delete();
        return redirect(route('profile.group.list'));
    }

    public function index(Group $group,StreamRepository $streamRepository)
    {
        $user = Auth::user();
        $feeds=$streamRepository->group($group);
        return view('group.index', compact('user', 'group','feeds'))->with(['title' => $group->name]);
    }

    public function join(Group $group,Request $request){
        $user=Auth::user();
        if ($request->user()->can('join-group', $group)) {
            //the user is not a member so we add him/her to the group
            $group->users()->attach([$user->id]);
        }
        return redirect()->back();

//        return[
//            'hasCallback'=>1,
//            'callback'=>'group_join',
//            'hasMsg'=>0,
//            'msg'=>'',
//            'msgType'=>'',
//            'returns'=> [
//                'status'=>'done'
//            ]
//
//        ];
    }

    public function leave(Group $group,Request $request){
        $user=Auth::user();
        if ($request->user()->cannot('join-group', [$group])) {
            //the user is not a member so we add him/her to the group
            $group->users()->detach([$user->id]);
        }
        return redirect()->back();
//        return[
//            'hasCallback'=>1,
//            'callback'=>'group_join',
//            'hasMsg'=>0,
//            'msg'=>'',
//            'msgType'=>'',
//            'returns'=> [
//                'status'=>'undo'
//            ]
//
//        ];
    }

    /**
     * Created By Dara on 8/11/2015
     * add image to the group
     */
    public function createImage(Group $group){
        return view('profile.group.createImage',compact('group'))->with(['title'=>'انتخاب تصویر برای گروه']);
    }

    public function storeImage(Group $group,Request $request)
    {
        $this->validate($request, [
            'cropper_json' => 'required',
            'inputBanner' => 'required|image'
        ]);
        $user = Auth::user();
        $file = $request->file('inputBanner');
        $data = $request->input('cropper_json');
        $data = json_decode(stripslashes($data));

        $imageName = 'g'.$user->id . str_random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path() . '/img/persons/', $imageName);
        $src = public_path() . '/img/persons/' . $imageName;

        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y));
        $img->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($src, 90);

        $user->usage->add(filesize(public_path() . '/img/persons/' . $imageName) / (1024 * 1024));// storage add
        $group->update([
           'image'=>$imageName
        ]);
        return redirect()->back();

    }


}
