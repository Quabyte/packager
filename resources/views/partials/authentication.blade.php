<div class="row">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">REGISTER</a></li>
        <li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">LOGIN</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="register" style="padding-top: 30px;">
            @include('auth.partials.register-form')
        </div>
        <div role="tabpanel" class="tab-pane" id="login" style="padding-top: 30px;">
            @include('auth.partials.login-form')
        </div>
    </div>

</div>