@if ($field['type'] ==='hidden')
    <input type="{{$field['type']}}" value="{{session($field['name'])}}" name="{{$field['name']}}">
@else
    @if ($errors->has($field['name']))
        <div class="error">{{ $errors->first($field['name']) }}</div>
    @endif
    <label for="{{$field['name']}}">@lang($field['name']):</label>
    <input type="{{$field['type']}}" value="{{old($field['name'])}}" class="form-control" name="{{$field['name']}}">
@endif