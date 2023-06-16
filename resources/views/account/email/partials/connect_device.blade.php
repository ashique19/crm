<!-- Modal -->
<div class="modal fade" id="connectDevices" tabindex="-1" role="dialog" aria-labelledby="connectDevices" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Connect Devices</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="alert warning">Use the following information to connect your email to your phone or third party email software.</div>
             <div class="table-responsive">      
                  <table class="table basic-table table-striped">
                      <tr>
                          <td>Username:</td>
                          <td id="connect_devices-email"></td>
                      </tr>
                      <tr>
                          <td>Password:</td>
                          <td>Use the email account’s password.</td>
                      </tr>      
                      <tr>
                          <td>Incoming Server:</td>
                          <td>mail.{{ $_SERVER['SERVER_NAME'] }}<br>IMAP Port: 993 POP3 Port: 995 </td>
                      </tr>
                      <tr>
                          <td>Incoming Server:</td>
                          <td>mail.{{ $_SERVER['SERVER_NAME'] }}<br>SMTP Port: 465</td>
                      </tr> 
                      <tr>
                          <td colspan="2">*Note: IMAP, POP3, and SMTP require authentication.</td>
                      </tr>      
                  </table>
            </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>