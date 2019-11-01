<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                /* align-items: center; */
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 75px; 
                margin-top: 75px;
            }
            
            .feeds{
                max-width: 500px;
            }

            .feed_container{
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .feed_title{
                font-size: 20px;
                text-align: center;
            }
            
            .feed_body{
                color: black;
                font-size: 16px;
                text-align: left;
            }

            .feed_publisher{
                color: black;
                font-size: 13px;
                text-align: right;
            }

            a:link{
                text-decoration:none;
            }

            .feed_image{
                max-height: 100px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">{{ucfirst(trans('app.home'))}}</a>
                    @else
                        <a href="{{ route('login') }}">{{ucfirst(trans('app.login'))}}</a>

                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ucfirst(env('APP_NAME'))}}
                </div>

                <div class="clearfix"></div>

                <div class="feeds">

                   @foreach($feeds as $feed)
                   <div class="container feed_container">
                        <div class="row feed_title">
                            <a href="{{$feed->source}}">{{$feed->title}}</a>
                        </div>

                        @if($feed->getMedia('imagen')->first())
                        <div class="row feed_body">
                            <p class=feed_image_body>{!!$feed->body!!}</p> 
                            <img src="{{$feed->getMedia('imagen')->first()->getFullUrl()}}" class="feed_image">
                        </div>

                        @else
                       <div class="row feed_body">
                            {!!$feed->body!!}
                        </div>
                        @endif

                        <div class="row feed_publisher">
                            {{$feed->publisher}}
                        </div>
                    </div>
                   @endforeach

                </div>
            </div>
        </div>
    </body>
</html>
