@extends('layouts.app')

@section('title', 'Homepage - Hearts Whisper')

@section('content')
    <img src="{{ asset('asset/homepage/background.svg') }}" alt="Homepage Background" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <section id="hero">
        <div class="hero-root">
            <img src="asset/homepage/pillar-left.svg" alt=""
            class="pillar-left">
            <img src="asset/homepage/pillar-right.svg" alt=""
            class="pillar-right">
            <div class="hero-bg">
                <div class="hero-content-1">
                    
                </div>
                <div class="hero-content-2">
                    <img src="asset/homepage/coming-soon.svg" alt="coming soon">
                </div>
            </div>
        </div>
    </section>
@endsection
