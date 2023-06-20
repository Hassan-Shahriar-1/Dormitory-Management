{{-- modal codes --}}
<div id="dormitory-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form action="" id="dormitory-form">
            <input type="hidden" value="store" id="action">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h5 class="modal-title"><span id="form_title_text">Add</span> Dormitory</h5>
                </div>

             
                <div class="modal-body">
                    <div class="pl-10 pr-10">
                        <div class="row custom-row">
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>Name <span style="color:red;">*</span></label>
                                   <input type="text" name="name" id="dormitory_name" class="form-control">
                               </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type" class="form-control">
                                        <option value="boys">Boys</option>
                                        <option value="girls">Girls</option>
                                    </select>
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Adress <span style="color:red;">*</span></label>
                                    <input type="text" name="address" id="address" class="form-control">
                                </div>
                             </div>
                        </div>
                    </div>
                </div> 
        
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="savedormitoryBtn"><span id="btn_text">Save</span></button>
                </div> 
              </div>
        </form>
    </div>
  </div>
{{-- end modal codes --}}