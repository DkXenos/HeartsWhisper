@extends('layouts.app')

@section('title', 'Homepage - Hearts Whisper')

@section('content')
    <img src="{{ asset('asset/homepage/mainbg.svg') }}" alt="Homepage Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <section id="hero">
        <div class="hero-root">
            <img src="{{ asset('Asset/Components/Navbar/ribbonnew.svg') }}" alt="Hearts Whisper Logo" class="ribbon">
            <img src="asset/homepage/pillar-left.svg" alt="" class="pillar-left">
            <img src="asset/homepage/pillar-right.svg" alt="" class="pillar-right">
            <div class="hero-bg">
                <div class="hero-content-1">
                    <img src="asset/homepage/dear6.svg" alt="dear" class="dearnew">
                    <img src="asset/homepage/textopening.svg" alt="borderwtext" class="hero1img">
                </div>
                <div class="hero-content-2">
                    <img src="asset/homepage/lettercloud.svg" alt="dear" class="lettercloud">
                </div>
                <div class="hero-content-3">
                    <img src="asset/homepage/coming-soon.svg" alt="coming soon" class="comingsoon">
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- In today’s world, many young people grow up learning about love and relationships through movies, dramas, and social 
media. Where they’re media that often romanticize unhealthy behaviors such as jealousy, manipulation, obsession, or 
emotional dependence as “true love.” Over time, this will shape how they see relationships and could even lead them into 
unhealthy, even toxic ones without realizing it. This research explores Love Psychology, focusing on how understanding 
healthy relationships and communication styles will promote healthier relationships and reduce the number of individuals 
harmed by toxic dynamics. 
 --}}
