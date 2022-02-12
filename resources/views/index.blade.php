@php
$title = 'ホーム'
@endphp


@extends('default')
<style>
  /* content */
  .content {
    width: 100%;
    height: 82%;
    background-color: #F5F5F5;
    text-align: center;
  }

  .user-name h1 {
    font-size: 22px;
    margin: 30px 0 60px 0;
    font-weight: bold;
  }

  .index-content {
    width: 100%;
    padding: 30px 0;
  }

  .attendance-button table {
    margin: 0 auto;
    padding: 20px 0;
  }

  .attendance-button td {
    padding: 10px 20px;
  }

  .attendance-button button {
    border: none;
    padding: 60px 120px;
    background-color: white;
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
<div class="index-content">
  <div class="user-name">
    <h1>{{ $user->name }}さんお疲れ様です</h1>
    <!--<p class="user-name" id="timer" type="hidden"></p>-->
    @if(session('error'))
    <p class="user-error-start">{{session('error')}}</p>
    @endif
  </div>
  <div class="attendance-button">
    <table>
      <tr>
        <td>
          <form action="/start" method="POST" name="btn_start">
            @if(Session::has('start_time') || Session::has('rest_start') || Session::has('rest_end') || Session::has('end_time'))
            <button type="submit" id="btn_start" disabled>勤務開始</button>
            @else
            @csrf
            @method('POST')
            <button type="submit" id="btn_start">勤務開始</button>
            @endif
          </form>
        </td>
        <td>
          <form action="/end" method="POST" name="btn_end">
            @csrf
            @if(Session::has('rest_end'))
            <button type="submit" id="btn_end">勤怠終了</button>
            @elseif(!Session::has('start_time'))
            <button type="submit" id="btn_end" disabled>勤怠終了</button>
            @else
            @method('POST')
            <button type="submit" id="btn_end">勤怠終了</button>
            @endif
          </form>
        </td>
      </tr>
      <tr>
        <td>
          <form action="/reststart" method="POST">
            @csrf
            @if(Session::has('rest_end'))
            <button type="submit" id="btn_rest_start">休憩開始</button>
            @elseif(!Session::has('start_time') || Session::has('rest_start'))
            <button type="submit" id="btn_rest_start" disabled>休憩開始</button>
            @else
            @csrf
            @method('POST')
            <button type="submit" id="btn_rest_start">休憩開始</button>
            @endif
          </form>
        </td>
        <td>
          <form action="/restend" method="POST">
            @csrf
            @method('POST')
            @if(!Session::has('start_time') && !Session::has('rest_start'))
            <button type="submit" id="btn_rest_end" disabled>休憩終了</button>
            @elseif(Session::has('start_time'))
            <button type="submit" id="btn_rest_end" disabled>休憩終了</button>
            @else
            <button type="submit" id="btn_rest_end">休憩終了</button>
            @endif
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>
@endsection

@section('footer')
<small>Atte,inc</small>
@endsection

<script>
  function func1() {
    document.getElementById("btn_start").disabled = true;
    document.getElementById("btn_end").disabled = false;
    document.getElementById("btn_rest_start").disabled = false;
    document.getElementById("btn_rest_end").disabled = true;
    //document.btn_start.submit();
  };

  function func3() {
    document.getElementById("btn_rest_start").disabled = true;
    document.getElementById("btn_rest_end").disabled = false;
  }

  function func4() {
    document.getElementById("btn_rest_end").disabled = true;
    document.getElementById("btn_rest_start").disabled = false;
  }

  function func2() {
    document.getElementById("btn_end").disabled = true;
    document.getElementById("btn_start").disabled = false;
    document.getElementById("btn_rest_start").disabled = true;

  }
  //document.getElementById("btn-end").disabled = false;
  //}

  //function func2() {
  //document.getElementById("btn-start").disabled = false;
  //document.getElementById("btn-end").disabled = true;
  //}

  // 1秒毎に実行
  window.setInterval(function() {
    //ID名timerの要素の内容に、現在時刻を出力
    document.getElementById("timer").innerHTML = new Date().toLocaleString();
  }, 1000);


  //const startWorking = document.getElementById('btn_start');
  //const endWorking = document.getElementById('btn_end');

  //const startBrake = document.getElementById('btn_rest_start');
  //const endBrake = document.getElementById('btn_rest_end');
</script>