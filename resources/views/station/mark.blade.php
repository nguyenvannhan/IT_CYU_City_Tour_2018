@foreach($team_marks as $item)
<div class="form-group row w-100">
    <div class="col-9 align-items-center d-flex">
        {{ $item->Mark_Criteria->name.' (Max: '.($item->Mark_Criteria->max_mark < 0 ? -1 * $item->Mark_Criteria->max_mark : $item->Mark_Criteria->max_mark).')' }}
    </div>
    <div class="col-3 text-center">
        {{ $item->mark }}
    </div>
</div>
@endforeach