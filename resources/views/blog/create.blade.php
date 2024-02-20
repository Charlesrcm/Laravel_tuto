@extends('base')

@section('title', 'Créer un article')

@section('content')
  <form action="" method="post">
    @csrf
    <input type="text" name="title" value="article de démonstration">
    <textarea name="content">Contenue de la démonstration</textarea>
    <button>Enregistrer</button>
  </form>
@endsection