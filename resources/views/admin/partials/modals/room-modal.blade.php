{{-- modal codes --}}
<div id="room-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form action="" id="room-form">
            <input type="hidden" value="store" id="action">
            <input type="hidden" value="" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h5 class="modal-title"><span id="form_title_text">Add</span> Room</h5>
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
                                   <label>Room Number <span style="color:red;">*</span></label>
                                   <input type="text" name="room_number" id="room_number" class="form-control">
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No of beds<span style="color:red;">*</span></label>
                                    <input type="number" name="number_of_beds" id="number_of_beds" class="form-control">
                                </div>
                             </div>   


                             <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Room Type<span style="color:red;">*</span></label>
                                        <select name="room_type_id" id="room_type_id" class="form-control">

                                            @foreach($modalData['types'] as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dormitory <span style="color:red;">*</span></label>
                                        <select name="dormitory_id" id="dormitory_id" class="form-control">
                                            @foreach($modalData['dormitories'] as $dormitory)
                                            <option value="{{$dormitory->id}}">{{$dormitory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description <span style="color:red;">*</span></label>
                                        <textarea name="description" id="description" rows="4" cols="50">write description</textarea>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="saveroomBtn"><span id="btn_text">Save</span></button>
                </div>
              </div>
        </form>
    </div>
  </div>
{{-- end modal codes --}}
