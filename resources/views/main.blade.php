<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

	<title>Home</title>
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/app.js"></script>


</head>
<body>
	<div class="container-fluid">
		@if(session('alert'))
		    <div id="snackbar-danger" style="font-size: 17px; right: 4.3%;">
		        {{session('alert')}}
		    </div>
		@endif
			<div class="col-md-12 col-xs-12" id="top" style="background: #424242;min-height: 45px;color: #999999;">
				<div class="row">
					<div class="col-md-4 col-md-offset-1 col-xs-12 social">
						<span><a href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a></span>
						<span><a href="#"><i class="fa fa-linkedin fa-lg" aria-hidden="true"></i></a></span>
					</div>
					<div class="col-md-6 col-xs-12" style="height: 44px;">
						<div style="display: flex; float: right;">
							<p style="padding: 12px 0;padding-right: 8px;"><span><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp</span>info@company.com</p>
						<p style="padding: 5px;padding-top: 12px;">|</p>
							<p style="padding: 12px 0;"><span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp</span>01234567890</p>
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
					      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="img/site-icon.png" alt="Question Bank"></a>
					    </div>

						<div class="collapse navbar-collapse" id="bs-navbar-collapse">
					    <ul class="nav navbar-nav">
					      <li><a href="home">home</a></li>
					      <li><a href="#">How it work</a></li>
					      <li><a href="#">contact us</a></li>
					    </ul>

					    <ul class="nav navbar-nav navbar-right">
							
							@guest
								<li><a data-toggle="modal" data-target="#signup" href="#"><span><i class="fa fa-user-plus" aria-hidden="true"></i></span> sign up</a></li>
								<li><a data-toggle="modal" data-target="#login" href="#"><span><i class="fa fa-sign-in" aria-hidden="true"></i></span> login</a></li>
							@else
								<li class="dropdown">
									<div id="lgot">
								    <a href="profile">
								        <img src="{{asset('img/default-pic.jpg')}}" alt="User avater">
								        {{ Auth::user()->name }}
								    </a>
								    <span class="dropdown-toggle caret" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"></span>

								    <ul class="dropdown-menu">
								    	<li>
								    		<a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit profile</a>
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
							@endguest
					    </ul>
						</div>
					  </div>
					</nav>
				</div>
			</div>


			<div class="col-md-12" id="bganm">
				<div class="container cn">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 jumbort">
							<div class="site_icon">
							</div>
							<h1 style="color: #fff;">hello <br> learner</h1>

							<div style="padding-top: 60px;">
								<a href="profile"><button class="btn btn-md cbtn">GET STARTED NOW</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-md-12" style="background: #fff;">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-8" id="tml">
								<div class="text-center" style="background: #1761a0; color: #fff; padding: 5px 0;">
									<h2 style="margin: 0; padding: 0; font-size: 25px; text-transform: capitalize;">all question</h2>
								</div>
								<div class="well">

									@if(count($result)>0)

									@foreach($result as $res)

										@foreach($res as $rs)
											
											<div class="well sub_infoCon">
												<h2>Course Code : {!! $rs->course_code !!}</h2>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-4">
															<!-- <a class="btn btn-md btn-primary" href="">View</a> -->
														</div>
														<div class="col-md-8">
															<div class="tag">
																<a href="view?exam_tag={!! $rs->exam !!}">
																	<span>{!! $rs->exam !!}</span></a>
																<a href="view?sub={!! $rs->course_code !!}&semester_tag={!! $rs->semester !!}"><span>{!! $rs->semester !!}</span></a>
															</div>
														</div>
													</div>
												</div>
											</div>
										@endforeach

									@endforeach

									@else
										<h3>No post to display</h3>
									@endif
									
								</div>
							</div>
							<div class="col-md-4" id="tp">
								<div class="list-group">
								  <h2 class="list-group-item text-center">Top Reply Question</h2>
								  @if(count($top)>0)
								  	@foreach($top as $tp)
								  		@foreach($tp as $tq)
								  			<a href="single_view?qid={!! $tq->id !!}&sub={!! $tq->course_code !!}&semester_tag={!! $tq->semester !!}" class="list-group-item">
								  				
							  				<?php 

						  						$stringCut = substr($tq->question, 0, 100);

						  					    $question = substr($stringCut, 0, strrpos($stringCut, ' ')).' ... '; 
						  					    echo $question;
							  				 ?>

								  			</a>
								  		@endforeach
								  	@endforeach
								  @endif
								</div>
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

									<a href="{{URL::to('/')}}"><img src="img/site-icon.png" alt=""></a>
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

			@guest
				<div class="modal fade" id="login" role="dialog">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header" style="padding: 12px 50px;">
				        <h4>Login form</h4>
				      </div>
				      <div class="modal-body" style="padding:40px 50px;">
				        <form role="form" method="POST" action="{{ route('login') }}">
				        	{{ csrf_field() }}
				          <div class="input-group">
				              <!-- <input id="mail" type="text" class="form-control field" name="mail" placeholder="Email Address"> -->
				              <input id="mail" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
				              <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
				          </div>
				          <div class="input-group">
				            <!-- <input type="password" class="form-control field" name="paw" id="pass" placeholder="Password"> -->
				            <input id="password_l" type="password" class="form-control" name="password" placeholder="Password" required>
				            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
				          </div>

				          <!-- <div class="checkbox">
				            <label><input type="checkbox" value="" checked>Remember Me</label>
				             <label style="float: right;"><a href="#">Forgot Password <span><i class="fa fa-question-circle" aria-hidden="true"></i></span></a></label>
				          </div> -->

				          <div class="form-group">
				              <div class="col-md-6" style="padding: 0;">
				                  <div class="checkbox">
				                      <label>
				                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
				                      </label>
				                  </div>
				              </div>
				          </div>

				            <button type="submit" class="btn btn-block sbmbtn">LOGIN</button>
				        </form>
				      </div>
				      <div class="modal-footer">
				        <p><span style="float: left;">Not a Member Yet?</span><a href="#signup" data-toggle="modal" data-dismiss="modal">Sign Up</a></p>
				      </div>
				    </div>
				    
				  </div>
				</div>

				<div class="modal fade" id="signup" role="dialog">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header" style="padding: 12px 50px;">
				        <h4>registration form</h4>
				        <p>Already Have An Account? <a href="#login" data-toggle="modal" data-dismiss="modal"> Log In</a></p>
				      </div>
				      <div class="modal-body" style="padding:40px 50px;">
				        <form role="form" method="POST" action="{{ route('register') }}">
				        	{{ csrf_field() }}
				        	<!-- <div class="form-group">
				            	<input id="firstname" type="text" class="form-control field1" name="firstname" placeholder="First Name">
				          	</div>
				          	<div class="form-group">
				            	<input id="lastname" type="text" class="form-control field1" name="lastname" placeholder="Last Name">
				          	</div> -->

				          	<div class="form-group">
				            	<!-- <input id="username" type="text" class="form-control field1" name="username" placeholder="User Name"> -->
				            	<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="User Name" required autofocus>
				          	</div>

				          <div class="form-group">
				              <!-- <input id="umail" type="text" class="form-control field1" name="mail" placeholder="Email Address"> -->
				              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
				          </div>
				          <div class="form-group">
				            <!-- <input type="password" class="form-control field1" name="paw" id="password" placeholder="Password"> -->
				            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
				          </div>
				          <div class="form-group"><!-- 
				            <input type="password" class="form-control field1" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password"> -->
				            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
				          </div>
				          <!-- <div class="form-group">
				            <input type="text" class="form-control field1" name="mobileno" id="mobileno" placeholder="Mobile Number">
				          </div> -->
				            <button type="submit" class="btn btn-block sbmbtn">CREATE AN ACCOUNT</button>
				        </form>
				      </div>
				    </div>
				    
				  </div>
				</div>
			@endguest

			<div class="col-md-12 col-xs-12" id="bottom">
				<div class="row">
					<div class="col-md-4 col-md-offset-1 col-xs-12 copy-right">
						<p class="cptext">&copy 2018 | All Rights Reserved</p>
					</div>
					<div class="col-md-6 col-xs-12 ftmenu">
						<ul style="float: right;">
							<li><a href="{{URL::to('/')}}">Home</a></li>
							<li><a href="">About</a></li>
							@guest
								<li><a data-toggle="modal" data-target="#login" href="#">Login</a></li>
								<li><a data-toggle="modal" data-target="#signup" href="#">Register</a></li>								
							@else
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
							@endguest
							
						</ul>

					</div>
				</div>
			</div>

		
	</div>

	<script>
		$(function(){
			$(".btnUp").click(function()
				{$("html,body").animate(
					{scrollTop:$("#top").offset().top},"1500"
					);
				return false
			})
		})
	</script>
	<script>

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
	<!-- <script>
		window.onbeforeunload = function (e) {
		    e = e || window.event;

		    var url = window.location.href;
		     $.ajax({
		    	 type: 'POST',
		    	 url: "{{ route('logout') }}",
		    	 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
		    	 success: function () {
		    	 	console.log('dcvd');
		    	 	location.reload();
		    	 }
		     });
		};
	</script> -->

</body>
</html>