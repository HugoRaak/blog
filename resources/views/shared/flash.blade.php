@if (session()->has('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@elseif($errors->any())
    @php $globalErrors = []; @endphp
    @foreach($errors->all() as $error)
        @if (str_starts_with($error, 'general_error_'))
            @php $globalErrors[] = $error; @endphp
        @endif
    @endforeach
    @if(!empty($globalErrors))
        <div class="alert alert-danger">
            <ul class="my-8">
                @foreach($globalErrors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
