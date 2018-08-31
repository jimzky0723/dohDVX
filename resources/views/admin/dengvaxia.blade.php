@extends('layouts.app')

@section('content')
    <style>
        th {
            vertical-align: middle !important;
        }
    </style>
    <div class="col-md-12">
        <div class="jim-content">
            @if(Session::has('uploadCount'))
                <div class="alert alert-info">
                    <font class="text-info">
                        <i class="fa fa-check"></i> {{ Session::get('uploadCount') }}
                    </font>
                </div>
            @endif
            @if (Session::has('deng_del'))
                <div class="alert alert-danger">
                    <font class="text-danger">
                        <i class="fa fa-trash"></i> {{ Session::get('deng_del') }}
                    </font>
                </div>
            @endif
            <div class="row">
                <div class="col-md-7">
                    <form class="form-inline" method="POST" action="{{ asset('admin/dengvaxia_list'.'/'.$muncityId) }}" id="searchForm">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="{{ $keyword }}" name="keyword" style="width: 100%" placeholder="first name or last name">
                        </div>
                        <button type="submit" class="btn-sm btn-success">
                            <span class="fa fa-search" aria-hidden="true"></span> Search
                        </button>
                        <button type="submit" name="duplicate" class="btn-sm btn-info">
                            <span class="fa fa-user" aria-hidden="true"></span> {{ $muncityId == 'all' ? 'ALL' : $mun_row->description }}
                        </button>
                        <button type="submit" name="duplicate" value="duplicate" class="btn-sm btn-danger">
                            <span class="fa fa-user" aria-hidden="true"></span> Duplicate
                        </button>
                    </form>
                </div>
                @if(Session::get('auth')->level == 'admin')
                <div class="col-md-5">
                    <form class="form-inline" method="POST" action="{{ URL::to('importExcel').'/'.$muncityId }}" id="searchForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="col-sm-7">
                            <input class="form-control" type="file" name="import_file" style="width: 100%">
                        </div>
                        <button type="submit" class="btn-sm btn-warning">
                            <span class="fa fa-search" aria-hidden="true"></span> Upload
                        </button>
                    </form>
                </div>
                @endif
            </div><br>
            @if(count($records))
                <div class="box">
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <th>identification Number</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Age</th>
                                <th>1st Dose<br/>Screened?</th>
                                <th>1st Dose<br/>Date Given</th>
                                <th>1st Dose<br/>Age</th>
                                <th>1st Dose<br/>Lot #</th>
                                <th>1st Dose<br/>Expiration</th>
                                <th></th>
                            </tr>
                            @foreach($records as $row)
                                <?php $fullname = $row->lname.', '.$row->fname.' '.$row->mname; ?>
                                <tr>
                                    <td>
                                        <a href="#"><font class="title-info" style="@if(isset($duplicate))color: #ff4374;@endif">{{ $result = mb_substr($fullname, 0, 15) }}</font></a><br />
                                        <small class="text-info">
                                            <?php
                                                /*if($bar = \App\Barangay::find($row->barangay_id)){
                                                    $barangay = $bar->description;
                                                } else {
                                                    $barangay = "No Barangay";
                                                }
                                                if($muncityId == 'all'){
                                                    if($mun = \App\Muncity::find($row->muncity_id)){
                                                        $municipality = $mun->description;
                                                    } else {
                                                        $municipality = "No Municipality";
                                                    }
                                                } else {
                                                    $municipality = $mun_row->description;
                                                }
                                                if($pro = \App\Province::find($row->province_id)){
                                                    $province = $pro->description;
                                                } else {
                                                    $province = "No Province";
                                                }*/
                                            ?>
                                            {{ $row->barangay }},
                                            {{ $row->muncity }},
                                            {{ $row->province }}
                                        </small>
                                    </td>
                                    <td>{{ $row->identification_number }}</td>
                                    <td>{{ $row->sex }}</td>
                                    <td>{{ date('M d, Y',strtotime($row->dob)) }}</td>
                                    <td>{{ $row->age }}</td>
                                    <td>{{ $row->first_dose_screened }}</td>
                                    <td>{{ date('M d, Y',strtotime($row->first_dose_date_given)) }}</td>
                                    <td>{{ $row->first_dose_age }}</td>
                                    <td>{{ $row->first_dose_lotNum }}</td>
                                    <td>
                                        <?php $tmp_date = date('M-Y',strtotime($row->first_dose_expiration)); ?>
                                        @if($row->first_dose_expiration==='0000-00-00' || $tmp_date==='Jan-1970')
                                            <span class="text-danger">Not Set</span>
                                        @else
                                            {{ date('M-Y',strtotime($row->first_dose_expiration)) }}
                                        @endif

                                    </td>
                                    <td><a href="#" data-dismiss="modal" id="{{ $row->id }}" onclick="deng_delete($(this))" data-toggle="modal" data-target="#delete_dengvaxia"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    @if(!isset($duplicate))
                    <div class="box-footer clearfix">
                        {{ $records->links() }}
                    </div>
                    @endif
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

    <script>
        function deng_delete(data){
            var id = data.get(0).id;
            $("#dengDelBtn").prop('value', id);
            console.log(id);
        }
    </script>

@endsection

