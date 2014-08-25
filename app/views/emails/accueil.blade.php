@extends('template_blog')

@include('navigation')

@section('content')
    @for ($i = 0; $i < count($articles); $i++)
        @if ($i%2 == 0)
            <div class="row">
        @endif
        <div class="span6">
        <h3>{{$articles[$i]->title}}</h3>
        <p>{{$articles[$i]->intro_text}}</p>
        <p><a href="{{ url('art/'.$actif.'/'.$articles[$i]->id) }}">Lire la suite <i class="icon-play"></i></a></p>
        </div>
        @if ($i%2 != 0)
            </div>
        @endif
    @endfor
    @if (count($articles)%2 != 0)
        </div>
    @endif
@stop