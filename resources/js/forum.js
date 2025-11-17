// Forum Reply Functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Make post cards clickable (but not the buttons inside)
    const postCards = document.querySelectorAll('.post-card');
    
    postCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't navigate if clicking on buttons or interactive elements
            if (e.target.closest('.action-btn') || 
                e.target.closest('.reply-section') || 
                e.target.closest('.category-tag')) {
                return;
            }
            
            const url = this.dataset.postUrl;
            if (url) {
                window.location.href = url;
            }
        });
    });
    
    // Toggle reply section when Reply button is clicked
    const replyToggleBtns = document.querySelectorAll('.reply-toggle-btn');
    
    replyToggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const replySection = document.getElementById(`reply-section-${postId}`);
            
            // Close all other reply sections
            document.querySelectorAll('.reply-section').forEach(section => {
                if (section.id !== `reply-section-${postId}`) {
                    section.style.display = 'none';
                    const textarea = section.querySelector('.reply-textarea');
                    if (textarea) {
                        textarea.value = '';
                        const charCount = section.querySelector('.reply-char-count .current');
                        if (charCount) charCount.textContent = '0';
                    }
                }
            });
            
            // Toggle the current reply section
            if (replySection.style.display === 'none') {
                replySection.style.display = 'block';
                const textarea = replySection.querySelector('.reply-textarea');
                if (textarea) {
                    textarea.focus();
                }
            } else {
                replySection.style.display = 'none';
            }
        });
    });
    
    // Cancel reply button functionality
    const replyCancelBtns = document.querySelectorAll('.reply-cancel-btn');
    
    replyCancelBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const replySection = document.getElementById(`reply-section-${postId}`);
            const textarea = replySection.querySelector('.reply-textarea');
            
            // Clear textarea
            textarea.value = '';
            
            // Hide reply section
            replySection.style.display = 'none';
            
            // Reset character count
            const charCount = replySection.querySelector('.reply-char-count .current');
            if (charCount) {
                charCount.textContent = '0';
                charCount.style.color = '#374151';
            }
        });
    });
    
    // Handle reply form submission in forum index
    const replyForms = document.querySelectorAll('.reply-form');
    
    replyForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const postId = this.dataset.postId;
            const textarea = this.querySelector('.reply-textarea');
            const submitBtn = this.querySelector('.reply-submit-btn');
            
            if (!textarea.value.trim()) {
                alert('Please write a reply before submitting.');
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Posting...';
            
            fetch(`/posts/${postId}/replies`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    content: textarea.value
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    textarea.value = '';
                    document.getElementById(`reply-section-${postId}`).style.display = 'none';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Post Reply';
                    
                    // Optionally redirect to the post detail page
                    // window.location.href = `/forums/${postId}`;
                } else {
                    alert('Failed to post reply. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Post Reply';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to post reply. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Post Reply';
            });
        });
    });
    
    // Character count for reply textarea
    const replyTextareas = document.querySelectorAll('.reply-textarea');
    
    replyTextareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            const charCount = this.closest('.reply-section').querySelector('.reply-char-count .current');
            const currentLength = this.value.length;
            
            if (charCount) {
                charCount.textContent = currentLength;
                
                // Change color when approaching limit
                if (currentLength > 900) {
                    charCount.style.color = '#ef4444'; // Red color
                } else if (currentLength > 800) {
                    charCount.style.color = '#f59e0b'; // Orange color
                } else {
                    charCount.style.color = '#374151'; // Default color
                }
            }
        });
    });
    
    
    // Optional: Close reply section when clicking outside
    document.addEventListener('click', function(e) {
        // Check if click is outside reply section and reply button
        if (!e.target.closest('.reply-section') && !e.target.closest('.reply-toggle-btn')) {
            // Optional: Uncomment to auto-close reply sections when clicking outside
            // document.querySelectorAll('.reply-section').forEach(section => {
            //     section.style.display = 'none';
            // });
        }
    });

    // Like button toggle functionality
    const likeToggleBtns = document.querySelectorAll('.like-toggle-btn');
    
    likeToggleBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
            // Prevent the onclick handler from also firing if it exists
            if (this.hasAttribute('onclick')) {
                return; // Let the onclick handler (toggleLike) handle it
            }
            
            const postId = this.dataset.postId;
            const isLiked = this.dataset.liked === 'true';
            const likeIcon = this.querySelector('.like-icon');
            const likeText = this.querySelector('.like-text');
            const likeCount = this.querySelector('.like-count');
            
            const url = `/posts/${postId}/like`;
            
            // Send AJAX request to update like status in database
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Like status updated:', data);
                
                // Update button state
                this.dataset.liked = data.liked;
                
                // Update icon
                if (likeIcon) {
                    likeIcon.src = data.liked ? '/asset/forums/liked.svg' : '/asset/forums/unliked.svg';
                    likeIcon.alt = data.liked ? 'liked' : 'like';
                }
                
                // Update text
                if (likeText) {
                    likeText.textContent = data.liked ? 'Liked' : 'Like';
                }
                
                // Update count if it exists
                if (likeCount) {
                    likeCount.textContent = '(' + data.likes_count + ')';
                }
                
                // Update the vote count in the avatar section (forum index)
                const voteCount = this.closest('.post-card')?.querySelector('.vote-count');
                if (voteCount) {
                    voteCount.textContent = data.likes_count;
                }
                
                // Add/remove liked class
                if (data.liked) {
                    this.classList.add('liked');
                } else {
                    this.classList.remove('liked');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update like. Please try again.');
            });
        });
    });
    
    // ===== NESTED REPLIES FUNCTIONALITY =====
    
    // Toggle nested reply form
    document.addEventListener('click', function(e) {
        if (e.target.closest('.nested-reply-toggle')) {
            console.log('Reply button clicked');
            const btn = e.target.closest('.nested-reply-toggle');
            const replyId = btn.dataset.replyId;
            console.log('Reply ID:', replyId);
            const nestedForm = document.getElementById(`nested-reply-${replyId}`);
            console.log('Found form:', nestedForm);
            
            if (!nestedForm) {
                console.error('Nested reply form not found for reply ID:', replyId);
                return;
            }
            
            // Hide all other nested forms
            document.querySelectorAll('.nested-reply-form').forEach(form => {
                if (form.id !== `nested-reply-${replyId}`) {
                    form.style.display = 'none';
                }
            });
            
            // Toggle this form
            if (nestedForm.style.display === 'none' || nestedForm.style.display === '') {
                console.log('Showing form');
                nestedForm.style.display = 'block';
                nestedForm.querySelector('.reply-textarea-small').focus();
            } else {
                console.log('Hiding form');
                nestedForm.style.display = 'none';
            }
        }
        
        // Cancel nested reply
        if (e.target.closest('.cancel-nested-reply')) {
            const btn = e.target.closest('.cancel-nested-reply');
            const replyId = btn.dataset.replyId;
            const nestedForm = document.getElementById(`nested-reply-${replyId}`);
            nestedForm.style.display = 'none';
            nestedForm.querySelector('.reply-textarea-small').value = '';
        }
        
        // Like reply button
        if (e.target.closest('.like-reply-btn')) {
            const btn = e.target.closest('.like-reply-btn');
            const replyId = btn.dataset.replyId;
            const isLiked = btn.dataset.liked === 'true';
            const likeIcon = btn.querySelector('.like-icon-small');
            
            if (isLiked) {
                likeIcon.src = '/asset/forums/unliked.svg';
                btn.dataset.liked = 'false';
                btn.classList.remove('liked');
            } else {
                likeIcon.src = '/asset/forums/liked.svg';
                btn.dataset.liked = 'true';
                btn.classList.add('liked');
            }
            
            console.log('Reply', replyId, isLiked ? 'unliked' : 'liked');
            
            // TODO: Send AJAX request to update reply like status
        }
    });
    
    // Character count for main reply form on detail page
    const mainReplyTextarea = document.querySelector('.main-reply-form .reply-textarea');
    if (mainReplyTextarea) {
        mainReplyTextarea.addEventListener('input', function() {
            const charCount = this.closest('.main-reply-form').querySelector('.reply-char-count .current');
            const currentLength = this.value.length;
            
            if (charCount) {
                charCount.textContent = currentLength;
                
                if (currentLength > 900) {
                    charCount.style.color = '#ef4444';
                } else if (currentLength > 800) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = '#374151';
                }
            }
        });
    }
});

