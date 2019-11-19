@extends('Admin.index')
@section('title', '图片列表')
@section('css')

@endsection
@section('body')

  <form class="am-form tpl-form-border-form for">
            <div class="am-form-group">
                <label for="user-phone" class="am-u-sm-12 am-form-label am-text-left">选中模型分类<span class="tpl-form-line-small-title">Types</span></label>
                <div class="am-u-sm-12  am-margin-top-xs">
                    <select name='types'  data-am-selected="{searchBox: 1}" style="display: none;">
                        @foreach($types as $v)

                           @php
                          $sum = substr_count($v->path, ',');
                          $str = str_repeat('**', ($sum-1)*2); 
                          @endphp
                          @if($sum == 3)

                           <option value="{{$v->id}}">┟-{{$str}}{{$v->name}}</option>
                          @endif

                        @endforeach
                
                    </select>
                </div>
            </div>

<div style="line-height:40px; height:40px;background:#ccc">
    <span style="margin-left:20px"> 规格名称<span style="font-size:10px">规格名只能是中文、字母和下划线</span></span>
    <span style="margin-left:200px">规格值<span style="font-size:10px">属性值只能由中文、数字、字母和下划线</span></span>
</div>
<div class="speci" style="height:200px; background:#fff;padding:20px">
   <div class="am-form-group am-form-success" style="display:inline-block">
    <input style="width:150px;" type="text" id="doc-ipt-success" class="am-form-field">
  </div>
<div class="am-form-group am-form-success clo" style="display:inline-block;margin-left:180px;">
    <input type="text" class="add" name="time[]" style="width:100px;display:inline-block">
</div>
<button id="addval" class="am-btn am-btn-primary am-btn-xs">添加</button>
<div style="margin-left:1000px;margin-top:70px">
<button  type="button" id="add" class="am-btn am-btn-warning am-round">提交</button>

</div>
</div>

            
        </form>    

@endsection
@section('js')
<script src="/plug/jQ/jquery-1.12.4.min.js"></script>·
<script>

  $('#addval').click(function(){
      if($('.add:last').val() == '') {
        alert('值不能为空');
        return false;
      }else {
       $('.add:first').clone().val('').appendTo('.clo');
        
      }

     return false;
  })

  $('#add').click(function(){
      var type_id = $('select[name=types] :selected').val();
      var name = $('#doc-ipt-success').val();
      var times = $('.add');
      var data = new FormData();
          data.append('type_id', type_id);
          data.append('name', name);
          times.each(function(k){
            // console.dir(k);
            // console.dir($(this).val())
            data.append('time['+ k +']', $(this).val())           
          })

      if(name == '') 
      {
        alert('规格名称不能为空');
        return false;
      }else if ($('.add').val() == '')
      {
         alert('规格值不能为空');
         return false;
      }else {
        $.ajax({
          type: 'post',
          url: '/admin/specsItems/addSub',
          headers:{
               'X-CSRF-TOKEN' : '{{csrf_token()}}',
          },
          processData: false, //关闭数据格式化
          contentType: false,  //不要设置数据类型
          data: data,
          success: function(res) {
            if(res == 'yes') {
              alert('规格属性添加成功,快快去为您的商品添加规格把')
              location.href = '/admin/goods';
            }
          },
          error: function(err) {
               alert(err.responseJSON.errors.name);
              
          }

        });
        return false;
      }

  })


</script>

@endsection