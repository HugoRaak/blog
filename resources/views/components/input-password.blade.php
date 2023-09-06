<label for="{{$name}}">{{$label}}</label>
<input type="password" class="form-control @if($errors->updatePassword->has($name)) is-invalid @endif" name="{{$name}}" id="{{$name}}" {{$attributes}}>
@if($errors->updatePassword->has($name))
<div class="invalid-feedback">
    {{$errors->updatePassword->first($name)}}
</div>
@endif
