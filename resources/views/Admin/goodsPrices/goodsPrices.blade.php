@extends('Admin.index')
@section('title', '商品列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('body')
  
   <div style="background:#fff;margin-top:20px; margin-left:15px;padding:10px">
        商品名称：{{$good->name}}
        
   </div>
@endsection
@section('js')
@endsection