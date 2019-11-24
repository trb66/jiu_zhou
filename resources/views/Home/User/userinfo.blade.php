@extends('Home/User.index')

@section('title', '修改')

@section('css')
    
@endsection

@section('body')
    <div class="user-content__box clearfix bgf">
        <div class="title">账户信息-个人资料</div>
        <!-- 错误信息 -->
        <div id='errmsg'>
            </div>

        <div class="port b-r50" id="crop-avatar">
            <div class="img"><img onerror="this.src='/Home/images/icons//default_avt.png';" id='pic' title='点击修改' src="
                @if(!empty($info->userinfo->photo))
                    /storage/{{$info->userinfo->photo}}
                @else
                    /Home/images/icons/default_avt.png
                @endif
                " class="cover b-r50"></div>
        </div>
        <form action="" class="user-setting__form" role="form">
            <div class="user-form-group">
                <label for="user-name">真实姓名：</label>
                <input title='点击修改' type="text" id="user-name"  @if(!empty($info->userinfo->name)) value='{{$info->userinfo->name}}' @endif placeholder="请输入您的真实姓名">
            </div>
            <div class="user-form-group">
                <label for="user-id">用户名：</label>
                <input title='点击修改' type="text" id="user-id" value="{{$info->username}}" placeholder="请输入您的昵称">
            </div>
            <div class="user-form-group">
                <label>等级：</label>
                普通会员 
            </div>
            <div class="user-form-group" id='sexs'>
                <label>性别：</label>
                <label><input type="radio" @if(!empty($info->userinfo->sex) && $info->userinfo->sex == '2') checked  @endif name="sex" value="2"><i class="iconfont icon-radio"></i> 男士</label>
                <label><input type="radio" @if(!empty($info->userinfo->sex) && $info->userinfo->sex == 1) checked  @endif name="sex" value="1"><i class="iconfont icon-radio"></i> 女士</label>
                <label><input type="radio" @if(!empty($info->userinfo->sex) && $info->userinfo->sex == 3) checked  @endif name="sex" value="3"><i class="iconfont icon-radio"></i> 保密</label>
            </div>
            <div class="user-form-group">
                <label>手机号：</label>
                <label><input type="text" id='user-phone' value="{{$info->phone}}" placeholder="请输入您的手机号"></label>
            </div>
            <div class="user-form-group">
                <label>邮箱：</label>
                <label><input id='user-email' type="text" title='email' @if(!empty($info->userinfo->email)) value='{{$info->userinfo->email}}'  @endif class="" placeholder="请输入您的邮箱"></label>
            </div>
            <div class="user-form-group">
                <button type="button" data-id='{{$info->id}}' id='save' class="btn">确认修改</button>
            </div>
        </form>
        <script src="/Home/js/zebra.datepicker.min.js"></script>
        <link rel="stylesheet" href="/Home/css/zebra.datepicker.css">
        <script>
            $('input.datepicker').Zebra_DatePicker({
                default_position: 'below',
                show_clear_date: false,
                show_select_today: false,
            });
        </script>
    </div>
@endsection
    
@section('photo')
<!-- 头像选择模态框 -->
    <link href="/Home/css/cropper/cropper.min.css" rel="stylesheet">
    <link href="/Home/css/cropper/sitelogo.css" rel="stylesheet">
    <script src="/Home/js/cropper/cropper.min.js"></script>
    <script src="/Home/js/cropper/sitelogo.js"></script>
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">修改头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">图片上传</label>
                                <input class="avatar-input" data-id='{{$info->id}}' id="avatarInput" name="avatar_file" type="file">
                            </div>
                            <!-- 提示框 -->
                            <div id='msgs' style='margin-top:20px'> 
                                <!-- <div class="alert alert-danger" role="alert">...</div> -->
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                            <div class="row avatar-btns">
                                <div class="col-md-9">
                                    <div class="btn-group">
                                        <button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button id='save_photo' onclick='return false' class="btn btn-success btn-block avatar-save" type="button"><i class="fa fa-save"></i> 保存修改</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $('#save_photo').click(function (){
        var pic = $('#avatarInput')[0].files[0]; // 文件
        var id = $('#avatarInput').data('id'); // 用户ID

        var msgs = $('#msgs'); // 提示框

        if(pic == undefined) {
            alert('请选择要修改的图片');
            return false;
        } else {
            var fd = new FormData();

            fd.append('pic', pic); // 头像

            fd.append('id', id); // 用户ID
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/addphoto',
                processData: false, // 关闭data数据格式化
                contentType: false, // 不要设置数据类型 enctype
                data: fd,
                success: function(res) {
                    msgs.empty();
                    msgs.append('<div class="alert alert-info" role="alert">'+res.msg+'</div>');
                    $('#pic').attr("src","/storage/"+res.path);
                },
                error: function(err) {
                    var errs = err.responseJSON.errors; // 错误信息
                    if(err.responseJSON.code == 0){
                        msgs.empty();
                        msgs.append('<div class="alert alert-danger" role="alert">'+err.responseJSON.msg+'</div>');
                    } else {
                        msgs.empty(); // 清空提示
                        for(var v in errs) {
                            for(var vv in errs[v]) {
                                msgs.append('<div class="alert alert-danger" role="alert">'+errs[v][vv]+'</div>');
                            }
                        }
                    }
                }
            });
        }
    });

        
    var edmsg = $('#errmsg'); // 修改提示信息

    $('#save').click(function (){ // 修改个人信息
        var id = $('#save').data('id');
        var name = $('#user-name').val(); // 真实姓名
        var sex = ''; // 性别
        $('#sexs :checked').val() == undefined ? sex = 2 : sex = $('#sexs :checked').val();
        var phone = $('#user-phone').val();; // 手机号
        var email = $('#user-email').val();; // 邮箱

        if(name != '' && !(/^[\u4E00-\u9FA5]{2,20}$/.test(name))){ //判断姓名
            alert('用户名由2-20位的中文组成');
            return false;
        }

        if(phone == ''){ //判断手机号
            alert('手机号不能为空');
            return false;
        }

        if(!(/^1[3456789]\d{9}$/.test(phone))){ 
            alert('手机号格式不正确');
            return false; 
        }

        if(email != '' && !(/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/.test(email))){ //邮箱
            alert('邮箱格式不正确');
            return false;
        }
        $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });

        $.ajax({
            type: 'post',
            url: '/home/editinfo',
            data: {
                id: id,
                name: name,
                sex: sex,
                phone: phone,
                email: email,
            },
            success: function(res) {
                    edmsg.empty();
                    edmsg.append('<div class="alert alert-info" role="alert">'+res.msg+'</div>');
            },
            error: function(err) {
                if (err.responseJSON.code == 0) {
                    edmsg.empty();
                    edmsg.append('<div class="alert alert-danger" role="alert">'+err.responseJSON.msg+'</div>');
                }
            }
        });
    });
</script>  
@endsection