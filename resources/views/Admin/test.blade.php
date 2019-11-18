<div class="alert alert-danger" id="errors" style="display: none" role="alert">
    
</div>
<form id="upload">
  <div class="form-group fileList">
    <label for="exampleInputFile">图片</label>
    <input type="file" class="file" name="pic">
  </div>
</form>
  <button id="btn" class="btn btn-default">Submit</button>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
    $('#btn').click(function(){
        var file = $('.file');

        // 如果想要提交文件就必须使用这个类来创建参数
        var fd = new FormData();

        fd.append('_token', '{{csrf_token()}}')

        fd.append('pic', file[0].files[0]);

        $.ajax({
            type: 'post',
            url: '/admin/test2',
            processData: false, // 关闭data数据格式化
            contentType: false, // 不要设置数据类型 enctype
            data: fd,
            success: function (res) {

            },
            error: function (err) {
            }
        })

        return false;
    });
</script>
