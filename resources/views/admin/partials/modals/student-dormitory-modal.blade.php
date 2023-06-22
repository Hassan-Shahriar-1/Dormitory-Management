{{-- modal codes --}}
<div id="student-dormitory-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form action="" id="student-dormitory-form">
            <input type="hidden" value="store" id="action">
            <input type="hidden" value="" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h5 class="modal-title"><span id="form_title_text">Add</span> Student Dormitory</h5>
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
                                   <label>Student First Name <span style="color:red;">*</span></label>
                                   <input type="text" name="first_name" id="first_name" class="form-control">
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>Student Last Name <span style="color:red;">*</span></label>
                                   <input type="text" name="last_name" id="last_name" class="form-control">
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>Student Address <span style="color:red;">*</span></label>
                                   <input type="text" name="address" id="student_address" class="form-control">
                               </div>
                            </div>


                             <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Room<span style="color:red;">*</span></label>
                                        <select name="room_id" id="room_id" class="form-control">

                                            @foreach($roomList as $room)
                                            <option value="{{$room->id}}">{{$room->room_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                             </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="savestudentBtn"><span id="btn_text">Save</span></button>
                </div>
              </div>
        </form>
    </div>
  </div>
{{-- end modal codes --}}