// Event delegation for edit and delete reply buttons
document.addEventListener('click', function(e) {
    // Edit reply button
    if (e.target.closest('.edit-reply-btn-trigger')) {
        const btn = e.target.closest('.edit-reply-btn-trigger');
        const replyId = btn.dataset.replyId;
        editReply(replyId);
    }
    
    // Delete reply button
    if (e.target.closest('.delete-reply-btn-trigger')) {
        const btn = e.target.closest('.delete-reply-btn-trigger');
        const replyId = btn.dataset.replyId;
        deleteReply(replyId);
    }
    
    // Cancel edit button
    if (e.target.closest('.cancel-edit-reply')) {
        const btn = e.target.closest('.cancel-edit-reply');
        const replyId = btn.dataset.replyId;
        cancelEdit(replyId);
    }
});

// Handle edit form submission
document.addEventListener('submit', function(e) {
    if (e.target.closest('.reply-edit-form-inner')) {
        e.preventDefault();
        const form = e.target.closest('.reply-edit-form-inner');
        const replyId = form.dataset.replyId;
        updateReply(e, replyId);
    }
    
    // Handle nested reply form submission
    if (e.target.closest('.nested-reply-form-inner')) {
        e.preventDefault();
        const form = e.target.closest('.nested-reply-form-inner');
        const textarea = form.querySelector('.reply-textarea-small');
        const parentId = form.dataset.parentId;
        const postId = form.dataset.postId;
        const submitBtn = form.querySelector('.submit-nested-reply');
        
        if (!textarea.value.trim()) {
            alert('Please write a reply before submitting.');
            return;
        }
        
        submitBtn.disabled = true;
        submitBtn.textContent = 'Posting...';
        
        // Send AJAX request to save nested reply
        fetch(`/posts/${postId}/replies`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                content: textarea.value,
                parent_id: parentId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Nested reply response:', data);
            if (data.success) {
                window.location.reload();
            } else {
                alert('Failed to post reply. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Reply';
            }
        })
        .catch(error => {
            console.error('Nested reply error:', error);
            alert('Failed to post reply. Please try again.');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Reply';
        });
    }
});

