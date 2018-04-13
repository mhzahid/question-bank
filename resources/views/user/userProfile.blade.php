<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Profile: {{Auth::user()->name}}</title>
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" href="css/style.css">
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
					      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="img/site-icon.png" alt="Question Bank"></a>
					    </div>

						<div class="collapse navbar-collapse" id="bs-navbar-collapse">
					    <ul class="nav navbar-nav" style="text-transform: capitalize;">
					      <li><a href="home">home</a></li>
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


			<div class="col-md-12 text-left" id="up_file">
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
				<div class="container">
					<div class="col-md-6 col-md-offset-3 col-xs-12 collapse" id="coll">
						{!! Form::open(['url'=>'up_load', 'class' => '', 'files'=>true,'method' => 'POST', 'id'=>'']) !!}
						<div class="row">
							<div class="col-md-12 col-xs-12"  style="top: 5px;">
								<div id="image-preview">
									<label for="image-upload" id="image-label">Choose File</label>
									<input type="file" name="img" accept=".jpg, .jpeg, .png" id="image-upload" />
								</div>	
							</div>

							<div class="col-md-12 col-xs-12" style="top: 10px;">
								<!-- <textarea class="form-control" name="desc" id="" rows="3" placeholder="Some description ..."></textarea> -->
								<button class="btn btn-md btn-primary">Upload question</button>
							</div>
						</div>
						{!! Form::close() !!}	
					</div>
				</div>
			</div>

			<div class="col-md-12" style="background: #fff;">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-8" id="tml">
								<div class="text-center" style="background: #1761a0; color: #fff; padding: 5px 0;">
									<h2 style="margin: 0; padding: 0; font-size: 25px;">Timeline</h2>
								</div>
								<div class="well wl">

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
																<a href="view?semester_tag={!! $rs->semester !!}"><span>{!! $rs->semester !!}</span></a>
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

	<script src="js/jquery.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/uploadPreview.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
		  $.uploadPreview({
		    input_field: "#image-upload",   // Default: .image-upload
		    preview_box: "#image-preview",  // Default: .image-preview
		    label_field: "#image-label",    // Default: .image-label
		    label_default: "Choose File",   // Default: Choose File
		    label_selected: "Change File",  // Default: Change File
		    no_label: false                 // Default: false
		  });
		});
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

</body>
</html>