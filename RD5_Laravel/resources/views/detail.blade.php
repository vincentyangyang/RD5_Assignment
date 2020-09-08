@extends('layouts.master')

@section('title','明細')

@section('content')
    <div style="margin-top: 30px;" class="container">

        <h2 align="center" style="padding-top:20px;">明細</h2>
             
        <table style="margin-top: 50px;" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>日期</th>
                    <th>提出</th>
                    <th>存入</th>
                    <th>餘額</th>
                    <th>備註</th>
                </tr>
            </thead>

            <tbody>
                @foreach($customer as $row)
                    <tr>
                      <td>{{$row['date'] }}</td>
                      <td>{{ $row['action']=="withdrawal" ? $row["cash"]:"" }}</td>
                      <td>{{ $row['action']=="deposit" ? $row["cash"]:"" }}</td>
                      <td>{{ $row['nowBalance'] }}</td>
                      <td>{{ $row['remarks'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@section('script')
    $('.detail').addClass("active");
@endsection