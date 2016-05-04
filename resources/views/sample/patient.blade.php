@extends('public.layout')
@section('content')
    <div id="container">
        <form action="">
            <table class="table table-bordered">
                <tr>
                    <td><input type="text" placeholder="id" /></td>
                    <td colspan="2"><input type="text" placeholder="名字"></td>
                    <td colspan="2"><input type="text" placeholder="性别"></td>
                    <td colspan="2"><input type="text" placeholder="医院"></td>
                </tr>
                <tr>
                    <td>afp</td>
                    <td>ca125</td>
                    <td>cea</td>
                    <td>ca199</td>
                    <td>cyfra21_1</td>
                    <td>psa</td>
                    <td>检测值</td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                    <td><input type="text" placeholder="from" value=""><input class="mt5" type="text" placeholder="to" value=""></td>
                </tr>
            </table>
            <input class="btn btn-primary" type="submit" value="搜索">
        </form>
    </div>
    <div class="clearfix" style="margin-bottom: 30px;">
    {!! $paginator !!}
    </div>
    @foreach($rows as $row)
        <table class="table table-bordered">
            <tr>
                <td>{{$row['patient_id']}}</td>
                <td colspan="2">{{$row['name']}}</td>
                <td colspan="2">{{$row['gender']}}</td>
                <td colspan="2">{{$row['hospital']}}</td>
            </tr>
            <tr>
                <td>afp</td>
                <td>ca125</td>
                <td>cea</td>
                <td>ca199</td>
                <td>cyfra21_1</td>
                <td>psa</td>
                <td>检测值</td>
            </tr>
            <tr>
                <td>{{$row['afp']}}</td>
                <td>{{$row['ca125']}}</td>
                <td>{{$row['cea']}}</td>
                <td>{{$row['ca199']}}</td>
                <td>{{$row['cyfra21_1']}}</td>
                <td>{{$row['psa']}}</td>
                <td>{{$row['detected_value']}}</td>
            </tr>
        </table>
    @endforeach
@endsection