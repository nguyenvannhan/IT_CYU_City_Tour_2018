<div class="container mt-3">
    <div class="row">
        <h6 class="text-center w-100 font-size-18px font-weight-bold text-uppercase py-2" style="background-color: #03ce00;">Tiến trình của đội</h6>
    </div>
    @php 
    $check = 0;
    @endphp
    @forelse ($team_routes as $item)
    <div class="progress mb-2" style="height: 30px">
        @php
        $check_final_station = 0;
        if($item->is_passed) {
            $type = 'bg-success';
        } else {
            if(!$check) {
                $type='bg-info progress-bar-striped progress-bar-animated';
                $check = 1;
            } else {
                $type="bg-secondary progress-bar-striped progress-bar-animated";
            }
        }
        @endphp
        <div class="progress-bar {{ $type }} w-100">{{ $item->Station->name }}</div>
    </div>
    <?php 
    if($loop->last && Auth::user()->id == $item->station_id) {
        $check_final_station = 1;
    }
    ?>
    @empty
    <p class="text-center">Không có dữ liệu</p>
    @endforelse
</div>
@if(!$check_final_station)
<div class="container mt-5">
    <div class="row">
        <h6 class="text-center w-100 font-size-18px font-weight-bold text-uppercase py-2" style="background-color: #03ce00;">GỢI Ý</h6>
    </div>
    <div class="col-12 col-sm-4 ofsset-sm-4">
        <a href="#" id="open-suggestion-href" data-team="{{ $team_id }}" data-station="{{ $station->id }}" class="btn {{ !$suggestion_opened ? 'btn-success' : 'btn-danger disabled' }} btn-block">MỞ KHÓA</a>
    </div>
</div>
@endif
<div class="container mt-5">
    <div class="row">
        <h6 class="text-center w-100 font-size-18px font-weight-bold text-uppercase py-2" style="background-color: #03ce00;">ĐIỂM</h6>
    </div>
    
    <div class="col-12">
        <div class="row" id="team-mark-div">
            @forelse($team_marks as $item)
            <div class="form-group row w-100">
                <div class="col-9 align-items-center d-flex">
                    {{ $item->Mark_Criteria->name.' (Max: '.($item->Mark_Criteria->max_mark < 0 ? -1 * $item->Mark_Criteria->max_mark : $item->Mark_Criteria->max_mark).')' }}
                </div>
                <div class="col-3 text-center">
                    {{ $item->mark }}
                </div>
            </div>
            @empty
            <form action="#" method="POST" id="add-mark" class="w-100">
                <input type="hidden" value="{{ $station->id }}" name="station_id">
                <input type="hidden" value="{{ $team_id }}" name="team_id">
                @foreach ($mark_criterias as $item)
                <input type="hidden" name="mark_criteria_id[]" value="{{ $item->id }}">
                <div class="form-group row w-100">
                    <div class="col-9 align-items-center d-flex">
                        {{ $item->name.' (Max: '.($item->max_mark < 0 ? -1 * $item->max_mark : $item->max_mark).')' }}
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control input-mark" value="0" min="0" max="{{ $item->max_mark < 0 ? -1 * $item->max_mark : $item->max_mark }}" name="mark[]"  {{ $item->id == 1 && $station->id == 2 ? 'readonly' : '' }} required>
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <button type="submit" class="btn btn-block btn-lg btn-primary mx-auto rounded-0">Cập nhật điểm và Qua Trạm</button>
                </div>
            </form>
            @endforelse
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center" id="content-comfirm">
                    Không thể thay đổi khi đã xác nhận<br/>
                    Bạn có chắc muốn confirm?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary confirm-button" data-value="0" data-dismiss="modal">Không</button>
                <button type="button" class="btn btn-primary confirm-button" data-value="1">Có</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 offset-3">
                        <img class="img-fluid" src="{{ asset('images/success-icon.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    
</script>