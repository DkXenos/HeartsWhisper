<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reports - Hearts Whisper</title>
    <link rel="stylesheet" href="{{ asset('resources/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/fonts.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #ffc4d6 0%, #ffeef4 50%, #d4a5ff 100%);
            min-height: 100vh;
        }

        .reports-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .reports-header {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(255, 182, 193, 0.3);
            margin-bottom: 2rem;
        }

        .reports-header h1 {
            font-family: 'Apris', serif;
            color: #ff69b4;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .report-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(255, 182, 193, 0.2);
            margin-bottom: 1.5rem;
            border-left: 5px solid #ff69b4;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #ffeef4;
        }

        .report-info {
            flex: 1;
        }

        .report-reason {
            display: inline-block;
            padding: 0.4rem 1rem;
            background: #ff69b4;
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .report-meta {
            color: #888;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .reported-content {
            background: #ffeef4;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 1rem 0;
        }

        .reported-content h3 {
            color: #ff69b4;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .content-text {
            color: #333;
            line-height: 1.6;
        }

        .report-description {
            background: #fff5f7;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            border-left: 3px solid #ff69b4;
        }

        .report-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-review {
            background: #4a90e2;
            color: white;
        }

        .btn-review:hover {
            background: #357abd;
            transform: translateY(-2px);
        }

        .btn-resolve {
            background: #5cb85c;
            color: white;
        }

        .btn-resolve:hover {
            background: #4cae4c;
            transform: translateY(-2px);
        }

        .btn-dismiss {
            background: #f0ad4e;
            color: white;
        }

        .btn-dismiss:hover {
            background: #ec971f;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #d9534f;
            color: white;
        }

        .btn-delete:hover {
            background: #c9302c;
            transform: translateY(-2px);
        }

        .no-reports {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(255, 182, 193, 0.2);
        }

        .no-reports h2 {
            color: #ff69b4;
            font-family: 'Apris', serif;
            font-size: 2rem;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            border-left: 4px solid #28a745;
        }

        .content-type {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: #d4a5ff;
            color: white;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="reports-container">
        <div class="reports-header">
            <h1>📋 Content Reports</h1>
            <p style="color: #888;">Review reported posts and replies from the community</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($reports->isEmpty())
            <div class="no-reports">
                <h2>✨ No Pending Reports</h2>
                <p style="color: #888; margin-top: 1rem;">All caught up! There are no reports to review right now.</p>
            </div>
        @else
            @foreach($reports as $report)
                <div class="report-card">
                    <div class="report-header">
                        <div class="report-info">
                            <span class="report-reason">{{ strtoupper($report->reason) }}</span>
                            <span class="content-type">{{ class_basename($report->reportable_type) }}</span>
                            <div class="report-meta">
                                Reported by: <strong>{{ $report->reporter->username }}</strong> • 
                                {{ $report->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    @if($report->description)
                        <div class="report-description">
                            <strong>Reporter's Note:</strong>
                            <p style="margin-top: 0.5rem;">{{ $report->description }}</p>
                        </div>
                    @endif

                    <div class="reported-content">
                        <h3>Reported Content:</h3>
                        @if($report->reportable_type === 'App\Models\Post')
                            <div class="content-text">
                                <strong>Title:</strong> {{ $report->reportable->title }}
                                <br><br>
                                {{ Str::limit($report->reportable->content, 300) }}
                            </div>
                            <div style="margin-top: 1rem; color: #888; font-size: 0.9rem;">
                                By: <strong>{{ $report->reportable->user->username }}</strong> • 
                                Posted {{ $report->reportable->created_at->diffForHumans() }}
                            </div>
                        @else
                            <div class="content-text">
                                {{ Str::limit($report->reportable->content, 300) }}
                            </div>
                            <div style="margin-top: 1rem; color: #888; font-size: 0.9rem;">
                                By: <strong>{{ $report->reportable->user->username }}</strong> • 
                                Posted {{ $report->reportable->created_at->diffForHumans() }}
                            </div>
                        @endif
                    </div>

                    <div class="report-actions">
                        <form method="POST" action="{{ route('admin.reports.review', $report->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-review">👁️ Mark Reviewed</button>
                        </form>

                        <form method="POST" action="{{ route('admin.reports.resolve', $report->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-resolve">✅ Resolve (Keep Content)</button>
                        </form>

                        <form method="POST" action="{{ route('admin.reports.resolve', $report->id) }}" style="display: inline;" 
                              onsubmit="return confirm('Are you sure you want to DELETE this content? This cannot be undone!');">
                            @csrf
                            <input type="hidden" name="delete_content" value="1">
                            <button type="submit" class="btn btn-delete">🗑️ Delete Content</button>
                        </form>

                        <form method="POST" action="{{ route('admin.reports.dismiss', $report->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-dismiss">❌ Dismiss Report</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    @include('layouts.footer')
</body>
</html>
