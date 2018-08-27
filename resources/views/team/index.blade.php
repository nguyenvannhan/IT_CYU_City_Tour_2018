<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>City Tour FIT UTE 2018 - Trang gợi ý trạm</title>
	<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	
	<script>
		var base_url = "{{ URL::to('/').'/' }}";
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
</head>
<body>
	<div class="container-fluid px-0">
		<div class="col-12 bg-info text-center py-3">
			<small class="text-white">CITY TOUR 2018 - WELCOME TO IT HCMUTE</small><br/>
			<h4>{{ !isset($station) ? '' : $station->name }}</h4>
		</div>
		
		<div class="col-12 text-center" id="content" style="margin-bottom: 120px;">
			@if(isset($error))
			<p class="text-center text-danger">{{ $error }}</p>
			@elseif(isset($success_all))
			<p class="text-center text-danger">{{ $success_all }}</p>
			@else 
			@if(!isset($open_suggest) || is_null($open_suggest))
			<p class="text-center text-danger">Bạn chưa được mở khóa gợi ý tại trạm này</p>
			
			<div class="clearfix"></div>
			<div class="col-12">
				<iframe src="{{ 'https://www.google.com/maps/embed?'.$station->map }}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			@else
			@if($process)
			<p class="text-center text-danger">Bạn đã kết thúc gợi ý này</p>
			@else 
			<div class="row">
				<input type="hidden" value="{{ $station->id }}" name="station_id">
				<div class="col-12 text-danger text-center bg-light py-4" id="time">
					20:00
				</div>
				
				<div class="col-12" id="main-content">
					<p class="text-info text-center">
						1. Bạn chỉ có <span style="color: red;">20 phút </span>để tìm ra đáp án gợi ý. Khi đã <span style="color: red;">nhấn Bắt đầu </span>sẽ <span style="color: red;">không thể quay lại.</span><br/>
						2. <span style="color: red;">Không reload page khi đã nhấn bắt đầu.</span><br/>
						3. Khi kết thúc trả lời gợi ý, <span style="color: red;">giữ nguyên Page và thông báo cho Trạm trưởng</span>.<br/>
					</p>
					<button class="btn btn-block btn-primary" id="btn-start">Bắt đầu</button>
				</div>
			</div>
			<script>
				var mi = 20;
				var se = 0;
				
				$('#btn-start').on('click', function(e) {
					e.preventDefault();
					
					$.ajax({
						url: base_url+'doi-choi/get-question',
						method: 'POST',
						data: {
							'station_id': $('input[name="station_id"]').val()
						}
					})
					.done(function(data) {
						console.log(data);
						
						if(data.result) {
							$('#main-content').html(data.view);
							
							var x = setInterval(function() {
								if(se == 0) {
									mi = mi - 1;
									if(mi != -1) {
										se = 59;
									}
								} else {
									se = se -1;
								}
								var strMi = mi;
								if(mi != -1 && mi < 10) {
									var strMi = '0' + mi;
								} 
								if(mi == -1) {
									strMi = '00';
								}
								var strSe = se;
								if(se < 10) {
									strSe = '0' + se;
								}
								
								$('#time').text(strMi+':'+strSe);
								
								if(mi == -1 && se == 0) {
									$('input[name="answer"]').attr('disabled', true);
									$('#result-alert').text('Thất bại');
									$('#result-alert').addClass('alert-danger');
									$('#fail').modal('toggle');
									expiredAnswer(0);
									
									clearInterval(x);
								}
							}, 1000);
							
							var times = 2;
							$('#btn-check-answer').on('submit', function(e) {
								e.preventDefault();
								
								$.ajax({
									url: base_url + 'doi-choi/check-answer',
									method: 'POST',
									data: $(this).serialize()
								})
								.done(function(data) {
									console.log(data);
									
									if(data.result == 0) {
										times = times - 1;
										$('#fail').modal('toggle');
										if(times == 0) {
											$('input[name="answer"]').attr('disabled', true);
											$('#result-alert').text('Thất bại');
											$('#result-alert').addClass('alert-danger');
											expiredAnswer(0);
											
											clearInterval(x);
										}
									} else {
										$('#success').modal('toggle');
										$('input[name="answer"]').attr('disabled', true);
										$('#result-alert').text('Thành công');
										$('#result-alert').addClass('alert-success');
										expiredAnswer(1);
										
										clearInterval(x);
									}
								})
								.fail(function(xhr, status, error) {
									console.log(this.url);
									console.log(error);
								});
							});
						}
					})
					.fail(function(xhr, status, error) {
						console.log(this.url);
						console.log(error);
					});
				});
				
				function expiredAnswer(result) {
					var station_id = $('input[name="station_id"]').val();
					
					$.ajax({
						url: base_url + 'doi-choi/expired-question',
						method: 'POST',
						data: {
							'result': result,
							'station_id': station_id
						}
					})
					.done(function(data) {
						console.log(data);
					})
					.fail(function(xhr, status, error) {
						console.log(this.url);
						console.log(error);
					});
				}
			</script>
			@endif
			
			@endif
			@endif
		</div>
		<footer class="page-footer font-small blue" style="background-color: #ddd;">
			<div class="footer-copyright text-center text-danger">Đường dây nóng</div>
			<div class="footer-copyright text-center text-info"><strong>Tuấn Kiệt: 01646356275</strong></div>
			<div class="footer-copyright text-center text-info"><strong>Võ Phúc: 0963499611</strong></div>
			<div class="footer-copyright text-center text-info"><strong>Minh Trung: 01684648350</strong></div>
			@if(Auth::check())
			<div class="text-center text-info">
				<a href="{{ route('get_logout_route') }}">Logout</a>
			</div>
			@endif
		</footer>
	</div>
</body>
</html>