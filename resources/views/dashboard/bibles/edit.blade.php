@extends('layouts.app')

@section('head')
    <title>Edit bible</title>
@endsection

@section('content')

    @include('layouts.partials.banner', [
        'title' => trans('dashboard.bibles_edit_title')
    ])

    <div class="container">
        @include('dashboard.bibles.form', ['type' => 'PUT', 'bible' => $bible])
    </div>

@endsection