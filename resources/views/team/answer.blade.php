<form action="#" method="POST" id="btn-check-answer">
    <div class="form-group">
        <input type="hidden" name="suggest_id" value="{{ $suggestion->id }}">
        <p class="text-info text-center" style="border: 1px solid #ddd; border-radius: 10px;">
            {!! $suggestion->content !!}
        </p>
    </div>
    
    <div class="form-group">
        <input class="form-control" placeholder="Nhập đáp án tại đây" name="answer" required>
    </div>
    
    
    <div class="form-group">
        <button class="btn btn-info" type="submit">Xác nhận</button>
    </div>

    <div class="form-group alert " id="result-alert">
        
    </div>
</form>

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
<div class="modal fade" id="fail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 offset-3">
                        <img class="img-fluid" src="{{ asset('images/fail-icon.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>