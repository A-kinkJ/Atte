@php
$title = 'ユーザー一覧'
@endphp

@extends('default')
<style>
  /* content */
  .content {
    justify-content: center;
    width: 100%;
    background-color: #F5F5F5;
    text-align: center;
    flex-grow: 1;
  }

  .user-name-ttl h2 {
    padding-top: 25px;
  }

  .user-name ul {
    width: 50%;
    margin: 0 auto;
    list-style: none;
    padding-top: 10px;
    margin-bottom: 30px;
  }

  .user-name li {
    border-top: 2px solid #2196F3;
    border-left: 2px solid #2196F3;
    border-right: 2px solid #2196F3;
    padding: 7px 0;
  }

  .user-name li:first-child {
    border-radius: 15px 15px 0 0;
  }

  .user-name li:last-child {
    border-bottom: 2px solid #2196F3;
    border-radius: 0 0 15px 15px;
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
      <form action="/userList" method="GET" name="userList">
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
<div class="user-name">
  <div class="user-name-ttl">
    <h2>ユーザー名一覧</h2>
  </div>
  <ul>
    @foreach($items as $item)
    <li>{{ $item->name }}</li>
    @endforeach
  </ul>
</div>
<div class="d-flex justify-content-center">
  {{ $items->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection

@section('footer')
<small>Atte,inc</small>
@endsection