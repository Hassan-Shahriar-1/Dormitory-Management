<script>
//show add room type modal part on pass param
    @if($showCreateModal)
        $(document).ready(function(){
            $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn');

            $("#room-type-modal").modal('show');
        });
    @endif

    //form part
    var el_form = $("#room-type-form");
    var el_action = $("#action");
    var el_form_modal = $("#room-type-modal");
    var el_modal_title = $("#form_title_text");
    var el_modal_wizard_title = $('#room-type-modal .wizard_title');
    var el_modal_btn = $("#btn_text");

///ajax saving room type data
    $(document).on("click", "#saveroomTypeBtn", function(){
        var formData = new FormData($('#room-type-form')[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            data: formData,
            url: "{{ route('room.type.store') }}",
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
        $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn')
        formEmpty();
        loadLocalData();

        $('.wizard_title').text('Dormitory');
        $('.setup-content').hide();
        el_action.val('store');
        el_modal_title.text('Add');
        el_modal_btn.text('Save');
        el_form_modal.modal('show');
    });



     // delete dormitory
     function deleteRoomType(id){
        $("#warning_item_id").val(id);
         $("#warning_action").val('delete');
        $("#warning_modal").modal('show');
    }


        function loadRoomTypeFormData(data)
        {

            $("#id").val(data.id);
            $("#room_type_name").val(data.name);
            $("#description").val(data.description);
            $("#fee").val(data.fee);
        }

        $(document).on("click", ".campaignEditButtonConfirm", function(){
            $('#campaign-modal').hide();
            submitCampaignFormData();
        });



    function editRoomType(id){

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
            url: "{{ url('admin/room/room-type-delete') }}/" +id,
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

    var table = $('.room-type-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[1,'asc']],
        lengthMenu: [[5, 10, 20, 50, 75, 100, 200, 500, 1000, -1], [5, 10, 20, 50, 75, 100, 200, 500, 1000, 'All']],
        pageLength: 20,
        ajax: {
            url:"{{url('admin/room/type-list-ajax') }}",
            type: "GET",
            cache: true,
        },
        globalSearch: true,

        columns: [
            {data: 'action', name: 'action'},  
            {data: 'name', name: 'name', orderable: true, searchable: true},           
            {data: 'description', name:'description',searchable:true,orderable:true},
            {data: 'fee', name: 'fee',orderable:true, searchable:true},
            {data: 'status', name: 'status',orderable:true},
            {data: 'created_at', name: 'created_at',orderable:false},       
        ],
        columnDefs: [{
            target:0,
            orderable:false
        }],
        dom: 'lBfrtip',
    });


</script>

