@extends('Home/User.index')

@section('title', '地址管理')

@section('css')
    
@endsection

@section('body')
<div style='display:none'>
    <span data-dizhi="{{$editinfo->addr0}}" id='dizhi1'></span>
    <span data-dizhi="{{$editinfo->addr1}}" id='dizhi2'></span>
    <span data-dizhi="{{$editinfo->addr2}}" id='dizhi3'></span>
</div>

<div data-id='1234' id='test'></div>
<div class="user-content__box clearfix bgf">
    <div class="title"><a style='color:#666' href="/home/userinfo">账户信息</a> - <a style='color:#666' href="/home/useraddress">地址管理</a> - 修改地址</div>
    <div class='tips'>
            
    </div>
    <form action="" class="user-addr__form form-horizontal" role="form">
        <p class="fz18 cr">修改收货地址<span class="c6" style="margin-left: 20px">以下选项均为必填项</span></p>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">收货人姓名：</label>
            <div class="col-sm-6">
                <input class="form-control" value="{{$editinfo->username}}" id="name"  maxlength='20' placeholder="请输入姓名" type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="details" class="col-sm-2 control-label">收货地址：</label>
            <div class="col-sm-10">
                <div data-toggle="distpicker" id='address'>
                  <select id='sel1'></select>
                  <select id='sel2'></select>
                  <select id='sel3'></select>
                </div>
                <br>
                <input value="{{$editinfo->addrinfo}}" class="form-control" id="details" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
            </div>
        </div>
        <!-- <div class="form-group">
            <label for="code" class="col-sm-2 control-label">地区编码：</label>
            <div class="col-sm-6">
                <input class="form-control" id="code" placeholder="请输入邮政编码" type="text">
            </div>
        </div> -->
        <div class="form-group">
            <label for="mobile" class="col-sm-2 control-label">手机号码：</label>
            <div class="col-sm-6">
                <input value="{{$editinfo->phone}}" class="form-control" maxlength='11' id="mobile" placeholder="请输入手机号码" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <div class="checkbox">
                    <label><input @if($editinfo->acquiescent == 1) checked @endif name='delf' type="checkbox"><i></i> 设为默认收货地址</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="button" class="but" data-id="{{$editinfo['id']}}">保存</button>
            </div>
        </div>
        <script src="/Home/js/jquery.citys.js"></script>
    </form>
    </div>
</div>



@endsection
    
@section('js')
<script src="/Home/address/js/distpicker.data.js"></script>
<script src="/Home/address/js/distpicker.js"></script>
<script src="/Home/address/js/main.js"></script>

<script type="text/javascript">
    
    // 默认选择地址
    $('#address').distpicker({
      province: $('#dizhi1').data('dizhi'),
      city: $('#dizhi2').data('dizhi'),
      district: $('#dizhi3').data('dizhi')
    });
    
    $(document).ready(function(){

        var tips = $('.tips'); // 提示

        $('.but').click(function() {
            
            var id = $(this).data('id');

            var name = $('#name').val(); // 姓名

            var dizhi1 = $('#sel1 :selected').val(); // 省

            var dizhi2 = $('#sel2 :selected').val(); // 市
            
            var dizhi3 = $('#sel3 :selected').val(); // 区/县

            var addrinfo = $('#details').val(); // 详细地址

            var phone = $('#mobile').val(); // 手机号

            var delf = '';

            if ($('input[name=delf]')[0].checked) { // 是否默认
                delf = 1;
            } else {
                delf = 2;
            }

            if (name == '') {
                tips.empty();
                tips.append('<div class="alert alert-danger" role="alert">请输入收货人名字</div>');
                return false;
            }

            if (dizhi1 == '' || dizhi2 == '' || dizhi3 == '') {
                tips.empty();
                tips.append('<div class="alert alert-danger" role="alert">请选择正确的收货地址</div>');
                return false;
            }

            if(addrinfo == '') {
                tips.empty();
                tips.append('<div class="alert alert-danger" role="alert">详细地址不能留空</div>');
                return false;   
            }

            if (phone == '') {
                tips.empty();
                tips.append('<div class="alert alert-danger" role="alert">手机号不能留空</div>');
                return false;   
            }

            if(!(/^1[3456789]\d{9}$/.test(phone))){ 
                tips.empty();
                tips.append('<div class="alert alert-danger" role="alert">手机号格式不正确</div>');
                return false;   
            }

            var addr = dizhi1+'-'+dizhi2+'-'+dizhi3; // 地址

            // 发起ajax请求
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/editaddress',
                data: {
                    id: id,
                    name: name,
                    addr: addr,
                    addrinfo: addrinfo,
                    phone: phone,
                    def: delf,
                },
                success: function(res) {
                    tips.empty();
                    tips.append('<div class="alert alert-info" role="alert">'+res.msg+'</div>');
                },
                error: function(err) {
                    tips.empty();
                    tips.append('<div class="alert alert-danger" role="alert">'+err.responseJSON.msg+'</div>');
                }
            });


        });

    });
</script>
@endsection