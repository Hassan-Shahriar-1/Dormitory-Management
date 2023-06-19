{{-- global warning modal --}}
<div class="modal fade global-warning error" id="warning_modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa fa-info-circle text-danger fa-3x"></i>
                <p class="warning_message"> Are you sure you want to delete this record? </p>
                <input type="hidden" name="item_id" id="warning_item_id">
                <input type="hidden" name="warning_action" id="warning_action">
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">No</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary target" id="warning_ok">Yes
                </button>
            </div>
        </div>
    </div>
</div>
{{-- end global warning modal  --}}

<!-- global alert message START -->
<div class="modal fade alert global-warning" role="dialog" id="alert-modal" style="z-index: 99999">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <div id="alert-error-msg">
                    <i class="fa fa-exclamation-triangle fa-3x text-danger"></i>
                    <p class="text-danger"></p>
                </div>

                <div id="alert-success-msg">
                    <i class="fa fa-check-circle text-success fa-3x"></i>
                    <p class="text-success"></p>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" id="alert-ok">ok</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" role="dialog" id="detailsModal" style="z-index: 99999">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Description</h5>
            </div>
            <div class="modal-body text-center">
                <div id="detailsBody">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- global alert message End -->




<div class="modal fade" role="dialog" id="showDetailsModal" style="z-index: 99999">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Details</h5>
            </div>
            <div class="modal-body text-center">
                    <div class="table-responsive">
                        <table class="table table-bordered vertical-table" id="showDetailsBody">
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                            <tr>
                                <th>fdgdfg</th>
                                <td>gfgdf</td>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>


