<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\answer;
use Auth;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class viewController extends Controller
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
    public function index(Request $request)
    {
        $tb = "";
        $rs = array();
        $top = array();

        $r = DB::table('answer')->select(DB::raw('subject, count(*) as reply, q_id'))->groupBy('q_id')->orderByRaw('COUNT(`q_id`) DESC')->limit(5)->get();

        foreach ($r as $value) {
            $q = DB::table($value->subject)->where('id', $value->q_id)->get();
            array_push($top, $q);
        }
        

        if ($request->has('exam_tag')) {

            $r_set = DB::table('tb_subject')->select('subject_code')->get();

            foreach ($r_set as $key => $value) {
                $tb = $value->subject_code;

                $exam_type = $request->input('exam_tag');

                $result = DB::table($tb)->where('exam', $exam_type)->get();
                // $result->withPath('view?sub='.$tb.'&exam_tag='.$exam_type);

                array_push($rs, $result);
            }

            return view('user.tagPostView', ['result' => $rs, 'tag' => $exam_type, 'top' => $top]);
        }

        if ($request->has('semester_tag')) {

            $r_set = DB::table('tb_subject')->select('subject_code')->get();

            foreach ($r_set as $key => $value) {
                $tb = $value->subject_code;

                $semester = $request->input('semester_tag');

                $result = DB::table($tb)->where('semester', $semester)->get();
                // $result->withPath('view?sub='.$tb.'&semester_tag='.$semester);

                array_push($rs, $result);
            }

            return view('user.tagPostView', ['result' => $rs, 'tag' => $semester, 'top' => $top]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleView(Request $request)
    {
        $top = array();

        $tb = $request->input('sub');
        $qid = $request->input('qid');
        // $semester = $request->input('semester_tag');

        $rs = DB::table($tb)->where([
            ['id', '=', $qid],['course_code', '=', $tb],
        ])->get();


        $an = DB::table('answer')->get();
        
        $r = DB::table('answer')->select(DB::raw('subject, count(*) as reply, q_id'))->groupBy('q_id')->orderByRaw('COUNT(`q_id`) DESC')->limit(5)->get();

        foreach ($r as $value) {
            $q = DB::table($value->subject)->where('id', $value->q_id)->get();
            array_push($top, $q);
        }

        return view('user.singleView', ['result' => $rs, 'ans' => $an, 'top' => $top]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $rules = array(
                'ans_content' => array(
                    'required',
                    'regex:/^[A-Za-z0-9 _@.,?!&+";:\-\r\n]*$/'
                ),
                'qID' => 'required|numeric',
                'sub' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new answer();
            $data->ans_content = $request->ans_content;
            $data->author = Auth::user()->name;
            $data->q_id = $request->qID;
            $data->subject = $request->sub;
            $data->save();

            $stat = "success";

            return response()->json($stat);
        }
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
