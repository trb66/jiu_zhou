@extends('Home.index')

@section('seek')
@endsection
@section('nav')
@endsection

@section('body')
    <div class="content clearfix bgf5">
        <section class="user-center inner clearfix">
            <div class="user-content__box clearfix bgf">
                <div class="title">购物车</div>              
              @if($spec->toArray()) 
                <form class="shopcart-form__box">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="150">
                                    <label class="checked-label"><input type="checkbox" class="check-all"><i></i> 全选</label>
                                </th>
                                <th width="300">商品信息</th>
                                <th width="150">单价</th>
                                <th width="200">数量</th>
                                <th width="200">现价</th>
                                <th width="80">操作</th>
                            </tr>
                        </thead>    
                        <tbody>

                       @foreach($spec as $v)
                            <input type="hidden" id="hid" value="{{$v->store_count}}">
                            <tr>
                                <th scope="row">
                                  @foreach($imgs as $gg)  
                                        @if($v->goods_id == $gg->goods_id)
                                   <label class="checked-label"><input type="checkbox" name="imgs" 
                                                              @foreach($res as $s)
                                                             @if($s->spec_id == $v->id)
                                                                data-qid="{{$s->id}}"
                                                            @endif
                                                              @endforeach
                                              
                                            ><i></i>
                                           <div class="img"><img src="/storage/{{$gg->pic}}" style="width:100px;height:100px" alt="" class="cover"></div>
                                    </label>
                                        @endif
                                  @endforeach
                                </th>
                                <td>
                                   @foreach($goods as $vv)
                                    @if($v->goods_id == $vv->id)<div class="name ep3"> {{$vv->name}} </div>@endif
                                   @endforeach
                                    <div class="type c9">规格：{{$v->key_name}}</div>
                                </td>
                                <td class="unit" data-price="{{$v->price}}">¥{{$v->price}} </td>
                                <td>
                                    <div class="cart-num__box">
                                        <input type="button" class="sub" value="-">
                                        
                                        <input type="number" class="val" @foreach($res as $s)
                                                             @if($s->spec_id == $v->id)
                                                                value="{{$s->commod}}"
                                                                data-id = "{{$s->id}}"
                                                            @endif
                                                              @endforeach
                                                               maxlength="2">
                                
                                        <input type="button" class="add" value="+">
                                    </div>
                                </td>
                                <td>¥ <span class="xianjia" data-price="{{$v->price}}">
                                                           @foreach($res as $s)
                                                             @if($s->spec_id == $v->id)
                                                             {{$v->price * $s->commod}}
                                                            @endif
                                                              @endforeach
                                </span></td>
                                <td><a href="#" onclick="ggdel(this)" @foreach($res as $s)
                                                             @if($s->spec_id == $v->id)
                                                                data-id="{{$s->id}}"
                                                            @endif
                                                              @endforeach
                                                                >删除</a></td>
                              
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="user-form-group tags-box shopcart-submit pull-right">
                        <button type="submit" class="btn">提交订单</button>
                    </div>
                    <div class="checkbox shopcart-total">
                        <label><input type="checkbox" class="check-all"><i></i> 全选</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="xuandel(this)">删除</a>
                        <div class="pull-right">
                            已选商品 <span>0</span> 件
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计（不含运费）
                            <b class="cr">¥<span class="fz24">0</span></b>
                        </div>
                    </div>
                
                    <script>
                        $(document).ready(function(){
                            var $item_checkboxs = $('.shopcart-form__box tbody input[type="checkbox"]'),
                                $check_all = $('.check-all');
                            // 全选
                            $check_all.on('change', function() {
                                $check_all.prop('checked', $(this).prop('checked'));
                                $item_checkboxs.prop('checked', $(this).prop('checked'));
                            });
                            // 点击选择
                            $item_checkboxs.on('change', function() {
                                var flag = true;
                                $item_checkboxs.each(function() {
                                    if (!$(this).prop('checked')) { flag = false }
                                });
                                $check_all.prop('checked', flag);
                            });
                            // 个数限制输入数字
                            // $('input.val').onlyReg({reg: /[^0-9.]/g});
                            // 加减个数
                            $('.cart-num__box').on('click', '.sub,.add', function() {
                                var sto = $('#hid').val();

                                var value = parseInt($(this).siblings('.val').val());
                                if ($(this).hasClass('add')) {
                                    $(this).siblings('.val').val(Math.min((value += 1),sto));
                                     var inputnum = $(this).parent().parent().children().eq(0).children().eq(1)
                                     var danprice = $(this).parent().parent().parent().children().eq(2).data('price')
                                     var xianjia = $(this).parent().parent().parent().children().eq(4).children()
                                     xianjia.html(danprice*inputnum.val())

                                    var commod = $(this).siblings('.val').val();
                                    var id = $(this).siblings('.val').data('id');
                                    $.ajax({
                                         type:'post',
                                         url: '/home/commod',
                                         headers:{'X-CSRF-TOKEN' : '{{csrf_token()}}'},
                                         data:{id:id, commod:commod},
                                         success:function(res) {
                                          
                                         },
                                         error:function(err) {
                                           
                                         }

                                    });
                                    
                                } else {
                                    $(this).siblings('.val').val(Math.max((value -= 1),1));
                                     var inputnum = $(this).parent().parent().children().eq(0).children().eq(1)
                                     var danprice = $(this).parent().parent().parent().children().eq(2).data('price')
                                     var xianjia = $(this).parent().parent().parent().children().eq(4).children()
                                     xianjia.html(danprice*inputnum.val())

                                    var commod = $(this).siblings('.val').val();
                                    var id = $(this).siblings('.val').data('id');
                                    $.ajax({
                                         type:'post',
                                         url: '/home/commod',
                                         headers:{'X-CSRF-TOKEN' : '{{csrf_token()}}'},
                                         data:{id:id, commod:commod},
                                         success:function(res) {
                                            
                                         },
                                         error:function(err) {
                                          
                                         }

                                    });
                                }
                            });
                        });
                    </script>
                </form>
              @else 
                  <span style="font-size:20px;font-style: italic;">您的购物车空空如也!快快去</span style="font-size:20px;font-style: italic;"><span style="font-size:30px;color:red"><a href="/">购物</a></span><span style="font-size:20px;font-style: italic;">吧!</span>
             @endif
            </div>
        </section>
    </div>

