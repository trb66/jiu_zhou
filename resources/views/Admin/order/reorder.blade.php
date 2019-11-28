@extends('Admin.index')


@section('title','修改订单')


@section('body')
<div style='display:'>
    <span data-dizhi="{{$order->addr1}}" id='dizhi1'></span>
    <span data-dizhi="{{$order->addr2}}" id='dizhi2'></span>
    <span data-dizhi="{{$order->addr3}}" id='dizhi3'></span>
</div>

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
        <div class="am-alert show" style="display:none;background-color: red"></div>
            
            <form class="am-form tpl-form-border-form tpl-form-border-br">
                <input type="hidden" name="id" value="{{$order['id']}}">
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">手机号：<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-9">
                        <input style='border-radius:5px' type="number" class="tpl-form-input" name="phone" value="{{$order['phone']}}" id="phone" >
                        <span id="reminder"></span>
                    </div>
                </div>

                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">地址：<span class="tpl-form-line-small-title">省/市/区/县</span></label>
                    <div class="am-u-sm-9">
                        <div  id='address'   data-toggle="distpicker">
                          <select style='width:200px;margin-right:10px;border-radius:5px;float:left' id='sel1'></select>&nbsp;
                          <select style='width:200px;margin-right:10px;border-radius:5px;float:left' id='sel2'></select>&nbsp; 
                          <select style='width:200px;margin-right:10px;border-radius:5px;float:left' id='sel3'></select>&nbsp; 
                        </div>
                    </div>
                </div>
     

                <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label" >详细地址:<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-9">
                        <input type="text" style='border-radius:5px' value="{{$order->addr4}}" name="addrinfo" id="addrinfo" value="" >
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
<script src="/Home/address/js/distpicker.data.js"></script>
<script src="/Home/address/js/distpicker.js"></script>
<script src="/Home/address/js/main.js"></script>
<script>
  
    // 默认选择地址
    $('#address').distpicker({
      province: $('#dizhi1').data('dizhi'),
      city: $('#dizhi2').data('dizhi'),
      district: $('#dizhi3').data('dizhi')
    });

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
      $('#addrinfo').blur(function() {
        
         let addrinfo =  $('#addrinfo').val();
         let ress = /^[\u4E00-\u9FA5A-Za-z0-9_]+$/;
          
          if ($('#addrinfo').val() == '') {
            $('#addr').html('<b style="color:red">详细地址不能为空！</b>');
            
          } else {
             if (ress.test(addrinfo)) {
               $('#addrinfo').css('border','1px solid green');
               $('#addr').html('<b></b>');
             } else {
               $('#addr').html('<b style="color:red">地址格式不正确</b>'); 
             }
          }
       
     })

       

     $('.edit').click(function(){
        var id = $('input[name=id]').val();

        var phone = $('#phone').val();
        var dizhi1 = $('#sel1 :selected').val(); // 省

        var dizhi2 = $('#sel2 :selected').val(); // 市
            
        var dizhi3 = $('#sel3 :selected').val(); // 区/县

        var addrinfo = $('input[name=addrinfo]').val();
        var address = dizhi1+'-'+dizhi2+'-'+dizhi3+'-'+addrinfo

        console.dir(phone)
      
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
        $.ajax({
            type: 'post',
            url: '/admin/order/edit',
            data: {
                id:id,
                phone:phone,
                addrinfo:addrinfo,
                address:address,

           
            },
            success: function(res) {
              
   
             location.href = '/admin/order';   
       
       
                    
            },
            error: function (err) {

                 if(err){
                       let errs = err.responseJSON.errors
                        for( e in errs) {
                            $('.show').css('display','block');
                            $('<p>'+ errs[e][0] +'</p>').appendTo('.show');
                        }
                   }

                if (err.responseJSON.code == 1) {

                alert(err.responseJSON.msg);
                }
            }
        })
        return false;
    })
    

</script>



@endsection