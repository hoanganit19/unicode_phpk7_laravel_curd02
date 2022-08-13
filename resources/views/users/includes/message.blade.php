@if (!empty(session('msg')))
    <div class="alert alert-{{$type??'success'}} text-center">
        {{session('msg')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-center">
        {{trans('validation.validate_error')}}
    </div>
@endif
