@extends('layout')

@section('content')
    <h1>Selling Your Home?</h1>

    <hr>

    <form method="post" action="{{ URL::route('houses.store') }}" enctype="multipart/form-data">
        @include('flyers.form')

        @include('errors')
    </form>
@stop