// Like functionality - Make it globally accessible
window.toggleLike = function(event, id, type) {
    event.stopPropagation();
    
    const button = event.currentTarget;
    const icon = button.querySelector('.like-icon, .like-icon-small');
    const textSpan = button.querySelector('.like-text');
    const countSpan = button.querySelector('.like-count');
    
    const url = type === 'post' ? `/posts/${id}/like` : `/replies/${id}/like`;
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Like response:', data);
        
        // Update button state
        button.dataset.liked = data.liked;
        
        // Update icon
        if (icon) {
            icon.src = data.liked ? '/asset/forums/liked.svg' : '/asset/forums/unliked.svg';
        }
        
        // Update text
        if (textSpan) {
            textSpan.textContent = data.liked ? 'Liked' : 'Like';
        }
        
        // Update count
        if (countSpan) {
            countSpan.textContent = '(' + data.likes_count + ')';
        }
        
        // For forum index page - update the vote count in the avatar section
        const voteCount = button.closest('.post-card')?.querySelector('.vote-count');
        if (voteCount) {
            voteCount.textContent = data.likes_count;
        }
        
        // For show page - update the large vote count
        const voteCountLarge = button.closest('.post-detail-card')?.querySelector('.vote-count-large');
        if (voteCountLarge) {
            voteCountLarge.textContent = data.likes_count;
        }
    })
    .catch(error => {
        console.error('Like error:', error);
        alert('Failed to update like. Please try again.');
    });
}

// Edit reply functionality
function editReply(replyId) {
    const contentDiv = document.getElementById(`reply-content-${replyId}`);
    const editForm = document.getElementById(`reply-edit-${replyId}`);
    
    contentDiv.style.display = 'none';
    editForm.style.display = 'block';
}

function cancelEdit(replyId) {
    const contentDiv = document.getElementById(`reply-content-${replyId}`);
    const editForm = document.getElementById(`reply-edit-${replyId}`);
    
    contentDiv.style.display = 'block';
    editForm.style.display = 'none';
}

function updateReply(event, replyId) {
    event.preventDefault();
    
    const textarea = document.getElementById(`edit-textarea-${replyId}`);
    const content = textarea.value;
    
    if (!content.trim()) {
        alert('Reply content cannot be empty.');
        return;
    }
    
    fetch(`/replies/${replyId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ content: content })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Update response:', data);
        if (data.success) {
            // Update the content
            const contentDiv = document.getElementById(`reply-content-${replyId}`);
            if (contentDiv && contentDiv.querySelector('p')) {
                contentDiv.querySelector('p').textContent = content;
            }
            
            // Hide edit form and show content
            cancelEdit(replyId);
            
            // Show success message
            alert('Reply updated successfully!');
        } else {
            alert('Failed to update reply. Please try again.');
        }
    })
    .catch(error => {
        console.error('Update error:', error);
        alert('Failed to update reply. Please try again.');
    });
}

function deleteReply(replyId) {
    if (!confirm('Are you sure you want to delete this reply? This action cannot be undone.')) {
        return;
    }
    
    fetch(`/replies/${replyId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Delete response:', data);
        if (data.success) {
            // Find and remove the specific reply-item div
            const replyItem = document.querySelector(`.reply-item [id="reply-content-${replyId}"]`)?.closest('.reply-item');
            if (replyItem) {
                replyItem.remove();
                alert('Reply deleted successfully!');
            } else {
                console.error('Could not find reply item to remove');
                alert('Reply deleted but page needs refresh.');
                window.location.reload();
            }
        } else {
            alert('Failed to delete reply. Please try again.');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        alert('Failed to delete reply. Please try again.');
    });
}




