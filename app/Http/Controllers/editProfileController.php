<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidatePhone;
use App\Rules\ValidateGender;
use App\updateUserInfo;
use App\updateInfo;
use DB;
use Auth;

class editProfileController extends Controller
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
    public function index($id)
    {
        $name = Auth::user()->name;
        $user_info = DB::table('users')->where('id',$id)->where('name', $name)->get(); 

        $profile_pic = DB::table('profile_img')->where('user_id',$id)->where('user_name',$name)->orderBy('img_id','desc')->limit(1)->get();

        //dd($profile_pic);
        return view('user.editProfile.edit',['user_info' => $user_info, 'profile_pic' => $profile_pic]);
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
       // dd($request);

        $request->validate([

            'profileImage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('profileImage');
        $fileName = $image->getClientOriginalName();
        $fileExtension = $image->getClientOriginalExtension();

        $input['imagename'] = $fileName.time().'.'.$fileExtension;

        $destinationPath = public_path('/profile_img');

        $image->move($destinationPath, $input['imagename']);

        $pro_img = new updateInfo;
        $pro_img->user_id = Auth::user()->id;

        // dd($pro_img->user_id);

        $pro_img->user_name = Auth::user()->name;               
        $pro_img->img_location = 'profile_img/'.$input['imagename'];

        $pro_img->save();

        return back()->with('updated','Profile picture is change successfully.');
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

        $name = Auth::user()->name;

        if ($request->has('email')) {
            $request->validate([

                'email' => 'required|string|email|max:255|unique:users',

                'public_stat' => array(
                                    'regex:/^(0|1)$/'
                                ),
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['email' => $request->input('email') , 'email_public' => $request->input('public_stat')]);

            return back()->with('updated','E-mail update successfully.');
        }

        //dd($request->input('u-mob'));

        if ($request->has('u-mob')) {
            $request->validate([
                'u-mob' => ['required',new ValidatePhone],
                'public_stat' => array(
                                    'regex:/^(0|1)$/'
                                ),
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['mobile' => $request->input('u-mob') , 'mobile_public' => $request->input('public_stat')]);

            return back()->with('updated','Mobile number update successfully.');
        }

        if ($request->has('u-gen')) {
            $request->validate([
                'u-gen' => ['required',new ValidateGender],
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['gender' => $request->input('u-gen')]);

            return back()->with('updated','Gender update successfully.');
        }

        if ($request->has('e_address')) {
            $request->validate([
                'e_address' => 'required',
                'public_stat' => array(
                                    'regex:/^(0|1)$/'
                                ),
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['address' => $request->input('e_address') , 'address_public' => $request->input('public_stat')]);

            return back()->with('updated','Address update successfully.');
        }


        if ($request->has('u-dpt')) {
            $request->validate([
                'u-dpt' => array(
                        'required',
                        'regex:/^(SWE|CSE|EEE|MCT|ETE|TE|CVE|BBA|RE)$/'
                ),
            ]);
            
            updateUserInfo::where('id',$id)->where('name',$name)->update(['department' => $request->input('u-dpt')]);

            return back()->with('updated','Department update successfully.');
        }

        if ($request->has('ubatch')) {
            $request->validate([
                'ubatch' => array(
                        'required',
                        'regex:/^([1-9]{1}|[1-9]{1}[0-9]{1})$/'
                ),

                'public_stat' => array(
                                    'regex:/^(0|1)$/'
                                ),
            ]);
            
            updateUserInfo::where('id',$id)->where('name',$name)->update(['batch' => $request->input('ubatch') , 'batch_public' => $request->input('public_stat')]);

            return back()->with('updated','Batch update successfully.');
        }


        if ($request->has('uattending-from')&& $request->has('uattending-to')) {
            $request->validate([
                'uattending-from' => array(
                        'required',
                        'regex:/^((200)[2-9]{1}|(201)[0-8]{1})$/'
                ),

                'uattending-to' => array(
                        'required',
                        'regex:/^((200)[5-9]{1}|(201)[0-9]{1}|(202)[0-2]{1})$/'
                ),

                'public_stat' => array(
                                    'regex:/^(0|1)$/'
                                ),
            ]);
            $attending = ($request->input('uattending-from')."-".$request->input('uattending-to'));
             //dd($attending);
            updateUserInfo::where('id',$id)->where('name',$name)->update(['attending' => $attending , 'attending_public' => $request->input('public_stat')]);

            return back()->with('updated','Attending year has been updated successfully.');
        }


        if ($request->has('uhobby')) {
            $request->validate([
                'uhobby' => 'required|string',

                'public_stat' => array(
                                    'regex:/^(0|1)$/'
                                ),
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['hobby' => $request->input('uhobby') , 'hobby_public' => $request->input('public_stat')]);

            return back()->with('updated','Hobby update successfully.');
        }

        if ($request->has('uskills')) {
            $request->validate([
                'uskills' => 'required|string',
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['skills' => $request->input('uskills')]);

            return back()->with('updated','Skills update successfully.');
        }

        if ($request->has('uquote')) {
            $request->validate([
                'uquote' => 'required',
            ]);

            updateUserInfo::where('id',$id)->where('name',$name)->update(['quote' => $request->input('uquote')]);

            return back()->with('updated','Your Quote is update successfully.');
        }

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
