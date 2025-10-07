@extends('layouts.app')

@section('title', 'Forum - Hearts Whisper')

@section('content')
    <section class="card">
        <h2>Forum</h2>
        <p class="muted">Area diskusi dan topik. Ini view index untuk forum.</p>
        <div class="stack">
            <div class="card">
                <h4>Topic 1</h4>
                <p class="muted">Replies: 12</p>
            </div>
            <div class="card">
                <h4>Topic 2</h4>
                <p class="muted">Replies: 3</p>
            </div>
        </div>
    </section>
@endsection
