@php
$title = '日付一覧'
@endphp

@extends('default')
<style>
  /* content */
  .content {
    width: 100%;
    background-color: #F5F5F5;
    text-align: center;
    flex-grow: 1;
  }

  .attendance-date {
    padding-top: 10px;
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .attendance-date p {
    font-size: 20px;
    margin-top: 20px;
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
    text-align: center;
    margin-bottom: 30px;
  }

  .attendance-table th {
    padding: 20px 0;
    border-top: 1px solid #9E9E9E;
    font-size: 16px;
  }

  table td {
    padding: 20px 0;
    border-top: 1px solid #9E9E9E;
    text-align: center;
    font-size: 14px;
  }

  .pagination-nav li {
    background-color: white;
    border-top: 1px solid #F5F5F5;
    border-bottom: 1px solid #F5F5F5;
    border-left: 1px solid #F5F5F5;
    /* padding: 5px 15px 5px 15px; */
    color: #1565C0;
    font-size: 12px;
  }

  @media screen and (max-width: 480px) {
    .attendance-date input{
      padding: 2px 7px;
    } 
    .attendance-table th {
      font-size: 12px;
    }

    .attendance-table td {
      font-size: 10px;
    }
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
      <form action="/attendance" method="GET" name="attendanceform">
        @csrf
        <a href="javascript:attendanceform.submit()">日付一覧</a>
      </form>
    </li>
    <li>
      <form action="/userlist" method="GET" name="userList">
        @csrf
        <a href="javascript:userList.submit()">ユーザー一覧</a>
      </form>
    </li>
    <li>
      <form action="/userattendance" method="GET" name="userAttendanceList">
        @csrf
        <a href="javascript:userAttendanceList.submit()">ユーザーの勤怠</a>
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
  <form action=" /attendance" method="POST">
    @csrf
    <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
    <input type="hidden" class="flg" name="dayflg" value="back">
    <input type="submit" name="" value="<" class="day-list" id="back_btn">
  </form>
  </form>
  <p>{{$today}}</p>
  <form action=" /attendance" method="POST">
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
      <td>{{ $item->user->name }}</td>
      <td>{{ substr($item->begin_time,10)}}</td>
      <td>{{ substr($item->end_time,10)}}</td>
      <td>{{ $item->getRest() }}</td>
      <td>{{ $item->attendanceTime() }}</td>
    </tr>
    @endforeach
  </table>
  <div class="d-flex justify-content-center">
    {{ $items->appends($today)->links('vendor.pagination.bootstrap-4') }}
  </div>
</div>

@endsection
@section('footer')
<small>Atte,inc</small>
@endsection