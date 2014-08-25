<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            Mon joli blog
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                {{ HTML::style('assets/css/bootstrap.min.css') }}
                {{ HTML::style('assets/css/bootstrap-responsive.min.css') }}
                {{ HTML::style('assets/css/main.css') }}
                {{ HTML::style('http://fonts.googleapis.com/css?family=Imprima') }}
    </head>

    <body>
        <div class="container">

            <header class="row">
                <div id="entete" class="span12">
                    <h1>
                        Mon joli blog !
                    </h1>
                </div>
            </header>

            <nav class="navbar">
                <div class="navbar-inner">
                    <ul class="nav">
                        @yield('navigation')
                    </ul>
                    {{ Form::open(array('url' => 'find', 'method' => 'POST', 'class' => 'navbar-search pull-right')) }}
                    {{ Form::text('find', '', array('class' => 'search-query', 'placeholder' => 'Recherche')) }}
                    {{ Form::close() }}
                </div>
            </nav>

            <section>
                @yield('content')
            </section>

            <footer class="row">
                <div class="span12">
                    <em>
                        Copyright 2013
                    </em>
                </div>
            </footer>

        </div>
    </body>
</html>