<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class mainController extends Controller
{
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

        return view('main', ['result' => $rs, 'top' => $top]);
    }
}
