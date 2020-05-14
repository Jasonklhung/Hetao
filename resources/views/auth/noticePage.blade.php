<?php
    $id = $_GET['id']
?>
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
    <!-- <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script> -->
    <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
</body>

</html>
<script type="text/javascript">
    window.onload = function (e) {
        liff
        .init({
            liffId: "1654117129-k3GW53AO"
        })
        .then(() => {
                // start to use LIFF's api

                // const accessToken = liff.getAccessToken();

                liff.getProfile().then(function (profile) {
                    initializeApp(profile.userId);
                }).catch(function (error) {
                    // window.alert('Error getting profile: ' + error);
                });
            })
        .catch((err) => {

        });
    };
    function initializeApp(userId) {

        var id = '<?php echo $id ?>';

         $.ajax({
            method:'get',
            url:'{{ route('ht.Auth.getNoticePage') }}',
            data:{
                '_token': '{{ csrf_token() }}',
                'token':userId,
                'id':id
            },
            dataType:'json',
            success:function(data){
                window.location = data.redirect;
            }
        })
    }
</script>