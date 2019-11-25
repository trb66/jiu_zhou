<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
</head>
<body>
    <form onsubmit='return false;'>
        <input type="text" name="name">
        <button id='btn'>提交</button>
    </form>
    <script type="text/javascript">
        $('#btn').click(function() {
            var d = $('input[name=name]').val();
            console.log(d);

            // 发起ajax请求
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                type: 'post',
                url: '/home/test',
                data: {
                    d: d,
                },
                success: function(res) {
                    console.dir(JSON.parse(res));
                },
                error: function(err) {
                    console.log(err);
                }
            });
        })
    </script>
</body>
</html>