@endsection

@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>

<script>
    //单独删
    function ggdel(zj) {
        if(confirm("您确认删除该商品吗"))
          {
            // console.dir('确认');
            var id = $(zj).data('id');
            var dels = $(zj).parent().parent(); 

            $.ajax({
                type:'post',
                url:'/home/shopDel',
                headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                data:{
                    id:id,
                },
                success: function(res) {
                    if(res == 'yes') {
                      dels.remove()
                      var delss = $(zj).parent().parent().parent().parent().children().eq(0);
                         if(delss.length < 1){
                            
                             window.location.reload() 
                         }   
                  
                    }
                },
                error: function(err) {
                   alert(err.msg);
                    
                }
            });
          }
        return false;
    }
   //全删
   function xuandel(xuanzj) {
     var ckbox  =  $('input[name=imgs]:checked');
     //判断是否有选中的
     if(ckbox.length != 0) {

        if(confirm("您确定删除选中的商品吗"))
          {
            var cked = ckbox.parent().parent().parent();
            var ids = {};
             ckbox.each(function(i, val) {
                ids[i] = $(val).data('qid');
             })
           
             $.ajax({
                type:'post',
                url: '/home/qdel',
                headers:{
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                data:ids,
                success:function(res){
                       
                       if(res) {
                        cked.remove();
                        var chi = ckbox.parent().parent().parent().parent().children().eq(0);
                        if(chi.length < 1){
                            console.dir(123)
                           window.location.reload() 
                        }
                       }
                },
                error:function(err) {
                
                }
             });

          }
     }

     return false;
   }
//点击任何inputt的时候都算一遍有没有选中复选框的
$("input").click(function(){
        setTimeout(function(){
            var res = $('input[name=imgs]');
            var price = 0;
            var nums = 0;
            //遍历所有绑定imgs的复选框
            res.each(function() {
                if ($(this)[0].checked == true) {
                    price += $(this).parent().parent().parent().children().eq(2).data('price')*$(this).parent().parent().parent().children().eq(3).children().children().eq(1).val();
                    nums += parseInt($(this).parent().parent().parent().children().eq(3).children().children().eq(1).val())
                    
                }
            })
            $('.fz24').html(price);
            $('.pull-right').children().eq(4).html(nums);       
            
        }, 100) 
      
})

//失去焦点的时候
$('.val').blur(function(){
         //现价的
        var inputn = $(this).parent().parent().children().eq(0).children().eq(1)
        var inputnum = $(this).parent().parent().children().eq(0).children().eq(1)
      
         if(inputn.val() < 1) {
            alert('商品数量必须大于0')
            inputnum.val('1');
         }

                  var commod = inputn.val();
                  var id = inputn.data('id');
                  $.ajax({
                       type:'post',
                       url: '/home/commod',
                       headers:{'X-CSRF-TOKEN' : '{{csrf_token()}}'},
                       data:{id:id, commod:commod},
                       success:function(res) {
                         
                       },
                       error:function(err) {
    
                       }
                    });
         
         var danprice = $(this).parent().parent().parent().children().eq(2).data('price')
         var xianjia = $(this).parent().parent().parent().children().eq(4).children()
         xianjia.html(danprice*inputnum.val())

         setTimeout(function(){
            var res = $('input[name=imgs]');
            var price = 0;
            var nums = 0;
            res.each(function() {
                if ($(this)[0].checked == true) {
                    price += $(this).parent().parent().parent().children().eq(2).data('price')*$(this).parent().parent().parent().children().eq(3).children().children().eq(1).val();
                    nums += parseInt($(this).parent().parent().parent().children().eq(3).children().children().eq(1).val())
                    
                }
            })
            $('.fz24').html(price);
            $('.pull-right').children().eq(4).html(nums);
            
        }, 100) 
})

//提交数据
$('.btn').click(function() {
    var check  =  $('input[name=imgs]:checked');
    if(check.length != 0) {
     check.each(function(){
     })
     //拿每个选中的id
     var id = [];
     for(var i = 0; i<check.length;i++) {
         id[i] = $(check[i]).data('qid');
      
     }
     
     $.ajax({
        type: 'post',
        url: '/home/payadd',
        headers:{'X-CSRF-TOKEN' : '{{csrf_token()}}'},
        data:{id:id},
        success:function(res) {
           console.dir(res);
         if(res == 'yes') {
           location.href = '/home/shopcar_pay';
         }

        },
        error:function(err) {

        }
     })
   }else {
    console.dir(123);
   }
  return false;
})
</script>
@endsection
