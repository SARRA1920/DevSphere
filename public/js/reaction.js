/**
 * Reaction functionality for DevSphere forum
 */

// Function to handle reactions to comments
function addReaction(commentId, reactionType) {
    console.log(`Adding reaction ${reactionType} to comment ${commentId}`);
    
    // Show loading state
    const reactionButton = document.querySelector(`.reaction-btn-${commentId}-${reactionType}`);
    if (reactionButton) {
        reactionButton.classList.add('reacting');
    }
    
    // Make request to reaction endpoint
    fetch(`/forum/comment/${commentId}/reaction`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            type: reactionType
        })
    })
    .then(response => {
        console.log('Reaction response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Reaction response:', data);
        
        // Remove loading state
        if (reactionButton) {
            reactionButton.classList.remove('reacting');
        }
        
        if (data.success) {
            // Update reaction count
            updateReactionCount(commentId, reactionType, data.count);
            
            // Update active state
            if (data.userReacted) {
                setReactionActive(commentId, reactionType, true);
            } else {
                setReactionActive(commentId, reactionType, false);
            }
        } else {
            console.error('Reaction failed:', data.error);
            alert('Failed to add reaction: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Reaction error:', error);
        
        // Remove loading state
        if (reactionButton) {
            reactionButton.classList.remove('reacting');
        }
        
        alert('Error adding reaction: ' + error.message);
    });
}

// Function to update reaction count in the UI
function updateReactionCount(commentId, reactionType, count) {
    const countElement = document.querySelector(`.reaction-count-${commentId}-${reactionType}`);
    if (countElement) {
        countElement.textContent = count;
        
        // Show/hide count based on value
        if (count > 0) {
            countElement.style.display = 'inline-block';
        } else {
            countElement.style.display = 'none';
        }
    }
}

// Function to set reaction button as active or inactive
function setReactionActive(commentId, reactionType, isActive) {
    const reactionButton = document.querySelector(`.reaction-btn-${commentId}-${reactionType}`);
    if (reactionButton) {
        if (isActive) {
            reactionButton.classList.add('active');
        } else {
            reactionButton.classList.remove('active');
        }
    }
}

// Function to get reactions for a comment
function getReactions(commentId) {
    console.log(`Getting reactions for comment ${commentId}`);
    
    // Make request to get reactions endpoint
    fetch(`/forum/comment/${commentId}/reactions`)
    .then(response => {
        console.log('Get reactions response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Get reactions response:', data);
        
        if (data.success) {
            // Update reaction counts and active states
            Object.entries(data.reactions).forEach(([type, info]) => {
                updateReactionCount(commentId, type, info.count);
                setReactionActive(commentId, type, info.userReacted);
            });
        } else {
            console.error('Get reactions failed:', data.error);
        }
    })
    .catch(error => {
        console.error('Get reactions error:', error);
    });
}

// Initialize reaction functionality when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Attach event listeners to reaction buttons
    document.querySelectorAll('.reaction-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            const reactionType = this.getAttribute('data-reaction-type');
            
            if (commentId && reactionType) {
                addReaction(commentId, reactionType);
            }
        });
    });
    
    // Load initial reactions for all comments
    document.querySelectorAll('.comment-reactions').forEach(container => {
        const commentId = container.getAttribute('data-comment-id');
        if (commentId) {
            getReactions(commentId);
        }
    });
});
