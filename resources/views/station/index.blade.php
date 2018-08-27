<!DOCTYPE html>
<html lang="en">
<head>
	<title>City Tour FIT UTE 2018</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" media="all" href="https://poste-vn.com/css/common.css">
    <link rel="stylesheet" media="screen and (min-width: 400px)" href="https://poste-vn.com/css/common-xs.css">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="https://poste-vn.com/css/common-sm.css">
    <link rel="stylesheet" media="screen and (min-width: 992px)" href="https://poste-vn.com/css/common-md.css">
    <link rel="stylesheet" media="screen and (min-width: 1200px)" href="https://poste-vn.com/css/common-lg.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        var base_url = "{{ URL::to('/') }}";
        var type_request = 0;
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body>
    
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
            <h1 class="text-center">{{ $station->name }}</h1>
		</div>
	</div>
	
	<div class="container">
		<div class="col-12 col-sm-4 offset-sm-4" style="padding-left:0;">
            <select name="doichoi" class="custom-select">
                <option value="0" {{ $team_id == 0 ? 'selected' : '' }}>Chọn đội chơi</option>
                @foreach ($teamList as $item)
                <option value="{{ $item->id }}" {{ $team_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
		</div>
    </div>
    <div id="content" style="padding-bottom: 120px;">
        @if($team_id > 0)
        @include('station.content')
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
    
    <script>
        $('select[name="doichoi"]').on('change', function() {
            var team_id = $(this).val();
            
            
            $.ajax({
                url: base_url + '/tram-truong/getContent/'+team_id,
                method: 'GET'
            })
            .done(function(data) {
                $('#content').html(data.view);
                
                $('input.input-mark').on('keypress', function(e) {
                    if((e.which < 48 || e.which > 57) && e.which != 8) {
                        e.preventDefault();
                    }
                });

                $('input.input-mark').on('input', function(e) {
                    
                    var max = parseInt($(this).attr('max'));
                    var min = parseInt($(this).attr('min'));
                    
                    if ($(this).val() > max)
                    {
                        $(this).val(max);
                    }
                    else if ($(this).val() < min)
                    {
                        $(this).val(min);
                    }
                });
                
                
                $('#open-suggestion-href').on('click', function(e) {
                    e.preventDefault();
                    
                    var team_id = $(this).data('team');
                    var station_id = $(this).data('station');
                    
                    $('#content-comfirm').text("Gợi ý khi mở sẽ không thể đóng lại. \n Bạn có chắc muốn mở gợi ý?");
                    
                    $('#confirm-modal').modal('toggle');
                    
                    $('.confirm-button').on('click', function() {
                        var result_confirm = $(this).data('value');
                        
                        if(result_confirm) {
                            $('#confirm-modal').modal('toggle');
                            
                            openSuggestion(team_id, station_id);
                        }
                    });
                });
                
                $('#add-mark').on('submit', function(e) {
                    e.preventDefault();
                    
                    $('#content-comfirm').text("Bạn có chắc muốn lưu điểm không?");
                    
                    $('#confirm-modal').modal('toggle');
                    
                    $('.confirm-button').on('click', function() {
                        var result_confirm = $(this).data('value');
                        
                        if(result_confirm) {
                            $('#confirm-modal').modal('toggle');
                            
                            saveMark();
                        }
                    });
                });
                
                function saveMark() {
                    $.ajax({
                        url: base_url + '/tram-truong/save-mark',
                        method: 'POST',
                        data: $('#add-mark').serialize()
                    })
                    .done(function(data) {
                        console.log(data);
                        if(data.result) {
                            // $('#team-mark-div').html(data.view);              
                            $('#success').modal('toggle');
                            
                            $('#success').on('hidden.bs.modal', function() {
                                updatePage();  
                            });
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.log(this.url);
                        console.log(error);
                    });
                }
                
                function openSuggestion(team_id, station_id) {
                    $.ajax({
                        url: base_url + '/tram-truong/open-suggestion',
                        method: 'POST',
                        data: {
                            'team_id': team_id,
                            'station_id': station_id
                        }
                    })
                    .done(function(data) {
                        console.log(data);
                        if(data.result) {
                            $('#open-suggestion-href').removeClass('btn-success');
                            $('#open-suggestion-href').addClass('btn-danger');
                            $('#open-suggestion-href').addClass('disabled');
                            $('#open-suggestion-href').bind('off');
                            
                            $('#success').modal('toggle');
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.log(this.url);
                        console.log(error);
                    });
                }
                
                function updatePage() {
                    var team_id = $('select[name="doichoi"]').val();
                    
                    
                    $.ajax({
                        url: base_url + '/tram-truong/getContent/'+team_id,
                        method: 'GET'
                    })
                    .done(function(data) {
                        $('#content').html(data.view);
                    })
                    .fail(function(xhr, status, error) {
                        console.log(this.url);
                        console.log(error);
                    });
                }
            })
            .fail(function(xhr, status, error) {
                console.log(this.url);
                console.log(error);
            });
        });
    </script>
</body>
</html>