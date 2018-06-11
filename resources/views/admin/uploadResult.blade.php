@extends('layouts.app')

@section('content')
    <style>
        .loadingbar {
            color:#00acd6;
            font-style: italic;
            font-weight: bold;
            margin-top: 0px;
        }
        .progress {
            margin-bottom: 5px;
        }
        .file {
            visibility: hidden;
            position: absolute;
        }
        th {
            vertical-align: middle !important;
        }
    </style>
    <div class="col-md-9">
        <div class="jim-content">
            <h3 class="page-header">
                <div class="pull-right">
                    <a href="{{ url('admin/upload/profiles') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-file-excel-o"></i> Upload Data
                    </a>
                </div>
                Upload Result: {{ $upload_muncity }}</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-sm-4 col-xs-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">PROFILE ADDED</span>
                                <span class="info-box-number">{{ number_format($count_added) }}</span>
                                <div class="progress">
                                    <div class="progress-bar profilePercentageBar"></div>
                                </div>
                                <span class="progress-description"></span>
                            </div><!-- /.info-box-content -->
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-12">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">PROFILE UPDATED</span>
                                <span class="info-box-number">{{ number_format($count_updated) }}</span>
                                <div class="progress">
                                    <div class="progress-bar profilePercentageBar"></div>
                                </div>
                                <span class="progress-description"></span>
                            </div><!-- /.info-box-content -->
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-user-times"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">NOT UPLOADED</span>
                                <span class="info-box-number">{{ number_format($count_error) }}</span>
                                <div class="progress">
                                    <div class="progress-bar profilePercentageBar"></div>
                                </div>
                                <span class="progress-description"></span>
                            </div><!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                @if($count_error>0)
                <br />
                <div class="col-sm-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Lastname</th>
                                <th>Barangay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c=1;?>
                            @foreach($error_list as $row)
                            <tr>
                                <td>{{ $c++ }}</td>
                                <td>{{ $row[0] }}</td>
                                <td>{{ $row[1] }}</td>
                                <td>{{ $row[2] }}</td>
                                <td>{{ $row[3] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('sidebar.sidebar')
    </div>
@endsection

@section('js')

@endsection