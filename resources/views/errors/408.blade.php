@extends('errors.layout')

@php
  $error_number = 408;
@endphp

@section('title')
  Request timeout.
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a>, refresh the page and try again.";

  @endphp
  {!! $default_error_message !!}
@endsection
