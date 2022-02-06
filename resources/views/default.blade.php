<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    nav {
      display: flex;
      padding: 0 3%;
    }

    .logo h1 {
      margin: 0px;
      padding: 10px 0;
    }

    ul {
      width: 100%;
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

    .footer {
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="header">
    @yield('header')
  </div>
  <div class="content">
    @yield('content')
  </div>
  <div class="footer">
    <small>@yield('footer')</small>
  </div>
</body>

</html>