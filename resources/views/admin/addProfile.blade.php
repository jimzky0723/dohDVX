@extends('layouts.app')

@section('content')
    <?php
    $status = session('status');
    $url = url('admin/profiles/create').'/'.$requestName;
    if($method=='update'){
        $url = url('admin/profiles/update/'.$profileId.'/'.$requestName);
    }
    $unique_id = '';
    $fac_province = '';
    $fac_muncity = '';
    $facility_name = '';
    $lname = '';
    $fname = '';
    $mname = '';
    $sitio = '';
    $barangay = '';
    $muncity = '';
    $province = '';
    $dob = '';
    $sex = '';
    $dose_screened = '';
    $dose_date_given = '';
    $dose_age = '';
    $validation = 0;
    $dose_lot_no = '';
    $dose_batch_no = '';
    $dose_expiration = '';
    $dose_AEFI = '';
    $remarks = '';

    if(isset($data)){
        $unique_id = $data->unique_id;
        $fac_province = $data->fac_province;
        $fac_muncity = $data->fac_muncity;
        $facility_name = $data->facility_name;
        $lname = $data->lname;
        $fname = $data->fname;
        $mname = $data->mname;
        $sitio = $data->sitio;
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
                                <td>Fac_Province :</td>
                                <td>
                                    <select name="fac_province" id="fac_province" class="form-control" required>
                                        <option value="">Select Province...</option>
                                        <option {{ ($fac_province==1) ? 'selected': '' }} value="1">Bohol</option>
                                        <option {{ ($fac_province==2) ? 'selected': '' }} value="2">Cebu</option>
                                        <option {{ ($fac_province==3) ? 'selected': '' }} value="3">Negros Oriental</option>
                                        <option {{ ($fac_province==4) ? 'selected': '' }} value="4">Siquijor</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Fac_Municipality/City :</td>
                                <td>
                                    <select name="fac_muncity" id="fac_muncity" class="form-control" required>

                                    </select>
                                </td>
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
                                <td>House #/Street/Sitio/Purok :</td>
                                <td><input type="text" name="sitio" value="{{ $sitio }}" class="lname form-control" required /> </td>
                            </tr>
                            <tr class="has-group">
                                <td>Province :</td>
                                <td>
                                    <select name="province" id="province" class="form-control" required>
                                        <option value="">Select Province...</option>
                                        <option {{ ($province==1) ? 'selected': '' }} value="1">Bohol</option>
                                        <option {{ ($province==2) ? 'selected': '' }} value="2">Cebu</option>
                                        <option {{ ($province==3) ? 'selected': '' }} value="3">Negros Oriental</option>
                                        <option {{ ($province==4) ? 'selected': '' }} value="4">Siquijor</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Municipality/City :</td>
                                <td>
                                    <select name="muncity" id="muncity" class="form-control" required>

                                    </select>
                                </td>
                            </tr>
                            <tr class="has-group">
                                <td>Barangay :</td>
                                <td><input type="text" name="barangay" value="{{ $barangay }}" class="lname form-control" required /> </td>
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
                                <td><input type="date" name="dose_date_given" value="{{ $dose_date_given }}" class="form-control" required /> </td>
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
    @if($province)
        var province = "{{ $province }}";
        filterProvince(province);
        var muncity = "{{ $muncity }}";
        $('#muncity').val(muncity);
    @endif

    @if($fac_province)
        var fac_province = "{{ $fac_province }}";
        filterProvinceF(fac_province);
        var fac_muncity = "{{ $fac_muncity }}";
        $('#fac_muncity').val(fac_muncity);
    @endif

    $('#fac_province').on('change',function(){
        $('.loading').show();
        var province_id = $(this).val();
        filterProvinceF(province_id);
        $('#province').val(province_id);
        filterProvince(province_id);
    });

    $('#fac_muncity').on('change',function(){
        var muncity_id = $(this).val();
        $('#muncity').val(muncity_id);
    });

    function filterProvinceF(province_id)
    {
        $('#fac_muncity').empty();
        var data = getMuncity(province_id);
        jQuery.each(data, function(i,val){
            $('#fac_muncity').append($('<option>', {
                value: val.id,
                text : val.description
            }));

        });
    }

    $('#province').on('change',function(){
        $('.loading').show();
        var province_id = $(this).val();
        filterProvince(province_id);
    });

    function filterProvince(province_id)
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
</script>

<script>
    function validate()
    {
        var age = $('#dose_age').val();
        if(age>8 && age<15){
            $('#validation').val(1);
        }else{
            $('#validation').val(0);
        }
    }
    {{--var dob = '';--}}
    {{--$('#dob').on('keyup',function(){--}}
        {{--dob = $(this).val();--}}
        {{--getAge();--}}
    {{--});--}}

    {{--function getAge()--}}
    {{--{--}}
        {{--var url = "{{ url('param/age') }}";--}}
        {{--if(dob){--}}
            {{--$.ajax({--}}
                {{--url: url+'/'+dob,--}}
                {{--type: 'GET',--}}
                {{--success: function(data){--}}
                    {{--console.log(data);--}}
                {{--},--}}
                {{--error: function (xhr, ajaxOptions, thrownError) {--}}
                    {{--console.log(xhr.status);--}}
                    {{--console.log(thrownError);--}}
                {{--}--}}
            {{--})--}}
        {{--}--}}
    {{--}--}}
</script>
@endsection

