<div class="modal fade" tabindex="-1" role="dialog" id="verify">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color: #00a65a">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Verifying Says:</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong class="text-info">Are you sure you want to verify?</strong>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ asset('admin/verify') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="profileId" value="<?php if(isset($profileId))echo $profileId; ?>">
                    <input type="hidden" name="requestName" value="<?php if(isset($requestName))echo $requestName; ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    <button type="submit" name="verify" class="btn btn-success" ><i class="fa fa-trash"></i> Approve</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="delete">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color: #a63f41">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Verifying Says:</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <strong class="text-danger">Are you sure you want to remove?</strong>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                    isset($requestName) ? $removeRequest = $requestName : $removeRequest = '';
                ?>
                <form action="{{ asset('admin/remove').'/'.isset($requestName) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="profileId" value="<?php if(isset($profileId))echo $profileId; ?>">
                    <input type="hidden" name="requestName" value="<?php if(isset($requestName))echo $requestName; ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                    <button type="submit" name="verify" class="btn btn-danger" ><i class="fa fa-trash"></i> Yes</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="refuse">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color: #00a65a">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Verifying Says:</h4>
            </div>
            <form action="{{ asset('admin/refuse').'/'.isset($requestName) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-success">
                        <strong class="text-success">Are you sure you want to refuse?</strong>
                        <i style="color: #525252">Remarks:</i>
                        <textarea class="form-control" name="remarks" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        isset($requestName) ? $removeRequest = $requestName : $removeRequest = '';
                    ?>
                        <input type="hidden" name="profileId" value="<?php if(isset($profileId))echo $profileId; ?>">
                        <input type="hidden" name="requestName" value="<?php if(isset($requestName))echo $requestName; ?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                        <button type="submit" name="verify" class="btn btn-warning" ><i class="fa fa-trash"></i> Refuse</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->