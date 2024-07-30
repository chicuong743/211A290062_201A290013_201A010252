<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<style>
body{
    background-color: #79b791;
    }
.user{
    width:300px ;
    height: 300px;
    background-color: rgb(0, 133, 120);
    justify-content: center;
    text-align: center;
    margin:20vh 40vw ;
    border-radius:10px ;
}
.user h2{
    padding-top:30px ;
    font-family:"Poppins", sans-serif;
    font-size: large;
    color: aliceblue;
}
.user_login input{
    border: none;
    padding: 5px;
    width: 80%;
    height:30px ;
    border-radius: 5px;
    background: #EAB69F;
}
.user_login input:first-child{
    margin:20px 0 ;
}
.user button{
    border: none;
    border-radius: 5px;
    padding:5px 30px ;
    margin-top: 50px;
    font-weight: bold;
}
.user button:hover{
    background-color: rgb(22, 0, 220);
}
</style>
<body>

<div class="user">
    <h2>ĐĂNG NHẬP</h2>
    <div class="user_login">
        <form action="/checklogin" method="post">
            <input type="text" name="email" placeholder="  Email">
            <input type="password" name="password" placeholder="  Password">
            <button type="submit">Login <i class="ri-login-box-line"></i></button>
        @csrf
        </form>
    </div>
    @if ($errors->any())
        <div style="justify-content: center; color:red; padding-top:5vh;position: fixed;" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
            </ul>
        </div>
    @endif
</div>
</body>
</html>
