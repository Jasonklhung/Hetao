<!DOCTYPE html>
<html>

<head>
    <title>賀桃</title>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hetao.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="js/shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
        <script src="js/media.js"></script>
    <![endif]-->
</head>

<body>
    <div id="login-wrapper">
        <div class="login">
            <div class="login-container">
                <p>賀桃工單管理系統</p>
                
                <span>跳轉中...</span>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
</body>

</html>
<script type="text/javascript">
    liff.init(function (data) {
        initializeApp(data);
    });

    function initializeApp(data) {
       // document.getElementById('input1').value = data.context.userId;
       // alert(data.context.userId)

       $.ajax({
            method:'get',
            url:'{{ route('ht.Auth.getReport') }}',
            data:{
                '_token': '{{ csrf_token() }}',
                'token':data.context.userId,
            },
            dataType:'json',
            success:function(data){
                window.location = data.redirect;
            }
        })
    }
    
</script>