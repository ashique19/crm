<!-- Modal -->
<div class="modal fade" id="changeEmailPassword" tabindex="-1" role="dialog" aria-labelledby="changeEmailPassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Email Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            

            <form action="{{ route('account.cpanel_email_change_password') }}" id="change-password" method="post">
            @csrf
            <input type="hidden" name="email" value="">
            <div class="modal-body">
                <div class="table-responsive">      
                    <table class="table basic-table table-striped">
                        <tr>
                            <td>Email Address:</td>
                            <td id="edit_email-email"></td>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>