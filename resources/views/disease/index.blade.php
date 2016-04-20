@extends('public.layout')
@section('content')
    <form class="form-horizontal" method="post" action="/disease">
        <div class="panel panel-primary">
            <div class="panel-heading">患者信息</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">患者姓名</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="患者姓名">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-8">
                        <input type="number" min="0" max="200" name="age" class="form-control" placeholder="年龄">
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
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">样本信息</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">存放位置</label>
                    <div class="col-sm-8">
                        <input type="text"  name="store_position" class="form-control" placeholder="存放位置">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">是否健康</label>
                    <div class="col-sm-4">
                        <label class="radio-inline" style="line-height: 25px;height: 25px;">
                            <input type="radio" name="is_healthy" checked value="健康">健康
                        </label>
                        <label class="radio-inline" style="line-height: 25px;height: 25px;">
                            <input type="radio" name="is_healthy" value="不健康">不健康
                        </label>
                    </div>
                </div>

                <div style="display: none;" id="health_optioin">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">炎症</label>
                        <div class="col-sm-4">
                            <select id="inflammation" name="inflammation" class="form-control">
                                <option value="无">无</option>
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
                                <option value="无">无</option>
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
                        <label class="col-sm-2 control-label">肿瘤相关</label>
                        <div class="col-sm-4">
                            <select id="tumour_info" name="tumour_info" class="form-control">
                                <option value="无">无</option>
                                <option value="癌前病变">癌前病变</option>
                                <option value="良性肿瘤">良性肿瘤</option>
                                <option value="恶性肿瘤">恶性肿瘤</option>
                            </select>
                        </div>
                        <div class="col-sm-4" style="display: none;" id="other_tumour_info">
                            <input type="text" name="other_tumour_info" class="form-control" placeholder="在此填写『其他』疾病">
                        </div>
                    </div>


                    <div id="pathological" style="display: none;">
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
                            <label class="col-sm-2 control-label">大体分型</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_gross" class="form-control" placeholder="大体分型">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">组织分型</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_typing" class="form-control" placeholder="组织分型">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">组织分级</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_grade" class="form-control" placeholder="组织分级">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">临床分期</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_stage" class="form-control" placeholder="临床分期">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">肿瘤大小</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_size" class="form-control" placeholder="肿瘤大小">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">淋巴结转移情况</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_transfer" class="form-control" placeholder="淋巴结转移情况">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">有无远处转移</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_long_transfer" class="form-control" placeholder="有无远处转移">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">肿瘤标志物</label>
                            <div class="col-sm-8">
                                <input type="text" name="tumour_marker" class="form-control" placeholder="肿瘤标志物">
                            </div>
                        </div>
                    </div>
                    <div id="biochemical_test" style="display: none;">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AFP</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.1" max="10" min="0" name="AFP" class="form-control" placeholder="AFP">
                            </div>
                            <div class="col-sm-3">
                                <select name="AFP_desc" class="form-control">
                                    <option value="正常">正常</option>
                                    <option value="偏高">偏高</option>
                                    <option value="偏低">偏低</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">CA125</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.1" max="10" min="0" name="CA125" class="form-control" placeholder="CA125">
                            </div>
                            <div class="col-sm-3">
                                <select name="CA125_desc" class="form-control">
                                    <option value="正常">正常</option>
                                    <option value="偏高">偏高</option>
                                    <option value="偏低">偏低</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">CEA</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.1" max="10" min="0" name="CEA" class="form-control" placeholder="CEA">
                            </div>
                            <div class="col-sm-3">
                                <select name="CEA_desc" class="form-control">
                                    <option value="正常">正常</option>
                                    <option value="偏高">偏高</option>
                                    <option value="偏低">偏低</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">CA199</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.1" max="10" min="0" name="CA199" class="form-control" placeholder="CA199">
                            </div>
                            <div class="col-sm-3">
                                <select name="CA199_desc" class="form-control">
                                    <option value="正常">正常</option>
                                    <option value="偏高">偏高</option>
                                    <option value="偏低">偏低</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">CYFRA21-1</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.1" max="10" min="0" name="CYFRA21-1" class="form-control" placeholder="CYFRA21-1">
                            </div>
                            <div class="col-sm-3">
                                <select name="CYFRA21-1_desc" class="form-control">
                                    <option value="正常">正常</option>
                                    <option value="偏高">偏高</option>
                                    <option value="偏低">偏低</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">PSA</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.1" max="10" min="0" name="PSA" class="form-control" placeholder="PSA">
                            </div>
                            <div class="col-sm-3">
                                <select name="PSA_desc" class="form-control">
                                    <option value="正常">正常</option>
                                    <option value="偏高">偏高</option>
                                    <option value="偏低">偏低</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">检测值</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">检测值</label>
                    <div class="col-sm-8">
                        <input type="number" max="10" min="0" name="detected_value" class="form-control" placeholder="检测值">
                    </div>
                </div>
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

            //健康状况开关
            $('input[name="is_healthy"]').change(function() {
                if( $('input[name="is_healthy"]:checked').val() == '不健康' ) {
                    $('#health_optioin').slideDown();
                } else {
                    $('#health_optioin').slideUp();
                }
            });

            //疾病种类开关
            $('#tumour_info, #autoimmune, #inflammation').change(function() {
                if( $('#tumour_info').val() !== '无' ) {
                    $('#biochemical_test').slideDown();
                    $('#pathological').slideDown();
                } else if( $('#autoimmune').val() !== '无' || $('#inflammation').val() !== '无' ) {
                    $('#biochemical_test').slideDown();
                    $('#pathological').slideUp();
                } else {
                    $('#biochemical_test').slideUp();
                    $('#pathological').slideUp();
                }
            });

            //其他项开关
            $('#hospital, #tumour_location, #inflammation, #autoimmune').change(function() {
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