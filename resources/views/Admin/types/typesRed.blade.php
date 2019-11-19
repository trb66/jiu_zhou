@extends('Admin.index')
@section('title', '分类列表')
@section('css')
@endsection
@section('body')
   <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-body am-fr" id="war">
                <div class="am-alert show" style="display:none">
                </div>
                <form class="am-form tpl-form-border-form tpl-form-border-br">
                    <div class="am-form-group">
                        <label for="user-weibo" class="am-u-sm-3 am-form-label">编辑分类 <span class="tpl-form-line-small-title">Type</span></label>
                        <div class="am-u-sm-9">
                            <input type="text" name="name" id="user-weibo" value="{{$types->name}}"placeholder="请添加分类用点号隔开">
                            <div>
                         <input type="hidden" value="{{$types->id}}" name="id">     
                            </div>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success " id="btn">提交</button>
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
     var oldname = $('input[name=name]').val();
     console.dir(oldname);
     $('#btn').click(function(){
          var name = $('input[name=name]').val();
          var id = $('input[name=id]').val();

          if(oldname == name) {
                alert('不作任何修改，无需操作')
                document.location.replace('/admin/types')

          }else {
              $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
              $.ajax({
                     type:'post',
                     url:'/admin/types/edit',
                     dataType: 'json',
                     data:{
                        name:name,
                        id:id
                     },
                     success:function(res){
                         document.location.replace('/admin/types')
                     },
                     error:function(err){
                         $('.show').css({display: 'block'})
                         $('.show').html(err.responseJSON.msg)
                     }            
               });
        }
        
          return false;
     })
</script>
@endsection