@if ($errors->has('email'))
    <span class="invalid-feedback">
        <strong>{{($errors->first('email'))}}</strong>
    </span>
@elseif ($errors->has('password'))
    <span class="invalid-feedback">
        <strong>{{($errors->first('password'))}}</strong>
    </span>
@elseif ($errors->has('image'))
    <span class="error">
        <strong>{{($errors->first('image'))}}</strong>
    </span>
@elseif ($errors->has('date_start'))
    <span class="error">
        <strong>{{ ($errors->first('date_start')) }}</strong>
    </span>
@elseif ($errors->has('name'))
    <span class="error">
        <strong>{{ ($errors->first('name')) }}</strong>
    </span>
@endif
