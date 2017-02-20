<div class="modal fade" id="authentication" tabindex="-1" role="dialog" aria-labelledby="authentication">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="authentication">REGISTER / LOGIN</h4>
            </div>
            <div class="modal-body">
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
            </div>
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>