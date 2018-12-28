@if ($errors->has('email'))
    <span class="invalid-feedback">
        <strong>{{($errors->first('email'))}}</strong>
    </span>
@elseif ($errors->has('password'))
    <span class="invalid-feedback">
        <strong>{{($errors->first('password'))}}</strong>
    </span>
@elseif ($errors->has('image'))
    <span class="invalid-feedback">
        <strong>{{($errors->first('image'))}}</strong>
    </span>
@endif
