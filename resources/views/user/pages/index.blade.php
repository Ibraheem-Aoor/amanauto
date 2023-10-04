@extends('layouts.user.master')
@section('page', $page?->title)
@section('content')
    <!-- --- Start Main -->
    <main id="Main">
        <div class="container-fluid p-5">
            {!! $page?->content !!}
        </div>
        @include('partials.whatsaap_section')
    </main>
    <!-- --- End Main -->
@endsection
