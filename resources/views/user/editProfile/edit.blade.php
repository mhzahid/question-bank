<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Profile: {{Auth::user()->name}}</title>
	<link rel="stylesheet" href="../../css/app.css">
	<link rel="stylesheet" href="../../css/w3.css">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="container-fluid">
		
			<div class="col-md-12 col-xs-12" id="top" style="background: #424242;min-height: 45px;color: #999999;">
				<div class="row">
					<div class="col-md-4 col-md-offset-1 col-xs-12 social">
						<span><a href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a></span>
						<span><a href="#"><i class="fa fa-linkedin fa-lg" aria-hidden="true"></i></a></span>
					</div>
					<div class="col-md-6 col-xs-12" style="height: 44px;">
						<div style="display: flex; float: right;">
							<p style="padding: 12px 0;display: flex;"><span><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp</span>info@company.com</p>
						<p style="padding: 5px;padding-top: 12px;">|</p>
							<p style="padding: 12px 0; display: flex;"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp</span>01234567890</p>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-xs-12">
					<nav class="navbar navbar-default" data-spy="affix" data-offset-top="40">
					  <div class="container cnt">

					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="../../img/site-icon.png" alt="Question Bank"></a>
					    </div>

						<div class="collapse navbar-collapse" id="bs-navbar-collapse">
					    <ul class="nav navbar-nav" style="text-transform: capitalize;">
					      <li><a href="{{URL::to('home')}}">home</a></li>
					      <li><a class="btn btn-md" data-toggle="collapse" href="#coll" aria-expanded="false" aria-controls="coll">Upload Queston</a></li>
					      <!-- <li><a href="#">How it work</a></li> -->
					      <li><a href="#">contact us</a></li>
					      
					    </ul>

					    <ul class="nav navbar-nav navbar-right">
					    	<li class="dropdown">
					    		<div id="lgot">
					    	    <a href="profile">
					    	        <img src="{{asset('img/default-pic.jpg')}}" alt="User avater">
					    	        {{ Auth::user()->name }}
					    	    </a>
					    	    <span class="dropdown-toggle caret" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"></span>

					    	    <ul class="dropdown-menu">
					    	    	<li>
					    	    		<a href="{{URL::to('/profile/edit',Auth::user()->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit profile</a>
					    	    	</li>
					    	        <li>
					    	            <a href="{{ route('logout') }}"
					    	                onclick="event.preventDefault();
					    	                         document.getElementById('logout-form').submit();">
					    	                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
					    	            </a>

					    	            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					    	                {{ csrf_field() }}
					    	            </form>
					    	        </li>
					    	    </ul>
					    		</div>
					    	</li>
					    </ul>

						</div>
					  </div>
					</nav>
				</div>
			</div>

			@if ($errors->any())
			    <div id="snackbar-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			@if(session('success'))
			    <div id="snackbar-success">
			        {{session('success')}}
			    </div>
			@endif
			@if(session('failed'))
			    <div id="snackbar-danger">
			        {{session('failed')}}
			    </div>
			@endif



			@if(session('updated'))
			<div id="snackbar-success">
				{{session('updated')}}
			</div>
			@endif


				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3 col-sm-12 col-md-offset-1" style="background-color: #edecec;">
							<div class="pro_pic" style="margin-top: 5px;">
								
								@if(count($profile_pic)>0)
									@foreach($profile_pic as $propic)

										@if(count($propic->img_location)>0)
											{{Html::image($propic->img_location),['class' =>'test']}}
										@else
											<img src="{{asset('img/default-pic.jpg')}}" alt="User avater1">
										@endif

									@endforeach
									
								@else
									<img src="{{asset('img/default-pic.jpg')}}" alt="User avater2">
								@endif

								{!!Form::open(['action'=>['editProfileController@store', Auth::user()->id],'class' => 'frm' ,'method' => 'POST', 'enctype' => 'multipart/form-data'] )!!} 
									{{Form::file('profileImage',['class' =>'form-control'])}}
									<button class="btn btn-md btn-info" style="float: left;">Upload</button>
								{!! Form::close() !!}
								
							</div>
							
						</div>

						<div class="col-md-7 col-sm-12" style="background-color: #edecec; border-left: 2px solid #cccccc82;">
							<div style="background-color: #edecec; padding-top: 15px;">
								
								<div class="col-md-12 text-center" style="padding-bottom: 15px;">
									<h1 class="head-tag">Edit Profile</h1>
									<hr style="height: 2px;background: #128b86;">
									<a href="{{URL::to('/profile')}}"><button class="btn btn-md btn-info">Back</button></a>
									<!-- <a href="view/{!! Auth::user()->name !!}"><button class="btn btn-md btn-light">View Profile as public</button></a> -->
								</div>
								
								
								@foreach($user_info as $info)
									<div class="col-md-12">
										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>E-mail : </b> <span>{!! $info-> email !!}</span></p>

												<p onclick="edit_info('email')" class="w3-left-align rep edtg">Edit</p>
											</div>
											
											<div id="email" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<input type="text" class="form-control" name="email" value="{!! $info-> email !!}">
														</div>
														<div class="col-md-4">
															 <div class="radio form-control" style="color: #000;font-size: 15px;">
															 	<span style="margin-left: 12%;">
															     <input type="radio" id="public_stat" name="public_stat" value="1" {{ $info->email_public == '1' ? 'checked' : '' }}>Public</span>
															     
															     <span style="margin-left: 36%;">
															     <input type="radio" id="public_stat" name="public_stat" value="0" {{ $info->email_public == '0' ? 'checked' : '' }}>Private</span>
															 </div>
															 <button class="btn btn-md btn-primary">Save</button>
														</div>
													</div>
												{!! Form::close() !!}
											</div>
										</div>

										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Mobile No : </b> <span>{!! $info-> mobile !!}</span></p>

												<p onclick="edit_info('mob')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="mob" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!} 
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<input type="text" class="form-control" name="u-mob" value="{!! $info-> mobile !!}">
															
														</div>
														<div class="col-md-4">
															 <div class="radio form-control" style="color: #000;font-size: 15px;">
															 	<span style="margin-left: 12%;">
															     <input type="radio" id="public_stat" name="public_stat" value="1" {{ $info->mobile_public == '1' ? 'checked' : '' }}>Public</span>

															         <span style="margin-left: 36%;">
															     <input type="radio" id="public_stat" name="public_stat" value="0" {{ $info->mobile_public == '0' ? 'checked' : '' }}>Private</span>
															 </div>
															 <button class="btn btn-md btn-primary">Save</button>
														</div>
														
													</div>
												{!! Form::close() !!}
											</div>
										</div>

										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Gender : </b> <span>{!! $info-> gender !!}</span></p>

												<p onclick="edit_info('gen')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="gen" class="w3-hide">
												{!!Form::open( ['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'] )!!}
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<input type="text" class="form-control" name="u-gen" value="{!! $info-> gender !!}">
															<button class="btn btn-md btn-primary">Save</button>
														</div>
														
													</div>
												{!! Form::close() !!}
											</div>
										</div>

										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Address : </b> <span>{!! $info-> address !!}</span></p>

												<p onclick="edit_info('adr')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="adr" class="w3-hide">
												{!!Form::open( ['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'] )!!}
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<textarea class="form-control" name="e_address" id="e_address" rows="2">{!! $info-> address !!}</textarea>
															<button class="btn btn-md btn-primary">Save</button>
														</div>
														<div class="col-md-4">
															 <div class="radio form-control" style="color: #000;font-size: 15px;">
															 	<span style="margin-left: 12%;">
															     <input type="radio" id="public_stat" name="public_stat" value="1" {{ $info->address_public == '1' ? 'checked' : '' }}>Public</span>

															         <span style="margin-left: 36%;">
															     <input type="radio" id="public_stat" name="public_stat" value="0" {{ $info->address_public == '0' ? 'checked' : '' }}>Private</span>
															 </div>
														</div>
														
													</div>
												{!! Form::close() !!}
											</div>
										</div>


										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Department : </b> <span>{!! $info-> department !!}</span></p>

												<p onclick="edit_info('dpt')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="dpt" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}
												
													<div class="clo-md-12 udfrm">
														<div class="col-md-8">
															<select class="form-control" name="u-dpt" id="">
																<option value="">-- Department --</option>
																<option {{old('department',$info->department)=="SWE"? 'selected':''}} value="SWE">Software Engineering</option>
																<option value="CSE" {{old('department',$info->department)=="CSE"? 'selected':''}}>Computer Science & Engineering</option>
																<option value="EEE" {{old('department',$info->department)=="EEE"? 'selected':''}}>Electrical & Electronic Engineering</option>
																<option value="MCT" {{old('department',$info->department)=="MCT"? 'selected':''}}>Multimedia & Creative Technology</option>
																<option value="ETE" {{old('department',$info->department)=="ETE"? 'selected':''}}>Electronic & Telecommunication Engineering</option>
																<option value="TE" {{old('department',$info->department)=="TE"? 'selected':''}}>Textile Engineering</option>
																<option value="CVE" {{old('department',$info->department)=="CVE"? 'selected':''}}>Civil Engineering</option>
																<option value="BBA" {{old('department',$info->department)=="BBA"? 'selected':''}}>Business Administration</option>
																<option value="RE" {{old('department',$info->department)=="RE"? 'selected':''}}>Real Estate</option>

															</select>
														</div>
														<div class="col-md-4">
															<button class="btn btn-md btn-primary">Save</button>
														</div>
														
													</div>
												{!! Form::close() !!}
											</div>
										</div>	

										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Batch : </b> <span>{!! $info-> batch !!}</span></p>

												<p onclick="edit_info('btch')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="btch" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<input type="text" class="form-control" name="ubatch" value="{!! $info-> batch !!}">
														</div>
														<div class="col-md-4">
															 <div class="radio form-control" style="color: #000;font-size: 15px;">
															 	<span style="margin-left: 10%;">
															     <input type="radio" id="public_stat" name="public_stat" value="1" {{ $info->batch_public == '1' ? 'checked' : '' }}>Public</span>

															         <span style="margin-left: 36%;">
															     <input type="radio" id="public_stat" name="public_stat" value="0" {{ $info->batch_public == '0' ? 'checked' : '' }}>Private</span>
															 </div>
															 <button class="btn btn-md btn-primary">Save</button>
														</div>
														
													</div>
												{!! Form::close() !!}
											</div>
										</div>

										<!-- <div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Attending : </b> <span>{!! $info-> attending !!}</span></p>

												<p onclick="edit_info('atd')" class="w3-left-align rep edtg">Edit</p>
											</div>
												
											<div id="atd" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}
													<div class="udfrm">
														<div class="col-md-8 at-dropdown">
															<?php
																if (!empty($info->attending)){
																	$year = explode('-', $info->attending);

																	$fromYear = $year[0];
																	$toYear = $year[1];
																}
																else{
																	$fromYear = "2002";
																	$toYear = "2005";
																}
															?>
															<select class="form-control" name="uattending-from" id="">
																<option value="">From</option>
																<option value="2002" {{old('uattending-from',$fromYear)=="2002"? 'selected':''}}>2002</option>
																<option value="2003" {{old('uattending-from',$fromYear)=="2003"? 'selected':''}}>2003</option>
																<option value="2004" {{old('uattending-from',$fromYear)=="2004"? 'selected':''}}>2004</option>
																<option value="2005" {{old('uattending-from',$fromYear)=="2005"? 'selected':''}}>2005</option>
																<option value="2006" {{old('uattending-from',$fromYear)=="2006"? 'selected':''}}>2006</option>
																<option value="2007" {{old('uattending-from',$fromYear)=="2007"? 'selected':''}}>2007</option>
																<option value="2008" {{old('uattending-from',$fromYear)=="2008"? 'selected':''}}>2008</option>
																<option value="2009" {{old('uattending-from',$fromYear)=="2009"? 'selected':''}}>2009</option>
																<option value="2010" {{old('uattending-from',$fromYear)=="2010"? 'selected':''}}>2010</option>
																<option value="2011" {{old('uattending-from',$fromYear)=="2011"? 'selected':''}}>2011</option>
																<option value="2012" {{old('uattending-from',$fromYear)=="2012"? 'selected':''}}>2012</option>
																<option value="2013" {{old('uattending-from',$fromYear)=="2013"? 'selected':''}}>2013</option>
																<option value="2014" {{old('uattending-from',$fromYear)=="2014"? 'selected':''}}>2014</option>
																<option value="2015" {{old('uattending-from',$fromYear)=="2015"? 'selected':''}}>2015</option>
																<option value="2016" {{old('uattending-from',$fromYear)=="2016"? 'selected':''}}>2016</option>
																<option value="2017" {{old('uattending-from',$fromYear)=="2017"? 'selected':''}}>2017</option>
																<option value="2018" {{old('uattending-from',$fromYear)=="2018"? 'selected':''}}>2018</option>
															</select>
															<select class="form-control" name="uattending-to" id="">
																<option value="">To</option>
																<option value="2005"  {{old('uattending-to',$toYear)=="2005"? 'selected':''}}>2005</option>
																<option value="2006" {{old('uattending-to',$toYear)=="2006"? 'selected':''}}>2006</option>
																<option value="2007" {{old('uattending-to',$toYear)=="2007"? 'selected':''}}>2007</option>
																<option value="2008" {{old('uattending-to',$toYear)=="2008"? 'selected':''}}>2008</option>
																<option value="2009" {{old('uattending-to',$toYear)=="2009"? 'selected':''}}>2009</option>
																<option value="2010" {{old('uattending-to',$toYear)=="2010"? 'selected':''}}>2010</option>
																<option value="2011" {{old('uattending-to',$toYear)=="2011"? 'selected':''}}>2011</option>
																<option value="2012" {{old('uattending-to',$toYear)=="2012"? 'selected':''}}>2012</option>
																<option value="2013" {{old('uattending-to',$toYear)=="2013"? 'selected':''}}>2013</option>
																<option value="2014" {{old('uattending-to',$toYear)=="2014"? 'selected':''}}>2014</option>
																<option value="2015"  {{old('uattending-to',$toYear)=="2015"? 'selected':''}}>2015</option>
																<option value="2016" {{old('uattending-to',$toYear)=="2016"? 'selected':''}}>2016</option>
																<option value="2017" {{old('uattending-to',$toYear)=="2017"? 'selected':''}}>2017</option>
																<option value="2018" {{old('uattending-to',$toYear)=="2018"? 'selected':''}}>2018</option>
																<option value="2019" {{old('uattending-to',$toYear)=="2019"? 'selected':''}}>2019</option>
																<option value="2020" {{old('uattending-to',$toYear)=="2020"? 'selected':''}}>2020</option>
																<option value="2021" {{old('uattending-to',$toYear)=="2021"? 'selected':''}}>2021</option>
																<option value="2022" {{old('uattending-to',$toYear)=="2022"? 'selected':''}}>2022</option>
															</select>
														</div>

														<div class="col-md-4">
															 <div class="radio form-control" style="color: #000;font-size: 15px;">
															     <input type="radio" id="public_stat" name="public_stat" value="1" {{ $info->attending_public == '1' ? 'checked' : '' }}>Public
															         <span style="margin-left: 10%;">
															     <input type="radio" id="public_stat" name="public_stat" value="0" {{ $info->attending_public == '0' ? 'checked' : '' }}>Private</span>
															 </div>
														</div>
														<button class="btn btn-md btn-primary">Save</button>
													</div>
												{!! Form::close() !!}
											</div>
										</div> -->

										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Hobby : </b> <span>{!! $info-> hobby !!}</span></p>

												<p onclick="edit_info('hby')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="hby" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<input type="text" class="form-control" name="uhobby" value="{!! $info-> hobby !!}">
														</div>
														<div class="col-md-4">
															 <div class="radio form-control" style="color: #000;font-size: 15px;">
															 	<span style="margin-left: 12%;">
															     <input type="radio" id="public_stat" name="public_stat" value="1" {{ $info->hobby_public == '1' ? 'checked' : '' }}>Public</span>

															         <span style="margin-left: 36%;">
															     <input type="radio" id="public_stat" name="public_stat" value="0" {{ $info->hobby_public == '0' ? 'checked' : '' }}>Private</span>
															 </div>
															 <button class="btn btn-md btn-primary">Save</button>
														</div>
														
													</div>
												{!! Form::close() !!}
											</div>
										</div>

										<div class="in_cr_box">
											<div class="col-md-10">

												<p class="info-box"><b>Skills : </b> <span>{!! $info-> skills !!}</span></p>

												<p onclick="edit_info('skl')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="skl" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}

													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<textarea class="form-control" name="uskills" id="uskills" rows="2">{!! $info-> skills !!}</textarea>
														</div>
														<div class="col-md-4">
															<button class="btn btn-md btn-primary">Save</button>
														</div>
													</div>
												{!! Form::close() !!}
											</div>
										</div>

										<div class="in_cr_box">
											<div class="col-md-8">

												<p class="info-box"><b>Quote : </b> <span>{!! $info-> quote !!}</span></p>

												<p onclick="edit_info('qut')" class="w3-left-align rep edtg">Edit</p>
											</div>

											<div id="qut" class="w3-hide">
												{!!Form::open(['action'=>['editProfileController@update', Auth::user()->id],'class' => 'frm' ,'method' => 'PUT'])!!}
													<div class="col-md-12 udfrm">
														<div class="col-md-8">
															<textarea class="form-control" name="uquote" id="uquote" rows="2">{!! $info-> quote !!}</textarea>
														</div>
														<div class="col-md-4">
															<button class="btn btn-md btn-primary">Save</button>
														</div>
													</div>
												{!! Form::close() !!}
											</div>
										</div>

									</div>
								@endforeach
								
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-xs-12 footer" style="background-color: #f7f7f7;">
				
				<div class="row">
					<div class="col-md-10 col-md-offset-1 ftr">
						<div class="goTopright">
						  <button class="w3-button btnUp"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
						</div>

						<div class="col-md-12 col-xs-12">

							<div class="row">
								<div class="col-md-4 col-xs-12" style="padding-left: 4px;">

									<a href="{{URL::to('/')}}"><img src="../../img/site-icon.png" alt=""></a>
									<p style="padding-top: 15px;text-align: justify;">Hello Learner,<br>You are always wellcome to our community. Here you can prepare your self for the examination, you can get clear concept on the question and answer.</p>

									<div class="social">
										<a href=""><span><i class="fa fa-facebook" aria-hidden="true"></i></span></a>
										<a href=""><span><i class="fa fa-linkedin" aria-hidden="true"></i></span></a>
									</div>
									
								</div>
								<div class="col-md-8">
									<div class="col-md-12 col-xs-12 clsm">
										<div class="row">
											<div class="col-md-6 col-md-offset-6 col-xs-12 clsm footer_menu">
												<ul>
													<li>quick links
														<hr align="left">
													</li>
													<li><a href=""><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> About Us</a></li>
													<!-- <li><a href=""><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Terms and Conditions</a></li> -->
													<!-- <li><a href=""><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Privacy Policy</a></li> -->
													<li><a href=""><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Contact Us</a></li>
												</ul>
											</div>
											<!-- <div class="col-md-6 col-xs-12 newsleter">
												<ul>
													<li>
														newsleter
														<hr align="left">
													</li>
													<li>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, corrupti beatae.</p>

														<form action="" method="POST">
															<input class="form-control inp" name="name" type="text" placeholder="Name">

															<input class="form-control inp" name="mail" type="mail" placeholder="Email">
															<button class="btn btn-md btn-block cbtn text-uppercase">subscribe</button>
														</form>
													</li>
												</ul>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>


			<div class="col-md-12 col-xs-12" id="bottom">
				<div class="row">
					<div class="col-md-4 col-md-offset-1 col-xs-12 copy-right">
						<p class="cptext">&copy 2018 | All Rights Reserved</p>
					</div>
					<div class="col-md-6 col-xs-12 ftmenu">
						<ul style="float: right;">
							<li><a href="home">Home</a></li>
							<li><a href="">About</a></li>
							<li>
								<a href="{{ route('logout') }}"
								    onclick="event.preventDefault();
								             document.getElementById('logout-form').submit();">
								    Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								    {{ csrf_field() }}
								</form>
							</li>
						</ul>

					</div>
				</div>
			</div>

		
	</div>

	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/app.js"></script>

	<script>

		function edit_info(id) {
		    var x = document.getElementById(id);
		    if (x.className.indexOf("w3-show") == -1) {
		        x.className += " w3-show";
		    } else { 
		        x.className = x.className.replace(" w3-show", "");
		    }
		}

	    if (document.getElementById("snackbar-danger")) {
	    	var x = document.getElementById("snackbar-danger")
	    	x.className = "show";
	    	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
	    } 
	    if (document.getElementById("snackbar-success")) {
	    	var x = document.getElementById("snackbar-success")
	    	x.className = "show";
	    	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
	    }

	</script>

</body>
</html>