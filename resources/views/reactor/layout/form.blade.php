@extends('layout.reactor')

@section('form_start', form_start($form))

@section('scripts')
    {!! Theme::js('js/form.js') !!}
@endsection

@section('form_end', form_end($form))