@extends('layouts.app')

@section('content')
    <?php
    $status = session('status');
    $url = url('admin/profiles/create').'/'.$requestName;
    if($method=='update'){
        $url = url('admin/profiles/update/'.$profileId.'/'.$requestName);
    }
    $unique_id = '';
    $checkup_id = '';
    $list_number = '';
    $facility_name = '';
    $lname = '';
    $fname = '';
    $mname = '';
    $barangay = '';
    $muncity = '';
    $province = '';
    $dob = '';
    $sex = '';
    $dose_screened = '';
    $dose_date_given = '';
    $dose_age = '';
    $validation = '';
    $dose_lot_no = '';
    $dose_batch_no = '';
    $dose_expiration = '';
    $dose_AEFI = '';
    $remarks = '';

    if(isset($data)){
        $unique_id = $data->unique_id;
        $checkup_id = $data->checkup_id;
        $list_number = $data->list_number;
        $facility_name = $data->facility_name;
        $lname = $data->lname;
        $fname = $data->fname;
        $mname = $data->mname;
        $barangay = $data->barangay;
        $muncity = $data->muncity;
        $province = $data->province;
        $dob = $data->dob;
        $sex = $data->sex;
        $dose_screened = $data->dose_screened;
        $dose_date_given = $data->dose_date_given;
        $dose_age = $data->dose_age;
        $validation = $data->validation;
        $dose_lot_no = $data->dose_lot_no;
        $dose_batch_no = $data->dose_batch_no;
        $dose_expiration = $data->dose_expiration;
        $dose_AEFI = $data->dose_AEFI;
        $remarks = $data->remarks;
    }
    ?>
    <style>
        .table-input tr td:first-child {
            background: #f5f5f5;
            text-align: right;
            vertical-align: middle;
            font-weight: bold;
            padding: 3px;
            width:30%;
        }
        .table-input tr td {
            border:1px solid #bbb !important;
        }
    </style>
    <div class="col-md-9">
        <div class="jim-content">
            <h3 class="page-header">
                {{ $title }}</h3>
            <div class="row">
                <div class="col-md-12">
                    @if(isset($message))
                        @if($message == 'saved')
                        <div class="alert alert-success">
                            <font class="text-success">
                                <i class="fa fa-check"></i> 1 {{ ucfirst($requestName) }} successfully added!
                            </font>
                        </div>
                         @endif
                    @endif
                    @if(isset($message))
                        @if($message == 'updated')
                        <div class="alert alert-info">
                            <font class="text-info">
                                <i class="fa fa-check"></i> 1 {{ ucfirst($requestName) }} successfully updated!
                            </font>
                        </div>
                        @endif
                    @endif
                    <form method="POST" class="form-horizontal form-submit" id="form-submit" action="{{ $url }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="unique_id" value="{{ $unique_id }}" />
                        <table class="table-input table table-bordered table-hover" border="1">
                            <tr class="has-group">
                                <td>List Number :</td>
                                <td><input type="text" name="list_number" value="{{ $list_number }}" class="lname form-control" required /> </td>
                            </tr>

                            <tr class="has-group">
                                <td>Facility Name :</td>
                                <td><input type="text" name="facility_name" value="{{ $facility_name }}" class="lname form-control" required /> </td>
                            </tr>

                            <tr class="has-group">
                                <td>First Name :</td>
                                <td><input type="text" name="fname" value="{{ $fname }}" class="fname form-control" required /> </td>
                            </tr>
                            <tr>
                                <td>Middle Name :</td>
                                <td><input type="text" name="mname" value="{{ $mname }}" class="mname form-control" /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>Last Name :</td>
                                <td><input type="text" name="lname" value="{{ $lname }}" class="lname form-control" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>Province :</td>
                                <td>
                                    <select name="province" id="province" class="form-control" required>
                                        <?php $provinceFind = \App\Province::find($province); ?>
                                        <option value="<?php if($provinceFind) echo $provinceFind->id ?>"><?php if($provinceFind) echo $provinceFind->description ?></option>
                                        @foreach($provinces as $prov)
                                            @if( $prov->id != $province )
                                                <option value="{{ $prov->id }}">{{ $prov->description }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Municipality/City :</td>
                                <td>
                                    <select name="muncity" id="muncity" class="form-control" required>
                                        <?php $muncityFind = \App\Muncity::find($muncity); ?>
                                        <option value="<?php if($muncityFind) echo $muncityFind->id ?>"><?php if($muncityFind) echo $muncityFind->description ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Barangay :</td>
                                <td>
                                    <select name="barangay" id="barangay" class="form-control" required>
                                        <?php $barangayFind = \App\Barangay::find($barangay); ?>
                                        <option value="<?php if($barangayFind) echo $barangayFind->id ?>"><?php if($barangayFind) echo $barangayFind->description ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Birth Date :</td>
                                <td><input type="date" name="dob" value="{{ $dob }}" class="form-control" id="dob" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>Sex :</td>
                                <td>
                                    <select name="sex" class="form-control" required>
                                        <option {{ ($sex=='Male' || $sex=='MALE') ? 'selected': '' }}>Male</option>
                                        <option {{ ($sex=='Female' || $sex=='FEMALE') ? 'selected': '' }}>Female</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose Screened :</td>
                                <td>
                                    <select name="dose_screened" class="form-control" required>
                                        <option {{ ($dose_screened=='Yes' || $dose_screened=='YES') ? 'selected': '' }}>Yes</option>
                                        <option {{ ($dose_screened=='No' || $dose_screened=='NO') ? 'selected': '' }}>No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose Date Given :</td>
                                <td>
                                    <div class="form-inline">
                                        <input type="date" name="dose_date_given" id="dose_date_given" value="{{ $dose_date_given }}" class="form-control" required />
                                        <button class="btn btn-primary" type="button" onclick="checkAge();">Validate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose Age :</td>
                                <td><input type="text" readonly name="dose_age" value="{{ $dose_age }}" class="form-control" id="dose_age" onkeyup="validate()" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>Validation within 9-14y/o :</td>
                                <td><input readonly type="text" name="validation" value="{{ $validation }}" class="form-control" id="validation"  required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose Lot #:</td>
                                <td><input type="text" name="dose_lot_no" value="{{ $dose_lot_no }}" class="form-control" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose Batch #:</td>
                                <td><input type="text" name="dose_batch_no" value="{{ $dose_batch_no }}" class="form-control" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose Expiration :</td>
                                <td><input type="date" name="dose_expiration" value="{{ $dose_expiration }}"  class="form-control" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>1st Dose AEFI :</td>
                                <td>
                                    <select name="dose_AEFI" class="form-control" required>
                                        <option {{ ($dose_AEFI=='Yes' || $dose_AEFI=='YES') ? 'selected': '' }}>Yes</option>
                                        <option {{ ($dose_AEFI=='No' || $dose_AEFI=='NO') ? 'selected': '' }}>No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Remarks :</td>
                                <td>
                                    <textarea class="form-control" name="remarks" style="resize: none" rows="5">{{ $remarks }}</textarea>
                                </td>
                            </tr>


                            <tr>
                                <td></td>
                                <td>
                                    <a href="{{ asset('admin/profiles').'/'.$requestName }}" class="btn btn-sm btn-default">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                    @if($method=='create')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-send"></i> Add {{ ucfirst($requestName) }}
                                    </button>
                                    @elseif($method=='update')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i> Update
                                    </button>
                                    <a href="{{ asset('admin/profiles') }}" class="btn btn-sm btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#delete">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                    @endif
                                    @if($requestName == 'pending')
                                    <a href="#" class="btn btn-sm btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#verify">
                                        <i class="fa fa-question-circle"></i> Verify
                                    </a>
                                    <a href="#" class="btn btn-sm btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#refuse">
                                        <i class="fa fa-question-circle"></i> Refuse
                                    </a>
                                    @endif

                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('sidebar.sidebar')
    </div>
@endsection

@section('js')
<script>

    $('#province').on('change',function(){
        var province_id = $(this).val();
        filterMunicipality(province_id);
        filterBarangay(province_id,'province');
    });


    $('#muncity').on('change',function(){
        var municipality_id = $(this).val();
        filterBarangay(municipality_id,'municipality');
    });

    function filterBarangay(id,request)
    {
        $('#barangay').empty();
        var appendId;
        jQuery.each(<?php echo $barangays ?>, function(i,val){
            request == 'municipality' ? appendId = val.muncity_id : appendId = val.province_id;
            if( id == appendId ){
                $('#barangay').append($('<option>', {
                    value: val.id,
                    text : val.description
                }));
            }
        });
    }

    function filterMunicipality(province_id)
    {
        $('#muncity').empty();
        var data = getMuncity(province_id);
        jQuery.each(data, function(i,val){
            $('#muncity').append($('<option>', {
                value: val.id,
                text : val.description
            }));

        });
    }

    function getMuncity(province_id)
    {
        var url = "{{ url('location/muncity') }}";
        var tmp;
        $.ajax({
            url: url+"/"+province_id,
            type: 'get',
            async: false,
            success : function(data){
                tmp = data;
                $('.loading').hide();
            }
        });

        return tmp;
    }

    function checkAge()
    {
        var dob = $("#dob").val();
        var dose_date_given = $("#dose_date_given").val();
        var json = {
            "dob" : dob,
            "date" : dose_date_given,
            "_token" : "<?php echo csrf_token(); ?>",
        };
        var url = "<?php echo asset('getAge') ?>";
        console.log(json);
        $.post(url,json,function(result){
            $("#dose_age").val(result);
            if( result <= 14 && result >= 9 ){
                $("#validation").val('Yes');
            } else {
                $("#validation").val('No');
            }
        });
    }

    $("forms").submit(function(){
        if( $("#validation").val() == '' ){
            alert('Please validate first');
            return false;
        }
    });

</script>

@endsection

