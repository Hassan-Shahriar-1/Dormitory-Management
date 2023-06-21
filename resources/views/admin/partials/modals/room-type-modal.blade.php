{{-- modal codes --}}
<div id="room-type-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form action="" id="room-type-form">
            <input type="hidden" value="store" id="action">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <input type="hidden" name="id" id="id">
                  <h5 class="modal-title"><span id="form_title_text">Add</span> Dormitory</h5>
                </div>

             
                <div class="modal-body">
                    <div class="pl-10 pr-10">
                        <div class="row custom-row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        Status
                                        <div class="material-switch pull-right">
                                            <input id="is_active" value="1" name="status" type="checkbox"/>
                                            <label for="is_active" class="label-success"></label>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>Name <span style="color:red;">*</span></label>
                                   <input type="text" name="name" id="room_type_name" class="form-control">
                               </div>
                            </div>
                             

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description </label>
                                    <input type="text" name="description" id="description" class="form-control">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fee </label>
                                    <input type="text" name="fee" id="fee" class="form-control">
                                </div>
                             </div>
                        </div>
                    </div>
                </div> 
        
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="saveroomTypeBtn"><span id="btn_text">Save</span></button>
                </div> 
              </div>
        </form>
    </div>
  </div>
{{-- end modal codes --}}