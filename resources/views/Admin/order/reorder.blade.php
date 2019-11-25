@extends('Admin.index')


@section('title','修改订单')


@section('body')


<div class="row">
<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div class="widget am-cf">
        <div class="widget-head am-cf">
            <div class="widget-title am-fl">订单修改</div>
            <div class="widget-function am-fr">
                <a href="javascript:;" class="am-icon-cog"></a>
            </div>
        </div>
        <div class="widget-body am-fr">

            <form class="am-form tpl-form-border-form tpl-form-border-br">
                <input type="hidden" name="aid" value="{{$order['aid']}}">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">手机号：<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-9">
                        <input type="number" class="tpl-form-input" name="phone" value="{{$order['phone']}}" id="phone" >
                        <span id="reminder"></span>
                    </div>
                </div>

                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">地址：<span class="tpl-form-line-small-title">省/市/区/县</span></label>
                    <div class="am-u-sm-9">
                        <input type="text" class="tpl-form-input" name="address" value="{{$order['address']}}" id="addr" >
                    </div>
                </div>
     

                <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label" >详细地址:<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-9">
                        <input type="text" name="addrinfo" id="addrinfo" value="" >
                     <span id="addr"></span>
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-9 am-u-sm-push-3">
                        <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success edit" >提交</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="/Admin/assets/js/jquery.min.js"></script>
<script>
     $('#phone').focus(function(){
      
        $('#reminder').html('<b>请输入11位的手机号</b>');
          
     })

     $('#phone').blur(function() {
        
         let phone =  $('#phone').val();
         let res = /^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[0135678]|9[89])\d{8}$/;
          
          if ($('#phone').val() == '') {
            $('#reminder').html('<b style="color:red">手机号不能为空！</b>');
            
          } else {
             if (res.test(phone)) {
               $('#phone').css('border','1px solid green');
               $('#reminder').html('<b></b>');
             } else {
               $('#reminder').html('<b style="color:red">手机号格式不正确</b>'); 
             }
          }
       
     })
     

       $('#addrinfo').focus(function(){
      
        $('#addr').html('<b>请输入详细地址</b>');
          
     })

     $('#addrinfo').blur(function() {
        
         let addrinfo =  $('#addrinfo').val();
         let resin = /^[u4e00-\u9fa5][a-zA-Z0-9_]{15,30}+$/;
          
          if ($('#addrinfo').val() == '') {
            $('#addr').html('<b style="color:red">地址不能为空！</b>');
          } else {
             if (resin.test(addrinfo)) {
               $('#addrinfo').css('border','1px solid green');
               $('#addr').html('<b></b>');
             } else {
               $('#addr').html('<b style="color:red">地址格式不正确</b>'); 
             }
          }
       
     })

     $('.edit').click(function(){
        var aid = $('input[name=aid]').val();
        var phone = $('#phone').val();
        var address = $('#addr').val();
        var addrinfo = $('input[name=addrinfo]').val();
      
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type: 'post',
            url: '/admin/order/edit',
            data: {
                aid:aid,
                phone:phone,
                address:address,
                addrinfo:addrinfo,
            },
            success: function(res) {
             location.href = '/admin/order';   
              
                    
            },
            error: function (err) {
                alert(err.responseJSON.msg);
            }
        })
        return false;
    })
    

</script>



@endsection