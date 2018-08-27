<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    
	<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>
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
</head>
<body>
    <div class="container">
        <div class="col-12 table-responsive">
            <table class="table table-stripped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Đội chơi</th>
                        <th>Trạm</th>
                        <th>Điểm</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teamList as $team)
                    @php 
                    $total = 0; 
                    foreach($team->getMarks as $mark) {
                        $total += $mark->mark;
                    }
                    @endphp
                    @foreach($stationList as $station)
                    @if($loop->first)
                    <tr>
                        <td rowspan="{{ count($stationList) }}">{{ $team->name }}</td>
                        <td>{{ $station->name }}</td>
                        @php
                        $total2 = 0;
                        $markList = $team->getMarks->where('station_id', $station->id);
                        
                        foreach($markList as $mark) {
                            $total2 += $mark->mark;
                        }
                        @endphp
                        <td>{{ $total2 }}</td>
                        <td rowspan="{{ count($stationList) }}">{{ $total }}</td>
                    </tr>
                    @else 
                    <tr>
                        <td>{{ $station->name }}</td>
                        @php
                        $total2 = 0;
                        $markList = $team->getMarks->where('station_id', $station->id);
                        
                        foreach($markList as $mark) {
                            $total2 += $mark->mark;
                        }
                        @endphp
                        <td>{{ $total2 }}</td>
                    </tr>
                    @endif
                    @endforeach                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>