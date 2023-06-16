<!-- Modal -->
<div class="modal fade" id="addEmail" tabindex="-1" role="dialog" aria-labelledby="addEmail" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Email Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('account.cpanel_add_email') }}" method="post">
            @csrf                
            <div class="modal-body">
                <div class="table-responsive">      
                    <table class="table basic-table table-striped">
                        <tr>
                            <td>Email Address:</td>
                            <td>
                                <div class="form-group{{ $errors->has('email')? ' has-danger': '' }}">
                                    <div class="input-group">
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="example">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">{{ '@'.$primaryDomain }}</button>
                                        </span>
                                    </div>
                                    @if($errors->has('email'))
                                        <span class="wrong-error form-control-feedback">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td>
                                <div class="form-group{{ $errors->has('password')? ' has-danger': '' }}">
                                    <input class="form-control-sm" type="password" name="password" value="{{ old('password') }}">
                                    @if($errors->has('password'))
                                        <span class="wrong-error form-control-feedback">{{$errors->first('password')}}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>      
                        <tr>
                            <td>Confirm Password:</td>
                            <td>
                                <div class="form-group{{ $errors->has('password_confirmation')? ' has-danger': '' }}">
                                    <input class="form-control-sm" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    @if($errors->has('password_confirmation'))
                                        <span class="wrong-error form-control-feedback">{{$errors->first('password_confirmation')}}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>                      
                    </table>
                </div>        
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm btn-primary">Add Email Account</button>
            </div>
            <input type="hidden" name="action" value="create">
            </form>
        </div>
    </div>
</div>

<style>
    input[type="text"]#subdomaintwo{
        -webkit-appearance:none!important;
        color:#222;
        text-align:left;
        width:150px;
        border-left:0px;
        margin:0 0 0 -7px;
        background:white;
    }
    input[type="text"]#subdomain{
        text-align:right;
        -webkit-appearance:none!important;
        border-right:0px;
        outline:none;
    }
</style>