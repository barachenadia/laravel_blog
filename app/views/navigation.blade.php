
@section('navigation')
  <li>{{ link_to_route('accueil', 'Accueil', null, ($actif == 0)? array('class' => 'actif'): null) }}</li>

  @foreach ($categories as $categorie)
    <li>{{ link_to('cat/'.$categorie->id, $categorie->title, ($actif == $categorie->id)? array('class' => 'actif'): null) }}</li>
  @endforeach

@stop