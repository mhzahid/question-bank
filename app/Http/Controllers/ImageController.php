<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ddeboer\Tesseract\Tesseract;
use Schema;
use Auth;
use File;
use DB;

class ImageController extends Controller
{
    protected $image;

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        public function postUpload(Request $request)
        {   

            if ($request->input('desc') == null && empty($request->file('img'))) {
                return back()->with('failed', 'This post appears to be blank. Please write something or attach photo to post.');
            }

            else{
                
                $this->validate($request, [

                    'desc' => 'string|nullable',

                    'img' => 'image|mimes:jpeg,png,jpg|max:3074',
                ]);

                if ($request->input('desc') != null && $request->has('img')) {
                    $this->validate($request, [

                        'desc' => 'string|nullable',

                        'img' => 'image|mimes:jpeg,png,jpg|max:3074',
                    ]);

                    $image = $request->file('img');

                    $this->store_and_read($image);

                    return back()->with('success', 'Question uploaded successfully.');
                }

                if ($request->has('img') && $request->input('desc') == null) {
                    $this->validate($request, [

                        'desc' => 'string|nullable',

                        'img' => 'image|mimes:jpeg,png,jpg|max:3074',
                    ]);

                    $image = $request->file('img');

                    $this->store_and_read($image);

                    return back()->with('success', 'Question uploaded successfully.');
                }

            }

            
        }


        public function store_and_read($image)
        {
            $tb = "";

            /*
                store uploaded image file 
            */
            $tmp_name = explode(".",$image->getClientOriginalName());

            $fileName = str_ireplace(" ","_",$tmp_name[0]);

            $fileExtension = $image->getClientOriginalExtension();

            $input['imagename'] = $fileName.'_'.time().'.'.$fileExtension;

            $destinationPath = public_path('/upload');

            $image->move($destinationPath, $input['imagename']);



            /*
                read the uploaded image by tesseract ocr
            */
            $tesseract = new Tesseract();

            $file = public_path('upload').'\\'.$input['imagename'];

            $text = $tesseract->recognize($file);

            // dd($text);



            /*
                filtering the text;
            */

            if (!empty($text)) {

                preg_match('/Course Code(.*)/',$text, $matches);
                $sub = substr($matches[1],0,10);
                $sub_code = str_replace(':', '', str_replace(';', '', str_replace(' ', '', $sub))); 

                preg_match('/Mid(.*)/',$text, $exam_matche1);
                preg_match('/Final(.*)/',$text, $exam_matche2);

                if (!empty($exam_matche1)) {
                    $exm = substr($exam_matche1[0],0,3);
                } elseif (!empty($exam_matche2)) {
                    $exm = substr($exam_matche2[0],0,5);
                }

                preg_match('/Semester(.*)/',$text, $sem_matche);
                $sem = substr($sem_matche[1],0,13);
                $semester = trim(str_replace(':', '', str_replace(';', '', $sem))); 

                
                $rs = DB::table('tb_subject')->select('subject_code')->where('subject_code',$sub_code)->get();

                foreach ($rs as $key => $value) {
                    $tb = $value->subject_code;
                }

                if (empty($tb)) {
                    Schema::create($sub_code, function($table)
                    {
                        $table->increments('id');
                        $table->bigInteger('im_id');
                        $table->string('uploader', 100);
                        $table->string('course_code', 10);
                        $table->string('semester', 20);
                        $table->string('exam', 10);
                        $table->longText('question');
                        $table->dateTime('created_at');
                    });

                    DB::table('tb_subject')->insertGetId([
                        'subject_code' => $sub_code, 'created_at' => now()
                    ]);


                    // $only_question = preg_split("/[\n][\n][\d][.||,][\s]+/",$text);

                    // if (key($only_question) >0) {
                        $tmp_question = preg_split("/[\n][\n][\d][.||,][\s]+/",$text);

                        $len = count($tmp_question);

                        $img_id = DB::table($sub_code)->select('im_id')->orderBy('id','desc')->limit(1)->get();
                        $imid = 0;

                        foreach ($img_id as $key => $value) {
                            $imid = $value->im_id;
                            $imid = $imid + 1;
                        }

                        for ($i=1; $i < $len; $i++) { 

                            $que = preg_replace('/[\d][.][\s]+/', '', $tmp_question[$i]);

                            DB::table($sub_code)->insertGetId([
                                'im_id' => $imid, 'uploader' => Auth::user()->name,'course_code' => $sub_code,'semester' => $semester,'exam' => $exm,'question' => $que, 'created_at' => now()
                            ]);
                        }

                    // }else{

                    //     $tmp_question = preg_split("/[\n][\n][\d][.||,][\s]+/",$only_question[0]);

                    //     $len = count($tmp_question);

                    //     $img_id = DB::table($sub_code)->select('im_id')->orderBy('id','desc')->limit(1)->get();
                    //     $imid = 0;

                    //     foreach ($img_id as $key => $value) {
                    //         $imid = $value->im_id;
                    //         $imid = $imid + 1;
                    //     }

                    //     for ($i=0; $i < $len; $i++) { 

                    //         $que = preg_replace('/[\d][.][\s]+/', '', $tmp_question[$i]);

                    //         DB::table($sub_code)->insertGetId([
                    //             'im_id' => $imid, 'uploader' => Auth::user()->name,'question' => $que, 'created_at' => now()
                    //         ]);
                    //     }
                    // }

                } else {

                    // $only_question = preg_split("/[\n][\n][\d][.||,][\s]+/",$text);

                    // dd($only_question);

                    // if (key($only_question) >0) {
                    //     dd($only_question);
                        $tmp_question = preg_split("/[\n][\n][\d][.||,][\s]+/",$text);

                        $len = count($tmp_question);

                        $img_id = DB::table($tb)->select('im_id')->orderBy('id','desc')->limit(1)->get();
                        $imid = 0;

                        foreach ($img_id as $key => $value) {
                            $imid = $value->im_id;
                            $imid = $imid + 1;
                        }

                        for ($i=1; $i < $len; $i++) { 

                            $que = preg_replace('/[\d][.][\s]+/', '', $tmp_question[$i]);

                            DB::table($tb)->insertGetId([
                                'im_id' => $imid, 'uploader' => Auth::user()->name,'course_code' => $sub_code,'semester' => $semester,'exam' => $exm,'question' => $que, 'created_at' => now()
                            ]);
                        }
                    // }else{
                    
                    //     $tmp_question = preg_split("/[\n][\n][\d][.||,][\s]+/",$only_question[0]);

                    //     $len = count($tmp_question);

                    //     $img_id = DB::table($tb)->select('im_id')->orderBy('id','desc')->limit(1)->get();
                    //     $imid = 0;

                    //     foreach ($img_id as $key => $value) {
                    //         $imid = $value->im_id;
                    //         $imid = $imid + 1;
                    //     }

                    //     for ($i=0; $i < $len; $i++) { 

                    //         $que = preg_replace('/[\d][.][\s]+/', '', $tmp_question[$i]);

                    //         DB::table($tb)->insertGetId([
                    //             'im_id' => $imid, 'uploader' => Auth::user()->name,'question' => $que, 'created_at' => now()
                    //         ]);
                    //     }
                    // }
                }
                
            }
            else{
                return back()->with('failed', 'Sorry, this image return null or empty value.');
            }

        }

}
