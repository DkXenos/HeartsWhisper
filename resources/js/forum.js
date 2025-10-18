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
});
