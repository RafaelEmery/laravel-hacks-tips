@if ($errors->any())
<div class="alert alert-danger alert-elevate col-sm-12" role="alert">
    <div class="alert-icon"><i class="
        flaticon-exclamation-1 text-light"></i></div>
    <div class="alert-text">
    @foreach ($errors->all() as $error)
        {{$error}}<br>
    @endforeach
    </div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif