<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title></title>
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="container-fluid">

		@if(session('success'))
		    <div class="alert alert-success">
		        {{session('success')}}
		    </div>
		@endif
		@if(session('failed'))
		    <div class="alert alert-danger">
		        {{session('failed')}}
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
					      <li><a href="#">How it work</a></li>
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
					    </ul>

						</div>
					  </div>
					</nav>
				</div>
			</div>

			<div class="col-md-12" style="background: #fff;">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-8" id="tml">
								<div class="text-center" style="background: #1761a0; color: #fff; padding: 5px 0;">
									
								</div>
								<div class="well wl">

									@if(count($result)>0)

											@foreach($result as $rs)
												
												<div class="well sub_infoCon">
													<div style="text-align: justify;" id="pid" data-postid="{{ $rs->id }}">
														<h5>{!! $rs->uploader !!}</h5>
														<p>{!! $rs->created_at !!}</p>
														<p>Course Code : {!! $rs->course_code !!}; &nbsp; Semester : {!! $rs->semester !!};</p>
														<div id="qst">Q{!! $rs->id !!} . {!! $rs->question !!}</div>
													</div>

													<p class="error text-center alert alert-danger hidden"></p>

													{!! Form::open(['method' => 'POST']) !!}
														<input type="hidden" name="sub" value="{!! $rs->course_code !!}">
													    <textarea class="form-control" name="answer" style="resize: none;" rows="4" id="answer" placeholder="Write your answer here..."></textarea>
													    <button type="button" class="btn btn-md btn-primary" id="postans">Submit Answer</button>
													{!! Form::close() !!}


													@foreach($ans as $answer)

														@if( $rs->course_code == $answer->subject && $rs->id == $answer->q_id)
															<div style="background: #fff; border-radius: 14px; padding: 0px 6px;">
																<h6 style="margin-bottom: 0;font-size: 14px;">{!! $answer->author !!}</h6>
																<span style="font-size: 12px;">{!! $answer->answer_date !!}</span>
																<p style="white-space: pre-line;text-align: justify;">{!! $answer->ans_content !!}</p>
															</div>
														@endif

													@endforeach

												</div>
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

	<script>
		$(document).ready(function() {
		    $('#postans').on('click', function () {
		        var post_Id = $('#pid').attr('data-postid');
		        var answer = $('#answer').val();
		        var url = '{{ route('answer') }}';
		        var token = $("input[name='_token']").val();
		        var sub = $("input[name='sub']").val();

		        $.ajaxSetup({
		          headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		          }
		        });	        
		        
		        $.ajax({
		            type: "POST",
		            url: url,
		            data: {ans_content: answer, qID: post_Id, sub: sub, token: token},
		            success: function(data) {
                        if ((data.errors)){
                          $('.error').removeClass('hidden');
                            $('.error').text('Sorry ! There are Error in Answer.');
                        }
                        else {

                            $('.error').addClass('hidden');
                            $('#answer').val('');
                            location.reload();
                        }
                    },
		        });
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