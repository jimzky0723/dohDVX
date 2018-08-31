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
                <a href="{{ url('admin/profiles').'/'.$requestName }}" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                Upload Data</h3>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-inline form-submit" method="POST" enctype="multipart/form-data" action="{{ asset('admin/profiles/upload') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="file" name="file" id="fileSelected" class="file" accept=".csv" >
                            <div class="input-group col-xs-12">
                                <span class="input-group-addon"><i class="fa fa-file-excel-o"></i></span>
                                <input type="text" class="form-control input-md" disabled placeholder="Upload .csv File">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-warning input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success col-xs-12 btn-submit"><i class="fa fa-upload"></i> Upload</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <div class="page-divider"></div>
                    <div class="progress-section hide">
                        <div class="progress">
                            <div class="progress-bar progress-bar-bg progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                        </div>
                        <div class="loadingbar">
                            <font class="download-text">Uploading Data...</font>
                        </div>
                    </div>
                    <div class="alert alert-danger error hide">
                        <font class="text-danger"><strong>Error! File extension is not valid!</strong></font>
                    </div>
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
        $(document).on('click', '.browse', function(){
            var file = $(this).parent().parent().parent().find('.file');
            file.trigger('click');
        });
        $(document).on('change', '.file', function(){
            $(this).parent().find('.forms-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });

        $('.forms-submit').submit(function(e){
            e.preventDefault();

            $('.progress-bar').addClass('progress-bar-animated');
            $('.progress-bar').addClass('progress-bar-striped');
            $('.progress-bar').removeClass('progress-bar-success');
            $('.progress-section').removeClass('hide');

            var reader_offset = 0;		//current reader offset position
            var buffer_size = 4096;		//
            var pending_content = '';
            var content = '';
            var i = 0;
            var add = 0;

            var version = '';

            readAndSendData();

            function readAndSendData()
            {
                var reader = new FileReader();
                var file = $('#fileSelected')[0].files[0];
                var total = 0,
                    extension = '';

                if(file) {
                    total = file.size;
                    extension = file.name.split('.').pop().toLowerCase();

                    if(extension!='csv')
                    {
                        $('.progress-section').addClass('hide');
                        $('.error').removeClass('hide');
                        $('.btn-submit').attr('disabled',false);
                    }
                    else
                    {
                        reader.onloadend = function (evt) {

                            //check for end of file
                            if (evt.loaded == 0) return;

                            //increse offset value
                            reader_offset += evt.loaded;

                            //check for only complete line
                            var last_line_end = evt.target.result.lastIndexOf('\n');
                            content = pending_content + evt.target.result.substring(0, last_line_end);
                            content = content.split("\n");
                            pending_content = evt.target.result.substring(last_line_end + 1, evt.target.result.length);

                            //loading...
                            i += evt.target.result.length;
                            add = (i / total) * 100;
                            var p = Math.round(add);
                            $('.progress-bar').html(p+'%');
                            $('.progress-bar').css('width',p+'%');
                            $(document).attr("title", p+'% - Uploading Data');
                            //upload data
                            if(p==100){
                                setTimeout(function(){
                                    $('.progress-bar').removeClass('progress-bar-animated');
                                    $('.progress-bar').removeClass('progress-bar-striped');
                                    $('.progress-bar').addClass('progress-bar-success');
                                    $('.progress-bar').html('Complete');
                                    $('.download-text').html('Upload Complete');
                                    $(document).attr("title", 'Upload Complete');
                                    $('.btn-submit').attr('disabled',false);
                                },2000);

                                setTimeout(function(){
                                    window.location.href = "{{ url('admin/upload/result') }}";
                                },3000);
                            }
                            setTimeout(sendData,1000);
                        };
                        var blob = file.slice(reader_offset, reader_offset + buffer_size);
                        reader.readAsText(blob);
                    }
                }else{
                    console.log('no data');
                    $('.progress-section').addClass('hide');
                    $('.btn-submit').attr('disabled',false);
                }
            }

            function sendData()
            {
                var offsetUrl = "{{ url('admin/upload') }}";

                $.ajax({
                    url: offsetUrl,
                    data : { data:content},
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    complete: function(xhr, statusText){
                        if(xhr.status==200){
                            readAndSendData();
                        }
                    }
                });
            }
        });
    </script>
@endsection