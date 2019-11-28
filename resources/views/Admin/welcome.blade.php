@extends('Admin/index')

@section('css')
<style type="text/css">
        .demo{padding:2em 0; background: #2c2c54; }
        .text-effect{
            color: #fff;
            font-family: 'Monoton', cursive;
            font-size: 100px;
            font-weight: 700;
            text-align: center;
            margin: 0 auto;
            display: block;
            position: relative;
        }
        .text-effect span{ animation: animate linear 2000ms infinite; }
        .text-effect span:nth-child(1n){ animation-delay: 0s; }
        .text-effect span:nth-child(2n){ animation-delay: 100ms; }
        .text-effect span:nth-child(3n){ animation-delay: 200ms; }
        .text-effect span:nth-child(4n){ animation-delay: 300ms; }
        .text-effect span:nth-child(5n){ animation-delay: 400ms; }
        .text-effect span:nth-child(6n){ animation-delay: 500ms; }
        .text-effect span:nth-child(7n){ animation-delay: 600ms; }
        .text-effect span:nth-child(8n){ animation-delay: 700ms; }
        .text-effect span:nth-child(9n){ animation-delay: 800ms; }
        .text-effect span:nth-child(10n){ animation-delay: 900ms; }
        @keyframes animate{
            0%{ opacity: 0.3; }
            100%{
               opacity:1;
               text-shadow: 0 0 80px Red,0 0 30px orange,0 0 6px DarkRed;
            }
        }
        @media only screen and (max-width: 990px){
            .text-effect{ font-size: 65px; }
        }
        @media only screen and (max-width: 767px){
            .text-effect{ font-size: 50px; }
        }
        @media only screen and (max-width: 479px){
            .text-effect{ font-size: 36px; }
        }
        @media only screen and (max-width: 359px){
            .text-effect{ font-size: 27px; }
        }
    </style>
@endsection

@section('body')
<div class="htmleaf-container">
        <div class="demo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-effect">
                        <span>欢</span>
                        <span>迎</span>
                        <span>来</span>
                        <span>到</span>
                        <span>后</span>
                        <span>台</span>
                        <span>首</span>
                        <span>页</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection