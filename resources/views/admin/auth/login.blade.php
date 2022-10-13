<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SI KATEKISAN JEMAAT GPM RUMAH TIGA | Masuk</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/iCheck/square/blue.css">


    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script nonce="8ac1ed81-214a-4161-b197-cc651a289706">
        (function(w, d) {
            ! function(a, e, t, r) {
                a.zarazData = a.zarazData || {};
                a.zarazData.executed = [];
                a.zaraz = {
                    deferred: []
                    , listeners: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return function() {
                        var t = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e
                            , a: t
                        })
                    }
                };
                for (const e of ["track", "set", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                a.zaraz.init = () => {
                    var t = e.getElementsByTagName(r)[0]
                        , z = e.createElement(r)
                        , n = e.getElementsByTagName("title")[0];
                    n && (a.zarazData.t = e.getElementsByTagName("title")[0].text);
                    a.zarazData.x = Math.random();
                    a.zarazData.w = a.screen.width;
                    a.zarazData.h = a.screen.height;
                    a.zarazData.j = a.innerHeight;
                    a.zarazData.e = a.innerWidth;
                    a.zarazData.l = a.location.href;
                    a.zarazData.r = e.referrer;
                    a.zarazData.k = a.screen.colorDepth;
                    a.zarazData.n = e.characterSet;
                    a.zarazData.o = (new Date).getTimezoneOffset();
                    a.zarazData.q = [];
                    for (; a.zaraz.q.length;) {
                        const e = a.zaraz.q.shift();
                        a.zarazData.q.push(e)
                    }
                    z.defer = !0;
                    for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith("_zaraz_"))).forEach((t => {
                        try {
                            a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
                        } catch {
                            a.zarazData["z_" + t.slice(7)] = e.getItem(t)
                        }
                    }));
                    z.referrerPolicy = "origin";
                    z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData)));
                    t.parentNode.insertBefore(z, t)
                };
                ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);

    </script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h1><b>Admin</b>SIKARI</h1>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Masuk untuk memulai sesi anda.</p>
            @if (session('status'))
            <div class="alert alert-{{ session('status') }} rounded-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('message') }}
            </div>
            @endif
            <form action="{{ route('admin.login.post') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Ingat Saya
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">MASUK</button>
                    </div>

                </div>
            </form>
        </div>

    </div>


    <script src="{{ asset('assets') }}/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="{{ asset('assets') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets') }}/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue'
                , radioClass: 'iradio_square-blue'
                , increaseArea: '20%' /* optional */
            });
        });

    </script>
</body>
</html>
