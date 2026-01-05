@extends('layouts.app')

@section('title', 'Lepres Kikounga | VP of Engineering & Tech Advisor')

@section('description', 'Portfolio de Lepres Kikounga - VP of Engineering avec 8+ ans d\'expérience. Ex-CTO at Cowema. Spécialisé en architecture système, leadership technique et stratégie technologique.')

@section('content')
    @include('partials.sections.hero')
    @include('partials.sections.about')
    @include('partials.sections.experience')
    @include('partials.sections.services')
    @include('partials.sections.skills')
    @include('partials.sections.projects')
    @include('partials.sections.news')
    @include('partials.sections.contact')
@endsection
