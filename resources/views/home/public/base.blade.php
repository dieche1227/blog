<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit"/>
    <meta name="description" content=""/>
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache"/> 
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache"/> 
    <meta HTTP-EQUIV="Expires" CONTENT="0"/> 
@section('title')
    <title></title>
@show 
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/reset.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/header_nav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/footer.css')}}"/>
@show
</head>
<body class="bg-cf2f2f2">
	@include('home.public.header')
    @section('main')
    @show
    @include('home.public.footer')
</body>
</html>
@section('js')
 	<script src="{{asset('static/lib/jquery-1.11.1.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('static/lib/bootstrapvalidator/dist/js/bootstrapValidator.js')}}" type="text/javascript" charset="utf-8"></script>
@show
 	












 
  
  
  

