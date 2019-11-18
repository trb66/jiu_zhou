@extends('Admin.index')
@section('title', '商品列表')
@section('css')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('body')
  

<div class="row-content am-cf" style="background:#fff;margin-top:20px;margin-left:15px">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <div style="margin-bottom:20px">
        商品名称：{{$good->name}}
    </div>   
       <div class="am-form-group">
        <label for="user-phone" class="am-u-sm-3 am-form-label">选择您的规格名称 <span class="tpl-form-line-small-title">Author</span></label>
        <div class="am-u-sm-9" style="margin-right:310px">
        <select data-am-selected="{searchBox: 1}" style="display: none;">
       @foreach($specs as $v)
        <option value="{{$v->id}}">-{{$v->name}}</option>
       @endforeach
        </select>

        </div>
        </div>
      </div>
   </div>
</div>
@endsection
@section('js')
@endsection