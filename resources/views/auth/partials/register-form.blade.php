<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
        <label for="surname" class="col-md-4 control-label">Surname</label>

        <div class="col-md-6">
            <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

            @if ($errors->has('surname'))
                <span class="help-block">
                    <strong>{{ $errors->first('surname') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <hr>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Address</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
        <label for="postal_code" class="col-md-4 control-label">Postal Code</label>

        <div class="col-md-6">
            <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required autofocus>

            @if ($errors->has('postal_code'))
                <span class="help-block">
                    <strong>{{ $errors->first('postal_code') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
        <label for="country" class="col-md-4 control-label">Country</label>

        <div class="col-md-6">
            <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" required autofocus>

            @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
        <label for="telephone" class="col-md-4 control-label">Phone Number</label>

        <div class="col-md-6">
            <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required autofocus>

            @if ($errors->has('telephone'))
                <span class="help-block">
                    <strong>{{ $errors->first('telephone') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('tc_id') ? ' has-error' : '' }}">
        <label for="tc_id" class="col-md-4 control-label">TC Kimlik</label>

        <div class="col-md-6">
            <input id="tc_id" type="text" class="form-control" name="tc_id" value="{{ old('tc_id') }}" required autofocus>

            @if ($errors->has('tc_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('tc_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </div>
</form>