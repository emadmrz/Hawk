<?php

namespace App\Http\Controllers;

use App\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Morilog\Jalali\Facades\jDate;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(20);
        return view('admin.announcement.index', compact('announcements'))->with(['title' => 'Announcement Management']);
    }

    public function change(Announcement $announcement)
    {
        if ($announcement->active == 1) { //announcement is already active
            $announcement->update(['active' => 0]);
            Flash::success(trans('admin/messages.announcementBan'));
        } elseif ($announcement->active == 0) { //announcement is already banned
            $announcement->update(['active' => 1]);
            Flash::success(trans('admin/messages.announcementActivate'));
        }
        return redirect()->back();
    }

    public function create()
    {
        $user = Auth::user();
        $expiredDefault = Carbon::now()->addMonths(1)->format('Y/m/d');
        $expiredDefault = jDate::forge($expiredDefault)->format('Y/m/d');
        $announcement=new \stdClass();
        $announcement->expired_at=$expiredDefault;
        return view('admin.announcement.create', compact('user','announcement'))->with([
            'title' => 'Create Announcement',
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $announcement = $user->announcements()->create([
            'content' => $request->input('content'),
            'expired_at' => $request->input('expired_at')
        ]);
        Flash::success(trans('admin/messages.announcementCreated'));
        return redirect(route('admin.announcement.index'));
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'))->with(['title' => 'Edit Announcement']);
    }

    public function update(Announcement $announcement, Request $request)
    {
        $user = Auth::user();
        $announcement->update([
            'content' => $request->input('content'),
            'expired_at'=>$request->input('expired_at')
        ]);
        Flash::success(trans('admin/messages.announcementUpdated'));
        return redirect(route('admin.announcement.index'));
    }
}
