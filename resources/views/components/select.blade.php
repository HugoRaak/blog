<label for="{{$name}}">{{$label}}</label>
<select class="form-control @error($name) is-invalid @enderror" name="{{$name}}[]" id="{{$name}}" {{$attributes}}">
@foreach($options as $k => $v)
    <option @selected($value->contains($k)) value="{{$k}}">{{$v}}</option>
@endforeach
</select>
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
