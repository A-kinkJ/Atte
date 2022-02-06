@php
$title = '日付一覧'
@endphp

@extends('default')
<style>
  /* content */
  .content {
    width: 100%;
    height: 80%;
    background-color: #F5F5F5;
    text-align: center;
  }

  .attendance-date {
    padding-top: 10px;
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .attendance-date p {
    font-size: 20px;
  }

  .attendance-date input {
    text-align: center;
    margin: 20px 40px;
    padding: 5px 10px;
    background-color: white;
    border: 1px solid blue;
    color: blue;
  }

  table {
    width: 90%;
    margin: 0 auto;
    padding: 10px 0;
    border-collapse: collapse;
  }

  table th {
    padding: 15px 0;
    border-top: 1px solid #9E9E9E;
    font-size: 16px;
  }

  table td {
    padding: 15px 0;
    border-top: 1px solid #9E9E9E;
    text-align: center;
    font-size: 14px;
  }
</style>

@section('header')
<nav>
  <div class="logo">
    <h1>Atte</h1>
  </div>
  <ul>
    <li>
      <form action="/" method="POST" name="homeform">
        @csrf
        <a href="javascript:homeform.submit()">ホーム</a>
      </form>
    </li>
    <li>
      <form action="/attendance/{attendance}" method="GET" name="attendanceform">
        @csrf
        <a href="javascript:attendanceform.submit()">日付一覧</a>
      </form>
    </li>
    <li>
      <form action="/logout" method="POST" name="logoutform">
        @csrf
        <a href="javascript:logoutform.submit()">ログアウト</a>
      </form>
    </li>
  </ul>
</nav>
@endsection

@section('content')
<div class="attendance-date">
  <form action=" /attendance/{attendance}" method="POST">
    @csrf
    <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
    <input type="hidden" class="flg" name="dayflg" value="back">
    <input type="submit" name="" value="<" class="day-list" id="back_btn">
  </form>
  </form>
  <p>{{$today}}</p>
  <form action=" /attendance/{attendance}" method="POST">
    @csrf
    <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
    <input type="hidden" class="flg" name="dayflg" value="next">
    <input type="submit" name="" value=">" class="day-list" id="next_btn">
  </form>
</div>
<div class="attendance-table">
  <table>
    <tr>
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>
    @foreach($items as $item)
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ substr($item->begin_time,10)}}</td>
      <td>{{ substr($item->end_time,10)}}</td>
      <td>{{ $item->getRest() }}</td>
      <td></td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
@endsection