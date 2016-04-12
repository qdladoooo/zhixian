@extends('public.layout')
@section('content')
    <table class="table table-striped">
        <tr>
            <td>病人编号</td>
            <td>姓名</td>
            <td>年龄</td>
            <td>性别</td>
            <td>医院</td>
            <td>住院号</td>
            <td>身份证号</td>
            <td>电话</td>
            <td>采样时间</td>
            <td>录入时间</td>
            <td>条码</td>
            <td>存放位置</td>
            <td>是否健康</td>
            <td>肿瘤部位</td>
            <td>大体类型</td>
            <td>大小</td>
            <td>分化程度</td>
            <td>分期</td>
            <td>分型</td>
            <td>肿瘤标志物</td>
        </tr>
        @foreach($rows as $row)
        <tr>
            <td>{{$row['patient_id']}}</td>
            <td>{{$row['name']}}</td>
            <td>{{$row['age']}}</td>
            <td>{{$row['gender']}}</td>
            <td>{{$row['hospital']}}</td>
            <td>{{$row['check_in_no']}}</td>
            <td>{{$row['card_id']}}</td>
            <td>{{$row['tel']}}</td>
            <td>{{$row['sample_create_time']}}</td>
            <td>{{$row['input_time']}}</td>
            <td>{{$row['qr']}}</td>
            <td>{{$row['store_position']}}</td>
            <td>{{$row['is_heathy']}}</td>
            <td>{{$row['tumour_location']}}</td>
            <td>{{$row['tumour_gross']}}</td>
            <td>{{$row['tumour_size']}}</td>
            <td>{{$row['tumour_grade']}}</td>
            <td>{{$row['tumour_stage']}}</td>
            <td>{{$row['tumour_typing']}}</td>
            <td>{{$row['tumour_marker']}}</td>
        </tr>
        @endforeach
    </table>
@endsection