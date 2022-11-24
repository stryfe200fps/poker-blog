@extends('errors.layout')

@php
  $error_number = 429;
@endphp

@section('title')
  Too many requests.
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a> and try again, or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! $default_error_message !!}
@endsection
