@extends('template_blog')

@include('navigation')

@section('content')

    @if (Session::has('flash_notice'))
        <div class="alert alert-success span7">
            {{ Session::get('flash_notice') }}
        </div>
    @endif

    @if (Session::has('flash_error'))
        <div class="alert alert-error span6">
            {{ Session::get('flash_error') }}
        </div>
    @endif

    @for ($i = 0; $i < count($articles); $i++)
        @if ($i%2 == 0)
            <div>
        @endif
        <div>
            <h3>{{$articles[$i]->title}}</h3>
            <p>{{$articles[$i]->intro_text}}</p>
            <p><a href="{{ url('art/'.$actif.'/'.$articles[$i]->id) }}">Lire la suite <i></i></a></p>
        </div>
        @if ($i%2 != 0)
            </div>
        @endif
    @endfor

    @if (count($articles)%2 != 0)
        </div>
    @endif

    @if (method_exists($articles,'links'))
        {{$articles->links()}}
    @endif

@stop