<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class profileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tb = "";
        $rs = array();
        $top = array();


        $r = DB::table('answer')->select(DB::raw('subject, count(*) as reply, q_id'))->groupBy('q_id')->orderByRaw('COUNT(`q_id`) DESC')->limit(5)->get();

        foreach ($r as $value) {
            $q = DB::table($value->subject)->where('id', $value->q_id)->get();
            array_push($top, $q);
        }


        $r_set = DB::table('tb_subject')->select('subject_code')->get();

        foreach ($r_set as $key => $value) {
            $tb = $value->subject_code;

            $result =  DB::table($tb)
            ->select('uploader', 'course_code', 'semester', 'exam', 'created_at')
            ->distinct()
            ->get();

            array_push($rs, $result);
        }

        return view('user.userProfile', ['result' => $rs, 'top' => $top]);
        
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
    public function show($id)
    {
        //
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
