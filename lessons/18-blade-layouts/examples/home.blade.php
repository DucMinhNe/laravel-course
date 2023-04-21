{{-- resources/views/home.blade.php — a child page --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Welcome</h1>
    <p>This page fills the layout's content slot.</p>
@endsection

@push('scripts')
    <script>console.log('home page loaded');</script>
@endpush
