@extends('layouts.app')

@section('title', 'Profile - Hearts Whisper')

@section('content')
    <section class="card">
        <h2>User Profile</h2>
        <p class="muted">This is a placeholder profile page for layouting.</p>
        <form>
            <div class="form-group">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" value="Demo User">
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" value="demo@example.com">
            </div>
            <button class="btn">Save</button>
        </form>
    </section>
@endsection
