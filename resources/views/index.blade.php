@extends('layouts.app')

@section('title', __('meta.home.title'))

@section('description', __('meta.home.description'))

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
