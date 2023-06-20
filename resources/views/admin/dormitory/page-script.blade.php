<script>

    @if($showCreateModal)
        $(document).ready(function(){
            $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn');
            campaignCreateActions();
            $("#dormitory-modal").modal('show');
        });
    @endif

    //need condition here
        $(document).ready(function(){
            $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn');
            campaignCreateActions();
            $("#campaign-modal").modal('show');
        });



    function campaignCreateActions(){
        $(".existing_sponsor_section").show();
        $("#sponsor_type").prop("selectedIndex", 0);
        setTimeout(() => {
            var type = $("#sponsor_type").val();
            showSponsorFields(type)
        }, 200);
    }


    function showSponsorFields(type){
        if(type === 'new'){
            $(".sponsor_type_existing").hide();
            $("#sponsor_user_id").val('');
            $(".sponsor_type_new").show();
        }else if(type === 'existing'){
            $("#sponsor_name, #sponsor_phone, #sponsor_email, #sponsor_user_name, #sponsor_password").val('');
            $(".sponsor_type_new").hide();
            $("#sponsor_user_id").attr('disabled', false);
            $(".sponsor_type_existing").show();
        }
    }

    $(document).on('change', "#sponsor_type", function(){
        var type = $(this).val();
       showSponsorFields(type)
    })

    $('.selectPicker').select2({
        allowClear: true,
        placeholder: "Select your product..."
    });


    var el_form = $("#campaign-form");
    var el_action = $("#action");
    var el_form_modal = $("#campaign-modal");
    var el_modal_title = $("#form_title_text");
    var el_modal_wizard_title = $('#campaign-modal .wizard_title');
    var el_modal_btn = $("#btn_text");

    // trigger campaign modal
    $(document).on("click", "#AddNewBtn", function(){
        //removeErrorClass();
        campaignCreateActions();
        $('#submitCampaignBtn').removeClass('campaignEditButtonConfirm').addClass('submitCampaignBtn')
        formEmpty();
        loadLocalData();

        $('.wizard_title').text('Dormitory');
        $('.setup-content').hide();
        $("#step-1").show();
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


    // edit campaign
    function closeCampaign(id){
        $("#warning_item_id").val(id);
        $("#warning_action").val('close');
        showWarningMessage('Are you sure you want to close this?');
    }

     // edit campaign
     function openCampaign(id){
         $("#warning_item_id").val(id);
         $("#warning_action").val('open');
         showWarningMessage('Are you sure you want to open this?');
    }
     // invoice campaign
     function invoiceCampaign(id){
         $("#warning_item_id").val(id);
         $("#warning_action").val('invoice');
         showWarningMessage('Are you sure you want to change invoice status?');
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



    // validate signup form on keyup and submit
    el_form.validate({
        rules: {
            school_id: {
                required: true,
                maxlength: 255
            },
            group_id: {
                required: true,
                maxlength: 255
            },
            sponsor_user_id: {
                required: {
                    depends:function(){
                        if ($('#sponsor_type').val()==='existing'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
            },
            sale_type: {
                required: true,
                maxlength: 255
            },
            sponsor_name: {
                required: {
                    depends:function(){
                        if ($('#sponsor_type').val()==='new'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                maxlength: 255,
                minlength: 3
            },
            sponsor_phone: {
                required: {
                    depends:function(){
                        if ($('#sponsor_type').val()==='new'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                maxlength: 16
            },
            sponsor_email: {
                email: true,
                required: {
                    depends:function(){
                        if ($('#sponsor_type').val()==='new'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                maxlength: 255
            },

            start_date: {
                required: true,
                maxlength: 14
            },

            student_count: {
                required: true,
                min: 0
            },

            "product_id[]": {
                required: true
            },
            sponsor_password: {
                required: {
                    depends:function(){
                        if ($('#sponsor_type').val()==='new'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                minlength: 6,
                maxlength: 100
            },
            sponsor_user_name: {
                required: {
                    depends:function(){
                        if ($('#sponsor_type').val()==='new'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                minlength: 6,
                maxlength: 100
            },

            credit_card_rate: {
                required: true,
                min: 0,
                max: 100
            },
            transaction_fee: {
                required: true,
                min: 0,
                max: 100
            }
        },
        messages: {
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
        order: [[2,'desc']],
        lengthMenu: [[5, 10, 20, 50, 75, 100, 200, 500, 1000, -1], [5, 10, 20, 50, 75, 100, 200, 500, 1000, 'All']],
        pageLength: 20,
        ajax: {
            url:"{{route('dormitory.list') }}",
            type: "GET",
            "data": function (data) {
                data.is_closed = '';
                data.is_donation = '';
            },
            cache: true,
            complete: function (data) {
                const logsResponse = data['responseJSON'];
                console.log(logsResponse.totalRow);
                const {
                    total_student_count,
                    total_sale_amount,
                    total_total_roundup,
                    average_credit_card_rate,
                    average_transaction_fee,
                    total_total_donation

                } = logsResponse?.totalRow;

                $(".total_student_count").html(total_student_count);
                $(".total_sale_amount").html(total_sale_amount);
                $(".total_total_roundup").html(total_total_roundup);
                $(".average_credit_card_rate").html(average_credit_card_rate);
                $(".average_transaction_fee").html(average_transaction_fee);
                $(".total_total_donation").html(total_total_donation);
            },

        },
        globalSearch: true,

        columns: [

            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'name', name: 'name',orderable:true, searchable:true},
           
            {data: 'distributor_name', name:'distributor_name',searchable:false,orderable:true},
            
            {data: 'school_name', name: 'school_name',orderable:true},
           
            {data: 'access_code', name: 'access_code'},
            {data: 'sponsor_name', name: 'sponsor_name',orderable:false},
            {data: 'student_count', name: 'student_count'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'sale_type', name: 'sale_type'},
            {data: 'total_sale', name: 'total_sale'},
            {data: 'total_donation', name: 'total_donation'},
            {data: 'total_roundup', name: 'total_roundup'}, 

            
                {data: 'credit_card_rate', name: 'credit_card_rate'},
                {data: 'transaction_fee', name: 'transaction_fee'}
           

        ],
        columnDefs: [{
            target:0,
            orderable:false
        }],
        dom: 'lBfrtip',
            "initComplete": function(settings, json) {
                var isEmpty = table.rows().count() === 0;
                if(isEmpty){
                    $('tfoot').hide();
                }else{
                    $('tfoot').show();
                }
            }
    });
</script>

