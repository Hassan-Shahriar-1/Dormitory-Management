<script>
//show add room type modal part on pass param
    @if($showCreateModal)
        $(document).ready(function(){
            $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn');

            $("#student-dormitory-modal").modal('show');
        });
    @endif

    //form part
    var el_form = $("#student-dormitory-form");
    var el_action = $("#action");
    var el_form_modal = $("#student-dormitory-modal");
    var el_modal_title = $("#form_title_text");
    var el_modal_wizard_title = $('#student-dormitory-modal .wizard_title');
    var el_modal_btn = $("#btn_text");

///ajax saving  data
    $(document).on("click", "#savestudentBtn", function(){
        var formData = new FormData($('#student-dormitory-form')[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            data: formData,
            url: "{{ route('student.dormitory.store') }}",
            type: "POST",
            processData: false,
            contentType: false,
            success: function (data) {
                el_form_modal.modal('hide');
                formEmpty();

                table.draw();
            },

            error: function (data) {
                showErrorMessage(data.responseJSON.message)
            }
        });
        el_form_modal.modal('hide');
        formEmpty();
        
    })

    // trigger campaign modal
    $(document).on("click", "#AddNewBtn", function(){
        $('#savestudentBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn')
        formEmpty();
        loadLocalData();

        $('.wizard_title').text('Student Dormitory');
        $('.setup-content').hide();
        el_action.val('store');
        el_modal_title.text('Add');
        el_modal_btn.text('Save');
        el_form_modal.modal('show');
    });



     // delete dormitory
     function deleteStudentDormitory(id){
        $("#warning_item_id").val(id);
         $("#warning_action").val('delete');
        $("#warning_modal").modal('show');
    }


        function loadRoomTypeFormData(data)
        {
            $("#id").val(data.id);
            $("#student_address").val(data.student.address);
            $("#first_name").val(data.student.first_name);
            $("#last_name").val(data.student.last_name);
            $('#room_id').val(data.room_id)
        }

        $(document).on("click", ".campaignEditButtonConfirm", function(){
            $('#campaign-modal').hide();
            submitCampaignFormData();
        });



    function editStudentDormitory(id){

        el_action.val('update');
        el_modal_title.text('Edit');
        el_modal_btn.text('Update');

        $.ajax({
            url: "{{ url('admin/room/room-type') }}/"+id,
            type: "GET",
            success: function (data) {
                loadRoomTypeFormData(data.data)
                el_form_modal.modal('show')
            },

            error: function (data) {
                showErrorMessage('Data fetch Failed.')
            }
        });
    }
 

    $(document).on("click", "#warning_ok", function(){

        var id = $("#warning_item_id").val();      
        $.ajax({
            data: {'_token':'{{ csrf_token() }}'},
            url: "{{ url('admin/student/dormitory/delete') }}/" +id,
            type: "DELETE",
            dataType:"json",
            success: function (data) {
                table.draw();
            },

            error: function (data) {
                showErrorMessage('Action Failed.')
            }
        });
    });


    function loadLocalData() {
        var data = localStorage.campaign;
        console.log(data);
        if(!data) return false;
        data = $.parseJSON(data);

        $.each( data, function( key, value ) {
            var element = el_form.find('#'+key);
            if(element.length) {

                var type = element.attr('type');
                if(type == 'checkbox') {
                    element.prop("checked", value);
                } else {
                    el_form.find('#'+key).val(value)
                }

            }
        });
    }

    // empty student form fields
    function formEmpty(){
        //removeErrorClass();
        el_action.val('store');

    }

    $(document).on("click", ".submitCampaignBtn", function(e){
        e.preventDefault();
        $("#campaign-warning").modal('show');
    });

   

    $(document).on("click", "#accept_btn", function(){
        submitCampaignFormData();
    });



    $('div.setup-panel div.stepwizard-step:first-child a').trigger('click');

    var table = $('.student-dormitory-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[3,'asc']],
        lengthMenu: [[5, 10, 20, 50, 75, 100, 200, 500, 1000, -1], [5, 10, 20, 50, 75, 100, 200, 500, 1000, 'All']],
        pageLength: 20,
        ajax: {
            url:"{{route('student.dormitory.list') }}",
            type: "GET",
            cache: true,
        },
        globalSearch: true,

        columns: [
            {data: 'action', name: 'action'},  
            {data: 'name', name: 'name', orderable: true, searchable: true},           
            {data: 'address', name:'address',searchable:true,orderable:true},
            {data: 'room_number', name: 'room_number',orderable:true, searchable:true},
            {data: 'dormitory_name', name: 'dormitory_name',orderable:true},
            {data: 'room_type_name', name: 'room_type_name',orderable:false},
            {data: 'status', name: 'status',orderable:false},       
        ],
        columnDefs: [{
            target:0,
            orderable:false
        }],
        dom: 'lBfrtip',
    });

</script>

