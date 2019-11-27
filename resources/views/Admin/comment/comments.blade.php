@extends('Admin.index')


@section('body')

        <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">评论列表</div>
                            </div>
                              <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                  <div class="am-form-group">
                                  </div>
                              </div>       
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                    </div>
                                </div>                   
                               <form>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">

                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field " name="text" id="text" >
                                        <span class="am-input-group-btn">
                                         <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" id="btu" type="button"></button>
                                        </span>
                                    </div>
                                </div>
                               </form>
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th>留言编号</th>
                                                <th>用户名</th>
                                                <th>商品名</th>
                                                <th>评论内容</th>
                                                <th>评论时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($comments as $c)
                                            <tr class="gradeX">
                                                <td>{{$c->id}}</td>
                                                <td>{{$c->username->username}}</td>
                                                <td>{{$c->gname->name}}</td>
                                                <td>{{$c->text}}</td>
                                                <td>{{$c->created_at}}</td>
                                                <td>
                                                    <div class="tpl-table-black-operation">
                                                        <a href="/admin/comments/reply/?id={{$c->id}}&uid={{$c->uid}}&gid={{$c->gid}}&oid={{$c->oid}}">
                                                            <i class="am-icon-pencil"></i> 回复
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
@endsection

@section('js')
<script src="/Admin/assets/js/jquery.min.js"></script>
<script>
    $('#btu').click(function(){
        var username = $('#text').val();
        console.dir(username)
        location.href = '/admin/comments/?username='+ username;

    })

</script>

@endsection