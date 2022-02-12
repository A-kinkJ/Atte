@php
$title = 'ログイン'
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

    table {
        margin: 0 auto;
    }

    .login-content {
        width: 100%;
        padding: 40px 0;
    }

    .login-title h1 {
        font-size: 22px;
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

    .login-submit input {
        width: 350px;
        height: 40px;
        color: white;
        background-color: blue;
        border: none;
        border-radius: 5px;
    }

    .register-button p {
        color: #757575;
        padding-top: 10px;
    }

    .register-button a {
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
@endsection

@section('content')
<div class="content">
    <div class="login-content">
        <div class="login-title">
            <h1>ログイン</h1>
        </div>
        <!-- Validation Errors -->
        <div class="content-form" :errors="$errors">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <table>
                    <!-- Email Address -->
                    <tr>
                        <th>
                            <input id="email" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required autofocus />
                        </th>
                    </tr>
                    <tr>
                        <!-- Password -->
                        <th>
                            <input id="password" type="password" name="password" placeholder="パスワード" :value="old('password')" required autocomplete="current-password" />
                        </th>
                    </tr>
                </table>
                <!-- Remember Me -->
                <!--<div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif -->

                <div class="login-submit">
                    <input type="submit" value="{{ __('ログイン') }}">
                </div>

                <div class="register-button">
                    <p>アカウントをお持ちでない方はこちら</p>
                    <a href="{{ route('register') }}">
                        {{ __('会員登録') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<small>Atte,inc</small>
</div>
@endsection