@extends('Home/User.index')

@section('title', '地址管理')

@section('css')
    
@endsection

@section('body')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">删除地址</h4>
      </div>
      <div class="modal-body">
        您确定要删除吗？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
        <button type="button" id='yes' class="btn btn-primary">确 定</button>
      </div>
    </div>
  </div>
</div>

<div class="user-content__box clearfix bgf">
    <div class="title">账户信息-收货地址</div>
    <div class='tips'>
            
    </div>
    <form action="" class="user-addr__form form-horizontal" role="form">
        <p class="fz18 cr">新增收货地址<span class="c6" style="margin-left: 20px">以下选项均为必填项</span></p>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">收货人姓名：</label>
            <div class="col-sm-6">
                <input class="form-control" id="name"  maxlength='20' placeholder="请输入姓名" type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="details" class="col-sm-2 control-label">收货地址：</label>
            <div class="col-sm-10">
                <div data-toggle="distpicker" id='address'>
                  <select></select>
                  <select></select>
                  <select></select>
                </div>
                <br>
                <input class="form-control" id="details" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
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
                <input class="form-control" maxlength='11' id="mobile" placeholder="请输入手机号码" type="text">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <div class="checkbox">
                    <label><input name='delf' type="checkbox"><i></i> 设为默认收货地址</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="button" class="but">保存</button>
            </div>
        </div>
        <script src="/Home/js/jquery.citys.js"></script>
    </form>
    <p class="fz18 cr">已保存的有效地址</p>

    <div class="table-thead addr-thead">
        <div class="tdf1">收货人</div>
        <div class="tdf2">所在地</div>
        <div class="tdf3"><div class="tdt-a_l">详细地址</div></div>
        <!-- <div class="tdf1">邮编</div> -->
        <div class="tdf1">电话/手机</div>
        <div class="tdf1">操作</div>
        <div class="tdf1"></div>
    </div>
    <div class="addr-list">
        <!-- 地址 -->
        @if(empty($addrinfo))
            <div class='addr-item msgs'>
                <h3>　暂无地址~</h3>
            </div>
        @endif
        @foreach($addrinfo as $v)
            <div class="addr-item">
                <div class="tdf1">{{$v['username']}}</div>
                <div class="tdf2 tdt-a_l">{{$v['address']}}</div>
                <div class="tdf3 tdt-a_l">{{$v['addrinfo']}}</div>
                <div class="tdf1">@php echo substr_replace($v['phone'], '****', 3, 6) @endphp</div>
                <div class="tdf1 order">
                    <a href="/home/editaddress?id={{$v['id']}}">修改</a><a style='cursor:pointer' data-id="{{$v['id']}}" class="del" data-toggle="modal" data-target="#myModal">删除</a>
                </div>
                <div class="tdf1 morendizhi">
                    @if($v['acquiescent'] == 1)
                        <a href="javascript:void(0)" data-id="{{$v['id']}}" onclick='moren(this)' class="default active">默认地址</a>
                    @else
                        <a href="javascript:void(0)" data-id="{{$v['id']}}" onclick='moren(this)' class="default">设为默认</a>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
    </div>
</div>



@endsection
    
@section('js')
<script src="/Home/address/js/distpicker.data.js"></script>
<script src="/Home/address/js/distpicker.js"></script>
<script src="/Home/address/js/main.js"></script>

<script type="text/javascript">
    var tips = $('.tips'); // 提示

    // 保存地址
    $('.but').click(function(){
        var sele = $('#address :selected');

        var name = $('#name').val(); // 收货人姓名

        var addinfo = $('#details').val(); // 详细地址

        var phone = $('#mobile').val(); // 手机号

        var delf = '';

        if ($('input[name=delf]')[0].checked) { // 是否默认
            delf = 1;
        } else {
            delf = 2;
        }

        var selone = $(sele[0]).val();
        var seltwo = $(sele[1]).val();
        var selthree = $(sele[2]).val();

        if (selone == '' || seltwo =='' || selthree == '') {
            tips.empty();
            tips.append('<div class="alert alert-danger" role="alert">请选择收获地址</div>');
            return false;
        }

        if (name == '') {
            tips.empty();
            tips.append('<div class="alert alert-danger" role="alert">请输入收货人名字</div>');
            return false;
        }

        if (addinfo == '') {
            tips.empty();
            tips.append('<div class="alert alert-danger" role="alert">请输入详细地址</div>');
            return false;   
        }

        if (phone == '') {
            tips.empty();
            tips.append('<div class="alert alert-danger" role="alert">请输入手机号</div>');
            return false;   
        }

        if(!(/^1[3456789]\d{9}$/.test(phone))){ 
            tips.empty();
            tips.append('<div class="alert alert-danger" role="alert">手机号格式不正确</div>');
            return false;   
        }
        var addr = selone+'-'+seltwo+'-'+selthree; // 地址

        // 发起ajax请求
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
            type: 'post',
            url: '/home/addaddress',
            data: {
                name: name,
                addr: addr,
                addinfo: addinfo,
                phone: phone,
                def: delf,
            },
            success: function(res) {
                location.reload();
                // $('.msgs').remove();
                // tips.empty();
                // tips.append('<div class="alert alert-info" role="alert">'+res.msg+'</div>');
            },
            error: function(err) {
                tips.empty();
                tips.append('<div class="alert alert-danger" role="alert">'+err.responseJSON.msg+'</div>');
            }
        });


    });
    // 删除地址
    var did;
    var mys;
    $('.del').click(function() {
        mys = this;
        did = $(this).data('id');
    });

    $('#yes').click(function() {
        $('#myModal').modal('hide') // 关闭模态框
        // 发起ajax请求
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
            type: 'post',
            url: '/home/deladdress',
            data: {
                id: did,
            },
            success: function(res) {
                $(mys).parent().parent().remove();
                if ($('.addr-list').children().length <= 0) {
                    $('.addr-list').append('<div class="addr-item"><h3>　暂无地址~</h3></div>')
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        });     
    });

    // 设为默认地址
    function moren(mys) {
        if ($(mys).html() == '设为默认'){
            var id = $(mys).data('id');

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });

            $.ajax({
                type: 'post',
                url: '/home/defaultaddr',
                data: {
                    id: id,
                },
                success: function(res) {
                    var sons = $('.morendizhi').children();
                    sons.each(function(k, val) {
                        $(val).html('设为默认');
                        $(val).removeClass('active');
                    })
                    $(mys).html('默认地址');
                    $(mys).addClass('active');
                },
                error: function(err) {
                    alert(err.responseJSON.msg);
                }
            }); 
        }
    }


// addClass 添加一个class
</script>
@endsection