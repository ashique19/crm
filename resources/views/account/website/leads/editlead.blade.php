<div class="modal fade" id="leadEditModal" tabindex="-1" role="dialog" aria-labelledby="leadEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leadEditModalLabel"> 
                    Edit Lead
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.website.updateLead')}}" method="post" enctype="multipart/form-data">
                    @csrf()

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <input type="hidden" name="id" id="leadId">
                                <input type="hidden" name="type" value="{{$type}}">
                                <label for="first_name1" class="col-form-label">First name:</label>
                                <input type="text" name="first_name" class="form-control" id="first_name1" required>
                              </div>
                                <div class="form-group">
                                <label for="last_name1" class="col-form-label">Last name:</label>
                                <input type="text" name="last_name" class="form-control" id="last_name1" required>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="email1" class="col-form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email1" required>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="phone1" class="col-form-label">Phone:</label>
                                <input type="text" name="phone" class="form-control phone" id="phone1" required>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="conversion_point1" class="col-form-label">Conversion point:</label>
                                <select name="conversion_point" class="form-control" id="conversion_point1" required>
                                    <option value="phone">Phone</option>
                                    <option value="contact_form">Contact Form</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="status1" class="col-form-label">Status:</label>
                                <select name="status" class="form-control" id="status1" required>
                                    <option value="0">New Lead</option>
                                    <option value="1">Client</option>
                                    <option value="2">Inactive Client</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="notes1" class="col-form-label">Notes:</label>
                                <textarea name="notes" class="form-control" id="notes1"></textarea>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>
