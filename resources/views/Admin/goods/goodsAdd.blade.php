@extends('Admin.index')
@section('title', '添加商品')
@section('css')
@endsection
@section('body')
<div class="row" style="margin-top:20px; margin-left:5px">

    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">添加商品</div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                </div>
            </div>
        <div class="widget-body am-fr">
        <div class="am-alert show" style="display:none"></div>
        <form class="am-form tpl-form-border-form">
            <div class="am-form-group">
                <label for="user-phone" class="am-u-sm-12 am-form-label am-text-left">商品类型<span class="tpl-form-line-small-title">Types</span></label>
                <div class="am-u-sm-12  am-margin-top-xs">
                    <select  id="cid" data-am-selected="{searchBox: 1}" style="display: none;">
                        @foreach($types as $v)

                           @php
                          $sum = substr_count($v->path, ',');
                          $str = str_repeat('**', ($sum-1)*2); 
                          @endphp
                        <option {{$sum<3?'disabled':''}} value="{{$v->id}}">┟-{{$str}}{{$v->name}}</option>

                        @endforeach

                    </select>
                </div>
            </div>

            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">商品名 <span class="tpl-form-line-small-title">Tname</span></label>
                <div class="am-u-sm-12">
                    <input type="text" maxlength="30" class="tpl-form-input am-margin-top-xs" id="user-name" placeholder="请输入商品名称">
                    <small id="annotation1"></small>
                </div>
            </div>
            <div class="am-form-group">
                <label class="am-u-sm-12 am-form-label  am-text-left">商品价格 <span class="tpl-form-line-small-title">￥</span></label>
                <div class="am-u-sm-12">
                <input type="number" id="prine" class="am-margin-top-xs" placeholder="输入商品价格">
                <small id="annotation2"></small>
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-weibo" class="am-u-sm-12 am-form-label  am-text-left">商家名称 <span class="tpl-form-line-small-title">Vender</span></label>
                <div class="am-u-sm-12">
                <input type="text" id="user-weibo" maxlength="30" class="am-margin-top-xs" placeholder="请输入您的商家名">
                <small id="annotation3"></small>
                <div>
                </div>
                </div>
            </div>

            <div class="am-form-group">
                <label for="user-phone" class="am-u-sm-12 am-form-label am-text-left">商品状态<span class="tpl-form-line-small-title">State</span></label>
                <div class="am-u-sm-12  am-margin-top-xs">
                    <select id='test' data-am-selected="{searchBox: 1}" style="display: none;">
                        <option value="0">在售中</option>
                        <option value="1">已下架</option>
                    </select>
                </div>
            </div>

            <div class="am-form-group">
                <div class="am-u-sm-12 am-u-sm-push-12">
                    <button type="button" id="but" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                </div>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>
<script>
       //验证商品名称
       $("#user-name").focus(function() {
             $("#annotation1").html('商品名称3~30个字符以内')
             $("#user-name").css({border : '1px solid green', color : '#000'})
       })
      $('#user-name').blur(function()
      { 
          if($('#user-name').val() == '') {
             $("#annotation1").html('<b style="color:red">商品名称不能为空</b>')
             $("#user-name").css({border : '2px solid red', color : 'red'})

          }else {
            let str = $('#user-name').val();
            let ret = /^\S+.{2,30}$/;

            if(ret.test(str)){
                $("#annotation1").html('<b style="color:black">^_^商品名符合规则<b>')
                $("#user-name").css({border : '2px solid #33a3dc', color : '#000'})

                
            }else {
                $("#annotation1").html('<b style="color:red">亲！您的商品名不合法哦</b>')
                $("#user-name").css({border : '2px solid red', color : 'red'}) 
                $("$but").click(function(event){
                      return false;
                });
                 return false;
            }
          }
      })

      //验证商品价格
      $("#prine").focus(function() {
             $("#annotation2").html('商品价格个范围999999.99~0.01')
             $("#prine").css({border : '1px solid green', color : '#000'})
           
       })
      $('#prine').blur(function()
      { 
          if($('#prine').val() == '') {
             $("#annotation2").html('<b style="color:red">亲！请填写合法规则</b>')
             $("#prine").css({border : '2px solid red', color : 'red'})
          }else {
            let str = $('#prine').val();
            let ret = /^(?:0\.\d{0,1}[1-9]|(?!0)\d{1,6}(?:\.\d{0,1}[1-9])?)$/;
            if(ret.test(str)){
                $("#annotation2").html('<b style="color:black">^_^价格符合规则<b>')
                $("#prine").css({border : '2px solid #33a3dc', color : '#000'})

                
            }else {
                $("#annotation2").html('<b style="color:red">亲！请填写合法规则</b>')
                $("#prine").css({border : '2px solid red', color : 'red'})
                
                return false;
            }
          }
      })
       
       //验证商家名称
       $("#user-weibo").focus(function() {
             $("#annotation3").html('商家名字为字母、下划线、中文组成')
             $("#user-weibo").css({border : '1px solid green', color : '#000'})
       })
        $('#user-weibo').blur(function()
      { 
          if($('#user-weibo').val() == '') {
             $("#annotation3").html('<b style="color:red">亲！请填写你的商家名</b>')
             $("#user-weibo").css({border : '2px solid red', color : 'red'})
          }else {
            let str = $('#user-weibo').val();
            let ret = /^[\u4E00-\u9FA5A-Za-z0-9_]+$/;
            if(ret.test(str)){
                $("#annotation3").html('<b style="color:black">^_^商家名称符合规则<b>')
                $("#user-weibo").css({border : '2px solid #33a3dc', color : '#000'})
                
            }else {
                $("#annotation3").html('<b style="color:red">亲！请填写合法规则</b>')
                $("#user-weibo").css({border : '2px solid red', color : 'red'})
                return false;
            }
          }
      })

      $('#but').click(function(){
           if($('#user-name').val() == '')
           {
             $("#annotation1").html('<b style="color:red">该字段必须填写</b>')
             $("#user-name").css({border : '2px solid red', color : 'red'})
              
           }else if($('#prine').val() == '')
           {
             $("#annotation2").html('<b style="color:red">该字段必须填写</b>')
             $("#prine").css({border : '2px solid red', color : 'red'})

           }else if($('#user-weibo').val() == '')
           {
             $("#annotation3").html('<b style="color:red">亲！请填写你的商家名</b>')
             $("#user-weibo").css({border : '2px solid red', color : 'red'})
           }else {

             let cid = $('#cid option:selected').val();
             let name = $('#user-name').val();
             let price = $('#prine').val();
             let company = $('#user-weibo').val();
             let status = $('#test option:selected' ).val();
              $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type:'post',
                url: '/admin/goods/addSub',
                dataType:'json',
                data:{
                    cid : cid,
                    name : name,
                    price : price,
                    company : company,
                    status : status
                },
                success:function(res){
                    if(res){
                        document.location.replace('/admin/goods')
                    }              
                },
                error:function(err){
                   if(err){
                       let errs = err.responseJSON.errors
                        for( e in errs) {
                            $('.show').css('display','block');
                            $('<p>'+ errs[e][0] +'</p>').appendTo('.show');
                        }
                   }
                }
            });
            return false;
               }
      })
</script>
@endsection