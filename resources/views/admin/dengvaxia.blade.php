@extends('layouts.app')

@section('content')
    <style>
        th {
            vertical-align: middle !important;
        }
    </style>
    <div class="col-md-12">
        <div class="jim-content">
            @if(Session::get('uploadCount'))
                <div class="alert alert-info">
                    <font class="text-info">
                        <i class="fa fa-check"></i> {{ Session::get('uploadCount') }} dengvaxia patient successfully uploaded!
                    </font>
                </div>
                <?php Session::put('uploadCount',false); ?>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <form class="form-inline" method="POST" action="{{ asset('form/so_list') }}" id="searchForm">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ Session::get('keyword') }}" id="inputEmail3" name="keyword" style="width: 100%" placeholder="first name or last name">
                        </div>
                        <button type="submit" class="btn btn-success" id="print" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Printing DTR">
                            <span class="fa fa-search" aria-hidden="true"></span> Search
                        </button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-inline" method="POST" action="{{ URL::to('importExcel') }}" id="searchForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="col-sm-6">
                            <input class="form-control" type="file" name="import_file" style="width: 100%">
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <span class="fa fa-search" aria-hidden="true"></span> Upload
                        </button>
                    </form>
                </div>
            </div><br>
            @if(count($records))
                <div class="box">
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Age</th>
                                <th>1st Dose<br/>Screened?</th>
                                <th>1st Dose<br/>Date Given</th>
                                <th>1st Dose<br/>Age</th>
                                <th>1st Dose<br/>Lot #</th>
                                <th>1st Dose<br/>Batch No.</th>
                                <th>1st Dose<br/>Expiration</th>
                            </tr>
                            @foreach($records as $row)
                                <tr>
                                    <td>
                                        <a href="{{ url('admin/profiles/update') }}"><font class="title-info">{{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}</font></a><br />
                                        <small class="text-info">
                                            <?php
                                                if($bar = \App\Barangay::find($row->barangay_id)){
                                                    $barangay = $bar->description;
                                                } else {
                                                    $barangay = "No Barangay";
                                                }
                                                if($mun = \App\Muncity::find($row->municipality_id)){
                                                    $municipality = $mun->description;
                                                } else {
                                                    $municipality = "No Municipality";
                                                }
                                                if($pro = \App\Province::find($row->province_id)){
                                                    $province = $pro->description;
                                                } else {
                                                    $province = "No Province";
                                                }
                                            ?>
                                            {{ $barangay }},
                                            {{ $municipality }},
                                            {{ $province }}
                                        </small>
                                    </td>
                                    <td>{{ $row->sex }}</td>
                                    <td>{{ date('M d, Y',strtotime($row->dob)) }}</td>
                                    <td>{{ $row->age }}</td>
                                    <td>{{ $row->first_dose_screened }}</td>
                                    <td>{{ date('M d, Y',strtotime($row->first_dose_date_given)) }}</td>
                                    <td>{{ $row->first_dose_age }}</td>
                                    <td>{{ $row->first_dose_lotNum }}</td>
                                    <td>{{ $row->first_dose_batchNum }}</td>
                                    <td>
                                        <?php $tmp_date = date('M-Y',strtotime($row->first_dose_expiration)); ?>
                                        @if($row->first_dose_expiration==='0000-00-00' || $tmp_date==='Jan-1970')
                                            <span class="text-danger">Not Set</span>
                                        @else
                                            {{ date('M-Y',strtotime($row->first_dose_expiration)) }}
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="text-center">
                            {{ $records->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <font class="text-warning">
                        <i class="fa fa-warning"></i> No Profiles Found!
                    </font>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')

@endsection

