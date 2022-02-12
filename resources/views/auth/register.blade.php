@php
$title = '会員登録'
@endphp

@extends('default')
<style>
    body {
        margin: 0;
        padding: 0;
    }

    /* header */
    nav {
        display: flex;
    }

    .logo h1 {
        margin: 0px;
        padding: 10px 0;
    }

    ul {
        display: flex;
        justify-content: flex-end;
        list-style: none;
        align-items: center;
    }

    li {
        padding-left: 3%;
    }

    li a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    /* content */
    .content {
        width: 100%;
        height: 82%;
        background-color: #F5F5F5;
        text-align: center;
    }

    .register-content {
        width: 100%;
        padding: 25px 0;
    }

    .register-title h1 {
        font-size: 22px;
        text-align: center;
    }

    .content-form input {
        width: 350px;
        height: 40px;
        margin-bottom: 25px;
        border-radius: 5px;
        background-color: #F5F5F5;
        border: 2px solid #757575;
        padding-left: 10px;
    }

    table {
        margin: 0 auto;
    }

    .register-submit input {
        width: 350px;
        height: 40px;
        color: white;
        background-color: blue;
        border: none;
        border-radius: 5px;
    }

    .login-button p {
        color: #757575;
    }

    .login-button a {
        text-decoration: none;
        color: blue;
        font-weight: bold;
    }
</style>

@section('header')
<nav>
    <div class="logo">
        <h1>Atte</h1>
    </div>
</nav>
</div>
@section('content')
<div class="content">
    <div class="register-content">
        <div class="register-title">
            <h1>会員登録</h1>
        </div>

        <!-- Validation Errors -->
        <div class="content-form" :errors="$errors">

            <form method="POST" action="/register">
                @csrf
                <table>
                    <tr>
                        <td>
                            <!-- Name -->
                            <input id="name" type="text" name="name" placeholder="名前" :value="old('名前')" required autofocus />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Email Address -->
                            <input id="email" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Password -->
                            <input id="password" type="password" name="password" placeholder="パスワード" required autocomplete="new-password" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Confirm Password -->
                            <input id="password_confirmation" type="password" placeholder="確認用パスワード" name="password_confirmation" required />
                        </td>
                    </tr>
                </table>
                <div class="register-submit">
                    <input type="submit" value="{{ __('会員登録') }}">
                </div>

                <div class="login-button">
                    <p>アカウントをお持ちの方はこちら</p>
                    <a href="{{ route('login') }}">
                        {{ __('ログイン') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
@endsection