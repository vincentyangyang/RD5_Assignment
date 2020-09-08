@extends('layouts.master')

@section('title','網路銀行')

@section('css')
    #sign{
        width: 10px;
        height: 20px; 
        background-color: #00994e;
        float: left;
        margin-top: 2px;
        margin-right: 3px;
    }

    #eye{
        position: absolute;
        right: 0px;
        margin-right:100px; 
    }

    #TWDdeposit{
        position: absolute;
        right: 0px;
        margin-right:110px; 
    }

    #information{
        background-color: white;
        height: 300px;
        box-shadow: 0px 5px 15px -10px rgba(0,0,0,0.55);
    }

    #content{
        margin: auto;
        margin-top: 50px;
    }
@endsection

@section('content')
    <div id="content" class="col-6">
        
        <div>
            <div id="sign"></div>
            <h5>我的帳號總覽</h5>
        </div>

        <div id="information">
            <div id="TD-Box" style="margin-bottom: 60px;">
                <div style="margin-left: 80px;padding-top:30px;">
                    <p style="float: left;margin-top: 15px;">台幣資產總額</p>
                    <span class="balanceOne text-right">{{ $customer['balance'] }}</span>
                </div>
                <button id="eye" onclick="hide()" style="border: none;margin-top:15px;" type="button"><img src="<?= asset('bower/image/eye.png') ?>" style="height:20px; width:29px;"> </button>
        </div>

        <hr style="margin-bottom: 30px;">

        <div id="TD-Box"> 
            <div calss="col-6" style="margin-left: 80px;">
                <p style="float: left;margin-top: 3px; ">活期儲蓄薪資轉帳存款</p>
                <span class="balanceTwo text-right"></span>
                <a id="TWDdeposit" href="action?action=deposit" class="btn btn-sm btn-outline-success">台幣存款</a>
            </div>
        </div>  
        
    </div>
@endsection

@section('script')
    $('.index').addClass("active");

    var flag = "{{ $customer['display'] }}";

    display();

    function display(){
        if (flag == 1){
            $(".balanceOne").prop("style","");
            $(".balanceTwo").prop("style","");
            $(".balanceOne").html('{{ $customer["balance"] }}' +"<span style='font-size: 25px;'>元</span>");
            $(".balanceTwo").html('{{ $customer["balance"] }}' +"元");
            $(".balanceOne").css({"font-size": "35px","color": "#73B839","margin-right":"10px","float":"left","width":"370px"});
            $(".balanceTwo").css({"font-size": "20px","float":"left","width":"260px"});
        }else{
            $(".balanceOne").html("*******");
            $(".balanceTwo").html("*******");
            $(".balanceOne").css({"font-size": "35px","color": "#73B839","margin-right":"10px","float":"left","padding-left":"270px","margin-top":"10px"});
            $(".balanceTwo").css({"font-size": "20px","float":"left","padding-left":"210px","margin-top":"7px"});
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function hide(){
        if (flag == 1){
            flag = 0;
            display();

            $.ajax({
            type: "post",
            url: "{{ route('indexPost') }}",
            data: {display: 0}
            })
        }else{
            flag = 1;
            display();

            $.ajax({
                type: "post",
                url: "{{ route('indexPost') }}",
                data: {display: 1}
            })
        }
    }
@endsection