<label for="{{$name}}">{{$label}}</label>
@if($type === 'textarea')
    <textarea class="form-control @error($name) is-invalid @enderror" name="{{$name}}" id="{{$name}}" {{$attributes}}>{{old($name, $value)}}</textarea>
@else
    <input type="{{$type}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" id="{{$name}}" {{$attributes}} value="{{old($name, $value)}}">
@endif
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
