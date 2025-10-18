// Forum Reply Functionality
document.addEventListener('DOMContentLoaded', function() {
    
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
    
    // Handle reply form submission
    const replyForms = document.querySelectorAll('.reply-form');
    
    replyForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const textarea = this.querySelector('.reply-textarea');
            const postId = this.dataset.postId;
            const submitBtn = this.querySelector('.reply-submit-btn');
            
            // Validate textarea is not empty
            if (!textarea.value.trim()) {
                alert('Please write a reply before submitting.');
                return;
            }
            
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.textContent = 'Posting...';
            
            console.log('Reply submitted for post:', postId);
            console.log('Reply content:', textarea.value);
            
            // TODO: Implement AJAX request to save the reply
            // Example:
            // fetch('/api/posts/' + postId + '/replies', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            //     },
            //     body: JSON.stringify({
            //         content: textarea.value
            //     })
            // })
            // .then(response => response.json())
            // .then(data => {
            //     // Handle success
            //     console.log('Reply saved:', data);
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            // });
            
            // Temporary placeholder alert
            setTimeout(() => {
                alert('Reply functionality will be implemented with backend integration!\n\nYour reply: ' + textarea.value);
                
                // Clear the form
                textarea.value = '';
                const charCount = this.querySelector('.reply-char-count .current');
                if (charCount) {
                    charCount.textContent = '0';
                    charCount.style.color = '#374151';
                }
                
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Post Reply';
                
                // Hide the reply section
                const replySection = document.getElementById(`reply-section-${postId}`);
                if (replySection) {
                    replySection.style.display = 'none';
                }
            }, 500);
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
        btn.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const isLiked = this.dataset.liked === 'true';
            const likeIcon = this.querySelector('.like-icon');
            const likeText = this.childNodes[2]; // The text node "Like"
            
            if (isLiked) {
                // Unlike the post
                likeIcon.src = '/asset/forums/unliked.svg';
                likeIcon.alt = 'like';
                this.dataset.liked = 'false';
                this.classList.remove('liked');
                if (likeText && likeText.nodeType === Node.TEXT_NODE) {
                    likeText.textContent = ' Like';
                }
            } else {
                // Like the post
                likeIcon.src = '/asset/forums/liked.svg';
                likeIcon.alt = 'liked';
                this.dataset.liked = 'true';
                this.classList.add('liked');
                if (likeText && likeText.nodeType === Node.TEXT_NODE) {
                    likeText.textContent = ' Liked';
                }
            }
            
            console.log('Post', postId, isLiked ? 'unliked' : 'liked');
            
            // TODO: Send AJAX request to update like status in database
            // fetch('/api/posts/' + postId + '/like', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            //     },
            //     body: JSON.stringify({
            //         liked: !isLiked
            //     })
            // })
            // .then(response => response.json())
            // .then(data => {
            //     console.log('Like status updated:', data);
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            // });
        });
    });
    
    // ===== NESTED REPLIES FUNCTIONALITY =====
    
    // Toggle nested reply form
    document.addEventListener('click', function(e) {
        if (e.target.closest('.nested-reply-toggle')) {
            const btn = e.target.closest('.nested-reply-toggle');
            const replyId = btn.dataset.replyId;
            const nestedForm = document.getElementById(`nested-reply-${replyId}`);
            
            // Hide all other nested forms
            document.querySelectorAll('.nested-reply-form').forEach(form => {
                if (form.id !== `nested-reply-${replyId}`) {
                    form.style.display = 'none';
                }
            });
            
            // Toggle this form
            if (nestedForm.style.display === 'none') {
                nestedForm.style.display = 'block';
                nestedForm.querySelector('.reply-textarea-small').focus();
            } else {
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
    
    // Handle nested reply form submission
    const nestedReplyForms = document.querySelectorAll('.nested-reply-form-inner');
    
    nestedReplyForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const textarea = this.querySelector('.reply-textarea-small');
            const parentId = this.dataset.parentId;
            const postId = this.dataset.postId;
            const submitBtn = this.querySelector('.submit-nested-reply');
            
            if (!textarea.value.trim()) {
                alert('Please write a reply before submitting.');
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Posting...';
            
            console.log('Nested reply submitted:');
            console.log('Post ID:', postId);
            console.log('Parent Reply ID:', parentId);
            console.log('Content:', textarea.value);
            
            // TODO: Implement AJAX request to save nested reply
            
            setTimeout(() => {
                alert('Nested reply will be saved!\n\nReply: ' + textarea.value);
                textarea.value = '';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Reply';
                document.getElementById(`nested-reply-${parentId}`).style.display = 'none';
            }, 500);
        });
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
    
    // Handle main reply form submission on detail page
    const mainReplyForm = document.querySelector('.main-reply-form');
    if (mainReplyForm) {
        mainReplyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const textarea = this.querySelector('.reply-textarea');
            const postId = this.dataset.postId;
            const submitBtn = this.querySelector('.reply-submit-btn');
            
            if (!textarea.value.trim()) {
                alert('Please write a reply before submitting.');
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Posting...';
            
            console.log('Main reply submitted for post:', postId);
            console.log('Content:', textarea.value);
            
            // TODO: Implement AJAX request
            
            setTimeout(() => {
                alert('Reply will be saved!\n\nReply: ' + textarea.value);
                textarea.value = '';
                const charCount = this.querySelector('.reply-char-count .current');
                if (charCount) {
                    charCount.textContent = '0';
                    charCount.style.color = '#374151';
                }
                submitBtn.disabled = false;
                submitBtn.textContent = 'Post Reply';
            }, 500);
        });
    }
});


