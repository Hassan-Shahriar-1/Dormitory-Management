<script>

    @if($showCreateModal)
        $(document).ready(function(){
            $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn');

            $("#dormitory-modal").modal('show');
        });
    @endif

    //need condition here
        $(document).ready(function(){
            $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn');
            $("#campaign-modal").modal('show');
        });



    //form part
    var el_form = $("#dormitory-form");
    var el_action = $("#action");
    var el_form_modal = $("#dormitory-modal");
    var el_modal_title = $("#form_title_text");
    var el_modal_wizard_title = $('#dormitory-modal .wizard_title');
    var el_modal_btn = $("#btn_text");

    $(document).on("click", "#savedormitoryBtn", function(){
        var formData = new FormData($('#dormitory-form')[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            data: formData,
            url: "{{ route('dormitory.store') }}",
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



     // delete campaign
     function deleteCampaign(id){
        $("#warning_item_id").val(id);
         $("#warning_action").val('delete');
        $("#warning_modal").modal('show');
    }


        function loadCampaignFormData(data){
            $("#sponsor_user_id").val(data.user_id);
            $("#id").val(data.id);
            $("#school_id").val(data.school_id);
            $("#group_id").val(data.group_id);
            $("#sale_type").val(data.sale_type);
            $("#student_count").val(data.student_count);
            $("#sponsor_name").val(data.user.first_name +' '+data.user.last_name);
            $("#sponsor_phone").val(formatUSNumber(data.user.phone));
            $("#sponsor_email").val(data.user.email);
            $("#start_date").val(data.start_date);
            $("#internal_notes").val(data.internal_notes);
            $("#product_id").val(data.product_ids).trigger('change');
            $("#credit_card_rate").val(data.credit_card_rate);
            $("#transaction_fee").val(data.transaction_fee);
            $('#sponsor_user_name').val(data.user.user_name);
            $('#sponsor_password').val(data.user.sponsor.password);
        }

        $(document).on("click", ".campaignEditButtonConfirm", function(){
            $('#campaign-modal').hide();
            submitCampaignFormData();
        });


        function editCampaign(id,type){

            $(".existing_sponsor_section").hide();
            $("#sponsor_user_id").attr('disabled', true);

            el_action.val('update');
            el_modal_title.text('Edit');
            el_modal_btn.text('Update');
            $('#distributor_notify').hide();
            //$('#div_sponsor_password').hide();
            //$('#div_sponsor_user_name').hide();
            $('#submitCampaignBtn').removeClass('submitCampaignBtn')
            $('#submitCampaignBtn').addClass('campaignEditButtonConfirm');
            $('#sponsor_password').rules('remove');
            $('#sponsor_user_name').rules('remove');
            el_form_modal.modal('show');

            $('.wizard_title').text('Campaign');
            $('.setup-content').hide();
            $("#step-1").show();

            var url='';
            switch (type){
                case 'campaign':
                    url='{{url('admin/campaigns')}}/'+id;
                    break;
                default:
                    showErrorMessage('No Details found');
            }
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    loadCampaignFormData(data);
                },

                error: function (data) {
                    showErrorMessage('Data fetch Failed.')
                }
            });
        }
 

    $(document).on("click", "#warning_ok", function(){

        var id = $("#warning_item_id").val();
        var action = $("#warning_action").val();
        var url = " {{route('home') }}";
        url = url.replace(':id', id);
        var method = 'GET';
        var data = '';
        if(action === 'delete') {
            url = "{{route('home') }}";
            method = 'DELETE';
            data = {id:id, '_token':'{{ csrf_token() }}'};
        } else if(action === 'invoice') {
            url = "{{route('home') }}";
            url = url.replace(':id', id);
        }
        $.ajax({
            data: data,
            url: url,
            type: method,
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
        el_form.find('input, textarea, select:not(#sponsor_type)').val('');
        $("#product_id").val('').trigger('change');
    }



    // validate form on keyup and submit
    el_form.validate({
        rules: {
            name: {
                required: true,
                maxlength: 60
            },
            type: {
                required: true,
            },
            address: {
                required: false,
                maxlength: 255
            },
        },
        messages: {
            name: 'name required',
            type: 'Please select a type',
        }
    });

    // student save action
    $(document).on("click", ".submitCampaignBtn", function(e){
        e.preventDefault();
        $("#campaign-warning").modal('show');
    });

    function submitCampaignFormData(){

        $("#campaign-warning").modal('hide');

        if(el_form.valid()){
            var formData = new FormData(el_form[0]);
            formData.append('_token', '{{ csrf_token() }}');

            var id=$('#id').val();

            $.ajax({
                data: formData,
                url: "{{route('home',':id') }}",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    if(data.limit){
                        showErrorMessage('Campaign Creation Limit Exceeded');
                    }else if (data.different_role) {
                        showErrorMessage('Email already in use.');
                    }else{
                    el_form_modal.modal('hide');
                    el_form[0].reset();
                    $("#product_id").val("").trigger("change");
                    table.draw();
                    localStorage.removeItem('campaign');
                    setTimeout(() => {
                        $('.wizard_title').text('Campaign');
                        $('.setup-content').hide();
                        $("#step-1").show();
                    }, 1000);
                }
                },
            //
                error: function (data) {
                    data=JSON.parse(data.responseText);
                    console.log(data);
                    if(data.errors){
                        var errors=Object.values(data.errors);
                        showErrorMessage(errors[0]);
                    }else{
                        if(data.message) {
                            showErrorMessage(data.message);
                        } else {
                            showErrorMessage('Campaign Creation Failed.');
                        }
                    }
                }
            });
        }else{
            return false;
        }
    }


    $(document).on("click", "#accept_btn", function(){
        submitCampaignFormData();
    });


    var navListItems = $('div.setup-panel div a'),
            allContainers = $('.setup-content'),
            allPrevBtn = $('.prevBtn'),
            allNextBtn = $('.nextBtn'),
            saveCloseBtn = $('.saveCloseBtn');


    allContainers.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this),
                $parent = $item.closest('.stepwizard-step');
        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allContainers.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
            let hrefValue = $item.attr('href');
            if(hrefValue == '#step-3'){
                $('#form_title_text').text('')
                el_modal_wizard_title.html('Add '+$parent.find("p").text()+'<p class="mb-0 small" >This is where you set up the convenience fee to charge customers that uses a credit or debit card. Keep in mind that STRIPE charges you 2.9% + .30 per transaction.</p>');
            }else{
                el_modal_wizard_title.html($parent.find("p").text());
            }
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepId = $(curStep).attr('id'),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");

        var fields = el_form.find('#'+curStepId).find(":input", ":select");
        if (fields.valid()) {
            nextStepWizard.removeAttr('disabled').trigger('click');
        }
    });

    allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        prevStepWizard.trigger('click');
    });

    saveCloseBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepId = $(curStep).attr('id'),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");

        var fields = el_form.find('#'+curStepId).find(":input", ":select");
        if (fields.valid()) {

            var object = {};
            formData = new FormData(document.getElementById("campaign-form"));
            formData.forEach((value, key) => object[key] = value);

            if(el_form.find("input[name='is_active']").is(":checked")) {
                object.is_active = el_form.find("input[name='is_active']").is(":checked");
            }
            localStorage.campaign = JSON.stringify(object);

            el_form_modal.modal('hide');
        }
    });

    $('div.setup-panel div.stepwizard-step:first-child a').trigger('click');

    var table = $('.dormitory-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[1,'asc']],
        lengthMenu: [[5, 10, 20, 50, 75, 100, 200, 500, 1000, -1], [5, 10, 20, 50, 75, 100, 200, 500, 1000, 'All']],
        pageLength: 20,
        ajax: {
            url:"{{route('dormitory.list') }}",
            type: "GET",
            cache: true,
        },
        globalSearch: true,

        columns: [
            {data: 'key', name: 'key', orderable: false, searchable: true}, 
            {data: 'name', name: 'name', orderable: true, searchable: true},           
            {data: 'address', name:'address',searchable:true,orderable:true},
            {data: 'type', name: 'type',orderable:true, searchable:true},
            {data: 'status', name: 'status',orderable:true},
            {data: 'created_at', name: 'created_at',orderable:false},
            {data: 'action', name: 'action'},        
        ],
        columnDefs: [{
            target:0,
            orderable:false
        }],
        dom: 'lBfrtip',
    });


</script>

