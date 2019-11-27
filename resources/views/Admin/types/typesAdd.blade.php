@extends('Admin.index')
@section('title', '添加顶级分类')
@section('css')
<style>
   .show{display: none}
</style>
@endsection
@section('body')
 <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-body am-fr" id="war">
                <div class="am-alert show" v-bind:style="show">
                  @{{ err }}
                </div>
                <form class="am-form tpl-form-border-form tpl-form-border-br">
                    <div class="am-form-group">

                        <label for="user-weibo" class="am-u-sm-3 am-form-label">添加顶级分类 <span class="tpl-form-line-small-title">Type</span></label>
                        <div class="am-u-sm-9">
                            <input type="text" id="user-weibo" v-model="message" placeholder="请填写顶级分类名">
                            <div>

                            </div>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" @click="load" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script src="/plug/Vue/axios.min.js"></script>
<script src="/plug/Vue/vue.js"></script>
<script>

     var user = new Vue({
             el: '#war',
             data:{
               err:'',
               message: '',
               show: 'display:none'
             },
             methods:{
                    load:function(){
                    let data = new FormData()
                    data.append('name', user.message)  //拿input里的值，并命名为name
                    axios({
                        method:'post',  
                        url: '/admin/types/store',   
                        data: data,
                    })
                    .then(function(res) {
                        if(res) {

                            if(confirm("添加成功！是否继续添加")) {
                                location.href = '/admin/types/add';
                              }else {
                                location.href = '/admin/types';  //添加成功跳转到列表页
                              }
                        }
                    })
                    .catch(function(err){
                        user.show = 'display:block'  //显示警告窗
                        user.err = err.response.data.msg //返回错误信息

                    })
                }

             }

     })

</script>
@endsection