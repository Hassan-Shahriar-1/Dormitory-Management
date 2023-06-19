{{-- modal codes --}}
<div id="sponsor-modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form action="" id="sponsor-form">
            <input type="hidden" value="store" id="action">
            <input type="hidden" value="" name="id" id="id">
            <input type="hidden" value="" name="user_id" id="user_id">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h5 class="modal-title"><span id="form_title_text">Add</span> Sponsor</h5>
                </div>

                <div class="modal-body">
                    <div class="pl-10 pr-10">
                        <div class="row custom-row">
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>First Name <span style="color:red;">*</span></label>
                                   <input type="text" name="first_name" id="first_name" class="form-control">
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name<span style="color:red;">*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address <span style="color:red;">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone<span style="color:red;">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control phone-masking" placeholder="(xxx) xxx-xxxx">
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username <span style="color:red;">*</span></label>
                                    <input type="text" autocomplete="new-username" name="user_name" id="user_name" class="form-control">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password <span style="color:red;">*</span></label> 
                                    <div class="input-icon">
                                        <input autocomplete="new-password" type="password" name="password" id="password" class="form-control">
                                        <i class="fa fa-eye-slash toggle-password"></i>
                                    </div>
                                </div>
                             </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>School</label>
                                    {{-- <select name="school_id" id="school_id" class="form-control">
                                        <option value="" selected>Select</option>
                                        @foreach($schools as $school)
                                        <option value="{{$school->id}}">{{$school->name}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="savesponsorBtn"><span id="btn_text">Save</span></button>
                </div>
              </div>
        </form>
    </div>
  </div>
{{-- end modal codes --}}
