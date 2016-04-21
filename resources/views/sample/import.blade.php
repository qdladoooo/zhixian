@extends('public.layout')
@section('content')
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>选择文件...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>

    <div class="panel panel-primary">
        <div class="panel-heading">导入记录</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>文件名</th>
                    <th>是否导入成功</th>
                    <th>操作日期</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $logs as $log )
                    <tr>
                        <th scope="row">{{ $log->id }}</th>
                        <td>{{ $log->file_name }}</td>
                        <td>{{ $log->success == 1 ? '成功' : '失败' }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = '/upload_handler/';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo('#files');
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="/statics/vendor/jquery-file-upload/jquery.fileupload.css">
@endsection


@section('script')
    <script src="/statics/vendor/jquery-file-upload/jquery.ui.widget.js"></script>
    <script src="/statics/vendor/jquery-file-upload/jquery.fileupload.js"></script>
    <script src="/statics/vendor/jquery-file-upload/jquery.iframe-transport.js"></script>
@endsection