@extends('layouts.app')

@section('title', 'Guides - Hearts Whisper')

@section('content')
    <section class="card">
            <img src="{{ asset('asset/guide/guidebg.svg') }}" alt="Homepage Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

        <h2>Guides</h2>
        <p class="muted">A place for tutorials and guides.</p>
        <div class="stack">
            <div class="card">
                <h4>Guide 1</h4>
                <p class="muted">Getting started guide.</p>
            </div>
            <div class="card">
                <h4>Guide 2</h4>
                <p class="muted">Advanced topics.</p>
            </div>
        </div>
    </section>
@endsection
