<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\at;

class ActivitylogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity_logs=ActivityLog::with('user')->get();
      return view('layouts.Admin.ActivityLog.index',compact('activity_logs',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $activity_log = ActivityLog::with('user');
        return DataTables::of($activity_log)
            ->editColumn('created_at',function ($row){
                return   Carbon::create($row->created_at)->format('y-m-d').' At '.Carbon::create($row->created_at)->format('g:i A');
            })
            ->addColumn('action',function ($activity_log){
                $button='';
                $button.='<a tabindex="0"  class="btn btn-icon" id="'.$activity_log->id.'" onclick="popup('.$activity_log->id.')" role="button" data-toggle="popover" data-trigger="focus" data-placement="left" title="User Agent" data-content="'.$activity_log->subjects.'"><i class="fas fa-info-circle"></i></a>';
                return $button;
            })->addColumn('status',function ($activity_log){
                return $activity_log->status===1?"Disabled":"Enabled";
            })->rawColumns(['action'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
