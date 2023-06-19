{{-- modal codes --}}
<div id="dormitory-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form action="" id="dormitory-form">
            <input type="hidden" value="store" id="action">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h5 class="modal-title"><span id="form_title_text">Add</span> Customer</h5>
                </div>

             
                <div class="modal-body">
                    <div class="pl-10 pr-10">
                        <div class="row custom-row">
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>First Name <span style="color:red;">*</span></label>
                                   <input type="text" name="customer_first_name" id="customer_first_name" class="form-control">
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="customer_last_name" id="customer_last_name" class="form-control">
                                </div>
                             </div>

                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Student</label>
                                    <input type="text" name="customer_student" id="customer_student" class="form-control">
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address <span style="color:red;">*</span></label>
                                    <input type="text" name="customer_email" id="customer_email" class="form-control">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="customer_phone" id="customer_phone" class="form-control phone-masking" placeholder="(xxx) xxx-xxxx">
                                </div>
                             </div>
                        </div>
                    </div>
                </div> 
        
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="savecustomerBtn"><span id="btn_text">Save</span></button>
                </div> 
              </div>
        </form>
    </div>
  </div>
{{-- end modal codes --}}