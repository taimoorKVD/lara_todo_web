@if ($message = Session::get('error-message'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('success-message'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('info-message'))
    <div class="alert alert-info">
        <p>{{ $message }}</p>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
