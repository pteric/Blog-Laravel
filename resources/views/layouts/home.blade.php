<!doctype html>
<html>
<head>
    <meta charset="utf-8">
@yield('info')
    <link href="{{asset('/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/new.css')}}" rel="stylesheet">
    <script src="{{asset('/home/js/modernizr.js')}}"></script>
</head>
<body>
<header>
    <div  id="logo" style="width: 100px"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $nav)
        <a href="{{url($nav->navigation_url)}}"><span>{{$nav->navigation_name}}</span><span class="en">{{$nav->navigation_alias}}</span></a>
            @endforeach
    </nav>
</header>
@yield('content')
<footer>
    <p>Made by PT <a href="/" target="_blank">Copyright</a> <a href="/">网站统计</a></p>
</footer>
</body>
</html>