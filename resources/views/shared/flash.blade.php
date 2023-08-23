@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger">
        <ul class="my-8">
            @foreach($errors->all() as $error)
                <li>{{$errors}}</li>
            @endforeach
        </ul>
    </div>
@endif
