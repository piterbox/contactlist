<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
          
        </ul>

        <ul class="navbar-nav">
            @guest  
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                  {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a  class="dropdown-item"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                    </form>
                </div>
            </li>
            @endguest  
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script type="text/javascript">
         window.onload = function(){
           const button = document.querySelector('#navbarDropdown');
           const menu = document.querySelector('div.dropdown-menu')
           
           if(button){
                button.addEventListener('click', function(e){
                    e.preventDefault();
                    if(menu.style.display == 'block'){
                        menu.style.display = 'none';
                    }
                    else{
                        menu.style.display = 'block';
                        menu.style.width = 'auto';
                        menu.style.left = '-30px';
                        menu.style.minWidth = 'auto';
                    }
                });
                document.addEventListener('click', function(e){
                    if(e.target != button){
                        menu.style.display = 'none';
                    }
                });
           }
           

        }
    </script>
</body>
</html>
