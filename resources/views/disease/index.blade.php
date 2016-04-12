@extends('public.layout')
@section('content')
    <form class="form-horizontal" method="post" action="/disease">
        <div class="form-group">
            <label class="col-sm-2 control-label">患者姓名</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="患者姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">年龄</label>
            <div class="col-sm-10">
                <input type="text"  name="age" class="form-control" placeholder="年龄">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">性别</label>
            <div class="col-sm-10">
                <input type="text" name="gender" class="form-control" placeholder="性别">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">医院</label>
            <div class="col-sm-10">
                <input type="text" name="hospital" class="form-control" placeholder="医院">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">住院号</label>
            <div class="col-sm-10">
                <input type="text" name="check_in_no" class="form-control" placeholder="住院号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">身份证号</label>
            <div class="col-sm-10">
                <input type="text" name="card_id" class="form-control" placeholder="身份证号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">电话号码</label>
            <div class="col-sm-10">
                <input type="text"  name="tel" class="form-control" placeholder="电话号码">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">样本创建时间</label>
            <div class="col-sm-10">
                <input type="text"  name="sample_create_time" class="form-control" placeholder="样本创建时间">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">条码</label>
            <div class="col-sm-10">
                <input type="text"  name="qr" class="form-control" placeholder="条码">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">存放位置</label>
            <div class="col-sm-10">
                <input type="text"  name="store_position" class="form-control" placeholder="存放位置">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">是否健康</label>
            <div class="col-sm-10">
                <input type="text" name="is_heathy" class="form-control" placeholder="是否健康">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">肿瘤部位</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_location" class="form-control" placeholder="肿瘤部位">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">大体类型</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_gross" class="form-control" placeholder="大体类型">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">大小</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_size" class="form-control" placeholder="大小">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">分化程度</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_grade" class="form-control" placeholder="分化程度">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">分期</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_stage" class="form-control" placeholder="分期">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">分型</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_typing" class="form-control" placeholder="分型">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">肿瘤标志物</label>
            <div class="col-sm-10">
                <input type="text" name="tumour_marker" class="form-control" placeholder="肿瘤标志物">
            </div>
        </div>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">确定</button>
            </div>
        </div>
    </form>
@endsection