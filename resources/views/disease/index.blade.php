@extends('public.layout')
@section('content')
    <form class="form-horizontal" method="post" action="/disease">
        <div class="form-group">
            <label class="col-sm-2 control-label">患者姓名</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" placeholder="患者姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">年龄</label>
            <div class="col-sm-8">
                <input type="number"  name="age" class="form-control" placeholder="年龄">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">性别</label>
            <div class="col-sm-8">
                <select name="gender" class="form-control">
                    <option value="男">男</option>
                    <option value="女">女</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">医院</label>
            <div class="col-sm-4">
                <select id="hospital" name="hospital" class="form-control">
                    <option value="复旦大学附属中山医院">复旦大学附属中山医院</option>
                    <option value="复旦大学附属肿瘤医院">复旦大学附属肿瘤医院</option>
                    <option value="北京样品库">北京样品库</option>
                    <option value="泰州样品库">泰州样品库</option>
                    <option value="复旦大学妇产科医院">复旦大学妇产科医院</option>
                    <option value="南通大学肿瘤医院">南通大学肿瘤医院</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="col-sm-4" style="display: none;" id="other_hospital">
                <input type="text" name="other_hospital" class="form-control" placeholder="在此填写『其他』医院">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">住院号</label>
            <div class="col-sm-8">
                <input type="text" name="check_in_no" class="form-control" placeholder="住院号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">身份证号</label>
            <div class="col-sm-8">
                <input type="text" name="card_id" class="form-control" placeholder="身份证号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">电话号码</label>
            <div class="col-sm-8">
                <input type="text"  name="tel" class="form-control" placeholder="电话号码">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">存放位置</label>
            <div class="col-sm-8">
                <input type="text"  name="store_position" class="form-control" placeholder="存放位置">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">是否健康</label>
            <div class="col-sm-4">
                <select id="health" name="is_healthy" class="form-control">
                    <option value="健康">健康</option>
                    <option value="癌前病变">癌前病变</option>
                    <option value="肿瘤">肿瘤</option>
                    <option value="炎症">炎症</option>
                    <option value="自身免疫性疾病">自身免疫性疾病</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="col-sm-4" style="display: none;" id="other_health">
                <input type="text" name="other_health" class="form-control" placeholder="在此描述『其他』情况">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">肿瘤部位</label>
            <div class="col-sm-4">
                <select id="tumour_location" name="tumour_location" class="form-control">
                    <option value="肺">肺</option>
                    <option value="胃">胃</option>
                    <option value="肝">肝</option>
                    <option value="肠">肠</option>
                    <option value="胰腺">胰腺</option>
                    <option value="食道">食道</option>
                    <option value="卵巢">卵巢</option>
                    <option value="前列腺">前列腺</option>
                    <option value="甲状腺">甲状腺</option>
                    <option value="乳腺">乳腺</option>
                    <option value="宫颈">宫颈</option>
                    <option value="膀胱">膀胱</option>
                    <option value="肾">肾</option>
                    <option value="淋巴">淋巴</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="col-sm-4" style="display: none;" id="other_tumour_location">
                <input type="text" name="other_tumour_location" class="form-control" placeholder="在此填写『其他』部位">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">肿瘤是否良性</label>
            <div class="col-sm-8">
                <select id="tumour_flag" name="is_benign" class="form-control">
                    <option value="良性">良性</option>
                    <option value="恶性">恶性</option>
                </select>
            </div>
        </div>

        <div id="tumour_info" style="display: none;">
            <div class="form-group">
                <label class="col-sm-2 control-label">大体类型</label>
                <div class="col-sm-8">
                    <input type="text" name="tumour_gross" class="form-control" placeholder="大体类型">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分型</label>
                <div class="col-sm-8">
                    <input type="text" name="tumour_typing" class="form-control" placeholder="分型">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分化程度</label>
                <div class="col-sm-8">
                    <input type="text" name="tumour_grade" class="form-control" placeholder="分化程度">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">临床分期</label>
                <div class="col-sm-8">
                    <input type="text" name="tumour_stage" class="form-control" placeholder="临床分期">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">大小</label>
                <div class="col-sm-8">
                    <input type="text" name="tumour_size" class="form-control" placeholder="大小">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">肿瘤标志物</label>
                <div class="col-sm-8">
                    <input type="text" name="tumour_marker" class="form-control" placeholder="肿瘤标志物">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">AFP</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="AFP" class="form-control" placeholder="AFP">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">CA125</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="CA125" class="form-control" placeholder="CA125">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">CEA</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="CEA" class="form-control" placeholder="CEA">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">CA199</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="CA199" class="form-control" placeholder="CA199">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">CYFRA21-1</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="CYFRA21-1" class="form-control" placeholder="CYFRA21-1">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">PSA</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="PSA" class="form-control" placeholder="PSA">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">炎症</label>
            <div class="col-sm-4">
                <select id="inflammation" name="inflammation" class="form-control">
                    <option value="胃炎">胃炎</option>
                    <option value="肝炎">肝炎</option>
                    <option value="妇科炎症">妇科炎症</option>
                    <option value="结肠炎">结肠炎</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="col-sm-4" style="display: none;" id="other_inflammation">
                <input type="text" name="other_inflammation" class="form-control" placeholder="在此填写『其他』炎症">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">自身免疫性疾病</label>
            <div class="col-sm-4">
                <select id="autoimmune" name="autoimmune" class="form-control">
                    <option value="类风湿性关节炎">类风湿性关节炎</option>
                    <option value="红斑狼疮">红斑狼疮</option>
                    <option value="硬皮病">硬皮病</option>
                    <option value="强直性脊柱炎">强直性脊柱炎</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="col-sm-4" style="display: none;" id="other_autoimmune">
                <input type="text" name="other_autoimmune" class="form-control" placeholder="在此填写『其他』疾病">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">检测值</label>
            <div class="col-sm-8">
                <input type="number" max="10" min="0" name="detected_value" class="form-control" placeholder="检测值">
            </div>
        </div>

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-default">确定</button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        $().ready(function() {
            $('#tumour_flag').change(function() {
                var flag = $(this).val();
                if( flag == '恶性' ) {
                    $('#tumour_info').slideDown();
                } else {
                    $('#tumour_info').slideUp();
                }
            });

            $('#hospital, #health, #tumour_location, #inflammation, #autoimmune').change(function() {
                var flag = $(this).val();
                var id = $(this).attr('id');

                if( flag == '其他' ) {
                    $('#other_' + id).slideDown();
                } else {
                    $('#other_' + id).slideUp();
                }
            });


        });
    </script>
@endsection