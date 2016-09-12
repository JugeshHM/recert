<!doctype html>
<html data-ng-app="recert" data-ng-strict-di>
    <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" />
        <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
        <title>Recert</title>
        <base href='/'></base>
        <!--[if lt IE 10]>
        <script type="text/javascript">document.location.href = '/unsupported-browser'</script>
        <![endif]-->
    </head>
    <body>
        <recert-navbar data-ng-if="logged"></recert-navbar>
        <div class="section content">
            <div class="container" ui-view="main"></div>
        </div>
        <footer class="section u-full-width">
            <div class="container">
                <div class="row">
                    <p>&copy; Copyright 2016</p>
                </div>
            </div>
        </footer>
        <script src="{!! asset('js/vendor.js') !!}"></script>
        <script src="{!! asset('js/partials.js') !!}"></script>
        <script src="{!! asset('js/app.js') !!}"></script>
        {{--livereload--}}
        @if ( env('APP_ENV') === 'local' )
        <script type="text/javascript">
            document.write('<script src="'+ location.protocol + '//' + (location.host.split(':')[0] || 'localhost') +':35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
        </script>
        @endif
    </body>
</html>
