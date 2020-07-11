@extends('template.forum.master')

@section('content')
    <div>
        <h1>Nama: {{$user->name}}</h1>
        <h4>Email: {{$user->email}}</h4>
        <h5>Reputasi: {{$user->reputasi}}</h5>
    </div>
@endsection