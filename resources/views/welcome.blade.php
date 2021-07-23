<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <title>articles</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
    <style>
      nav .nav-wrapper {
        background-color: #444644 !important;
      }

       @if(Request::url() == 'http://localhost:8000/pin'|| Request::url() == 'http://localhost:8000/pinedit')
        body{
background-color: red !important;
}
@endif
    </style>
    </head>
    <body class="antialiased">

    <div id="app">
    @if(Request::url() !== 'http://localhost:8000/pin')
    <nav>
    <div class="nav-wrapper">
    <router-link to="/" class="brand-lgo" style="
    position: relative;
    left: 25px;
    font-weight: bold;">Dashboard</router-link>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li> <router-link to="/article">articles</router-link></li>
        <li> <a href="/pinedit">Edit Pin</a></li>
        <li><router-link to="/category">categories</router-link></li>  
        <li class="d-none" id="logout"><a  href="/logout">logout</a></li>
        <li class="d-none" id="register"><a  href="/register">register</a></li>
      </ul>
    </div>
  </nav>
  @endif
    <router-view></router-view>

  
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/vue-material"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
         $(document).ready(function() {
         
        if(User.loggedIn()){
          $('#logout').removeClass('d-none');
        }else{
          $('#register').removeClass('d-none');
        }
    M.updateTextFields();
  });

  Vue.use(VueMaterial.default)
    </script>
    <script src="{{asset('js/app.js')}}" ></script>
    </body>
</html>

