@extends('layouts.app')

@section('title', 'Dashboard - Hearts Whisper')

@section('content')
    <section class="card">
        <h2>User Dashboard</h2>
        <p class="muted">Simple dashboard placeholder. Personal stats and quick actions.</p>
        <div class="stack">
            <div class="card">
                <h4>Profile Summary</h4>
                <p class="muted">Username: demo_user</p>
            </div>
            <div class="card">
                <h4>Recent Activity</h4>
                <p class="muted">No recent activity.</p>
            </div>
        </div>
    </section>
@endsection
