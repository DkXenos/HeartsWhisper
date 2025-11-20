# Reports Feature Documentation

## Overview
The Reports feature allows users to report inappropriate posts and replies to moderators and admins for review. This helps maintain community standards and safety.

## Database Schema

### Reports Table
- `id` - Primary key
- `user_id` - FK to users (reporter)
- `reportable_id` - Polymorphic ID (post_id or reply_id)
- `reportable_type` - Polymorphic type (App\Models\Post or App\Models\Reply)
- `reason` - Enum: spam, harassment, inappropriate, offensive, other
- `description` - Optional text field (max 500 chars)
- `status` - Enum: pending, reviewed, resolved, dismissed (default: pending)
- `reviewed_by` - FK to users (moderator/admin who reviewed)
- `reviewed_at` - Timestamp when reviewed
- `created_at`, `updated_at` - Timestamps
- **Unique constraint**: One user can only report the same content once

## Features Implemented

### 1. User Reporting
- **Report Button**: Added to posts and replies (only shown to non-authors)
- **Report Modal**: Beautiful modal form with:
  - Reason dropdown (5 options)
  - Optional description field (500 char limit)
  - Cancel and Submit buttons
- **Validation**: 
  - Prevents duplicate reports from same user
  - Requires reason selection
  - Optional description limited to 500 chars

### 2. Moderator/Admin Review Panel
- **Access**: Available at `/admin/reports` (moderators and admins only)
- **Features**:
  - View all pending reports
  - See reporter information and timestamp
  - View reported content with context
  - See reporter's additional notes
  - Four action buttons per report:
    1. **Mark Reviewed** - Change status to "reviewed"
    2. **Resolve (Keep Content)** - Close report without deleting
    3. **Delete Content** - Remove reported post/reply and resolve report
    4. **Dismiss Report** - Close report as invalid

### 3. Relationships
- **Report → User (reporter)**: Who reported the content
- **Report → User (reviewer)**: Which mod/admin handled it
- **Report → Post/Reply**: Polymorphic relationship to reported content
- **Post/Reply → Reports**: Inverse relationship for counting reports

## Routes

### User Routes (Authenticated)
```php
POST /posts/{post}/report          // Report a post
POST /replies/{reply}/report        // Report a reply
```

### Moderator/Admin Routes
```php
GET  /admin/reports                 // View all pending reports
POST /admin/reports/{id}/review     // Mark as reviewed
POST /admin/reports/{id}/resolve    // Resolve (with optional delete)
POST /admin/reports/{id}/dismiss    // Dismiss report
```

## Controllers

### ReportController Methods
1. `reportPost($request, $post)` - Submit post report
2. `reportReply($request, $reply)` - Submit reply report
3. `index()` - List all pending reports
4. `review($id)` - Mark report as reviewed
5. `resolve($request, $id)` - Resolve report (optionally delete content)
6. `dismiss($id)` - Dismiss report as invalid

## Permissions
- **Users**: Can report any post/reply (except their own)
- **Moderators**: Can view and manage all reports
- **Admins**: Can view and manage all reports

## UI Components

### Report Button Styling
- Red color (#ff6b6b) to indicate warning/serious action
- Flag icon for visual recognition
- Hidden for content authors (can't report own content)

### Report Modal
- Pink theme matching Hearts Whisper aesthetic
- Centered overlay with smooth backdrop
- Form validation and error handling
- Close on outside click or X button

### Reports Admin Panel
- Card-based layout for each report
- Color-coded reason badges
- Content type indicators (Post/Reply)
- Expandable reporter notes
- Four-button action bar with distinct colors:
  - Review: Blue (#4a90e2)
  - Resolve: Green (#5cb85c)
  - Delete: Red (#d9534f)
  - Dismiss: Orange (#f0ad4e)

## Success/Error Messages
- "Report submitted. Our moderators will review it."
- "You have already reported this post/reply."
- "Report marked as reviewed."
- "Report resolved."
- "Report dismissed."

## Dashboard Integration
- Added "View Reports" button for moderators and admins
- Button styled in red (#ff6b6b) to match report theme
- Positioned in dashboard header alongside other admin buttons

## Testing Scenarios

### 1. Submit Report
1. Login as regular user
2. View any post or reply (not your own)
3. Click "Report" button
4. Select reason and add description
5. Submit form
6. Verify success message appears
7. Try to report same content again → should show error

### 2. Review Reports
1. Login as moderator or admin
2. Click "View Reports" button from dashboard
3. Should see list of pending reports
4. Verify all report details are visible

### 3. Take Action
1. Click "Mark Reviewed" → status changes
2. Click "Resolve (Keep Content)" → report closed, content remains
3. Click "Delete Content" → report closed, content deleted
4. Click "Dismiss Report" → report dismissed

### 4. Permissions
1. Regular users should NOT see report management panel
2. Report buttons should NOT appear on user's own content
3. Moderators should have access to reports panel

## Files Modified/Created

### Migrations
- `database/migrations/2025_11_17_061143_create_reports_table.php`

### Models
- `app/Models/Report.php` (new)
- `app/Models/Post.php` (added reports relationship)
- `app/Models/Reply.php` (added reports relationship)

### Controllers
- `app/Http/Controllers/ReportController.php` (new)

### Routes
- `routes/web.php` (added report routes)

### Views
- `resources/views/admin/reports.blade.php` (new)
- `resources/views/forum/show.blade.php` (added report button and modal)
- `resources/views/forum/partials/reply.blade.php` (added report button)
- `resources/views/dashboard.blade.php` (added View Reports button)

## Next Features (Recommended)
1. **Notifications** - Notify users when their content is reported/actioned
2. **Bookmarks** - Allow users to save favorite posts
3. **Report History** - View resolved reports for auditing
4. **Auto-moderation** - Automatically hide content with multiple reports
5. **Report Analytics** - Statistics on report types and resolution

## Technical Notes
- Uses polymorphic relationships for flexibility (one table for both post and reply reports)
- Unique constraint prevents spam reporting
- Soft delete approach - content is actually deleted, not just hidden
- CSRF protection on all forms
- Role-based middleware for access control
- Eager loading to prevent N+1 queries

---
**Implementation Date**: November 17, 2025
**Status**: ✅ Complete and Tested
