@extends('layouts.app')

@section('content')
    <style>
        th {
            vertical-align: middle !important;
        }
    </style>
    <div class="col-md-12">
        <div class="jim-content">

            <div class="pull-right">
                <form action="{{ asset('admin/profiles').'/'.$requestName }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="col-sm-4 form-group">
                        <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="Search here">
                    </div>
                    &nbsp;
                    <button class="btn btn-sm btn-warning" type="submit">
                        <i class="fa fa-search"></i> Filter Result
                    </button>
                    <a href="{{ asset('admin/profiles/create').'/'.$requestName }}" class="btn btn-sm btn-info">
                        <i class="fa fa-user-plus"></i> Add {{ ucfirst($requestName) }}
                    </a>
                    <a href="{{ asset('admin/upload').'/'.$requestName }}" class="btn btn-sm btn-success">
                        <i class="fa fa-file-excel-o"></i> Upload Data
                    </a>
                    @if($requestName == 'profiles')
                    <a href="{{ asset('admin/profiles/pending') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-exclamation"></i> Pending
                    </a>
                    @endif
                </form>
            </div>

            <h3 class="page-header">
                {{ ucfirst($requestName) }} List
            </h3>
            @if(count($records))
                @if(Session::get('verified'))
                    <div class="alert alert-info">
                        <?php Session::put('verified',false); ?>
                        <font class="text-info">
                            <i class="fa fa-check"></i> 1 {{ ucfirst($requestName) }} successfully verified!
                        </font>
                    </div>
                @endif
                @if(Session::get('remove'))
                    <div class="alert alert-danger">
                        <?php Session::put('remove',false); ?>
                        <font class="text-danger">
                            <i class="fa fa-check"></i> 1 {{ ucfirst($requestName) }} successfully deleted!
                        </font>
                    </div>
                @endif
                @if(Session::get('refuse'))
                    <div class="alert alert-warning">
                        <?php Session::put('refuse',false); ?>
                        <font class="text-warning">
                            <i class="fa fa-check"></i> 1 {{ ucfirst($requestName) }} successfully refuse!
                        </font>
                    </div>
                @endif
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
                                        <a href="{{ url('admin/profiles/update/'.$row->id).'/'.$requestName }}"><font class="title-info">{{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}</font></a><br />
                                        <small class="text-info">
                                            {{ $row->barangay }},
                                            {{ \App\Http\Controllers\ParamCtrl::getMuncityName($row->muncity) }},
                                            {{ \App\Http\Controllers\ParamCtrl::getProvinceName($row->province) }}
                                        </small>
                                    </td>
                                    <td>{{ $row->sex }}</td>
                                    <td>{{ date('M d, Y',strtotime($row->dob)) }}</td>
                                    <td>{{ \App\Http\Controllers\ParamCtrl::getAge($row->dob) }}</td>
                                    <td>{{ $row->dose_screened }}</td>
                                    <td>{{ date('M d, Y',strtotime($row->dose_date_given)) }}</td>
                                    <td>{{ $row->dose_age }}</td>
                                    <td>{{ $row->dose_lot_no }}</td>
                                    <td>{{ $row->dose_batch_no }}</td>
                                    <td>{{ date('M-Y',strtotime($row->dose_expiration)) }}</td>
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

