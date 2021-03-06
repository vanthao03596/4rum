<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.atwho.min.css') }}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <input type="text" id="inputor">
            
        {{-- <div id="app">
        <template>
        

            <ais-index
                app-id="{{ env('ALGOLIA_APP_ID') }}"
                api-key="{{ env('ALGOLIA_SECRET') }}"
                index-name="threads"
            >
                <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
                <ais-search-box></ais-search-box>
                <ais-results>
                <template slot-scope="{ result }">
                    <a :href="result.path">
                    <h2>
                    <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                    </h2>
                    </a>
                </template>
                </ais-results>
                
            </ais-index>
            </template>
        </div> --}}
    </body>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.caret.min.js')}}"></script>

  <script src="{{ asset('js/jquery.atwho.js') }}"></script>
    <script>
        $('#inputor').atwho({
                at: "@",
                delay: 2000,
                limit : 5,
                callbacks: {
                    remoteFilter: function(query, callback) {
                    $.getJSON("/users.json", {q: query}, function(data) {
                        callback(data)
                    });
                    }
                }
            })
    </script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</html>
