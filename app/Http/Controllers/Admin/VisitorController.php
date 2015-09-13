<?php

namespace App\Http\Controllers\Admin;

use App\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /*
     * Created By Dara on 13/9/2015
     * show the visitors table
     */
    public function index($method="Daily"){

        $users = Visitor::latest()->$method()->paginate(20);
        return view('admin.visitors.index', compact('users'))->with(['title' => 'visitors List']);
    }
    /*
     * created By Dara on 13/9/2015
     * show visitors last 30 days diagram
     */
    public function show()
    {
        $chartDatas = Visitor::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
         ])
         ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
         ->groupBy('date')
         ->orderBy('date', 'ASC')
         ->get()
         ->toArray();

        return view('admin.visitors.show', compact('chartDatas'))->with(['title' => 'visitors Diagram']);
    }
}
