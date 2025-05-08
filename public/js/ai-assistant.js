document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const aiAssistant = document.getElementById('aiAssistant');
    const aiAssistantToggle = document.getElementById('aiAssistantToggle');
    const aiAssistantPanel = document.getElementById('aiAssistantPanel');
    const aiAssistantClose = document.getElementById('aiAssistantClose');
    const aiAssistantForm = document.getElementById('aiAssistantForm');
    const aiAssistantInput = document.getElementById('aiAssistantInput');
    const aiAssistantMessages = document.getElementById('aiAssistantMessages');
    const aiTypingIndicator = document.getElementById('aiTypingIndicator');
    
    console.log("AI Assistant JS loaded");
    
    // Conversation history for proper context management
    let conversationHistory = [];
    
    // Check if elements exist to prevent errors
    if (!aiAssistantToggle || !aiAssistantPanel) {
        console.error("AI Assistant elements not found");
        return;
    }
    
    // Toggle chat panel - Using direct style manipulation for maximum reliability
    aiAssistantToggle.onclick = function() {
        console.log("Toggle button clicked");
        
        // Get the current display style
        const currentDisplay = window.getComputedStyle(aiAssistantPanel).getPropertyValue('display');
        
        // Force the opposite display style
        if (currentDisplay === 'none') {
            aiAssistantPanel.style.display = 'flex';
            aiAssistantPanel.classList.add('active');
            if (aiAssistantInput) {
                aiAssistantInput.focus();
            }
        } else {
            aiAssistantPanel.style.display = 'none';
            aiAssistantPanel.classList.remove('active');
        }
    };
    
    // Close chat panel - Use direct style manipulation
    if (aiAssistantClose) {
        aiAssistantClose.onclick = function() {
            aiAssistantPanel.style.display = 'none';
            aiAssistantPanel.classList.remove('active');
        };
    }
    
    // Handle message submission
    if (aiAssistantForm) {
        aiAssistantForm.onsubmit = function(e) {
            e.preventDefault();
            
            const message = aiAssistantInput.value.trim();
            if (!message) return;
            
            // Clear input
            aiAssistantInput.value = '';
            
            // Add user message to chat
            addMessage('user', message);
            
            // Show typing indicator
            aiTypingIndicator.classList.add('active');
            
            // Send message to AI API
            sendToOpenRouter(message);
        };
    }
    
    function addMessage(role, content) {
        const messageElement = document.createElement('div');
        messageElement.className = role === 'user' ? 'user-message' : 'ai-message';
        
        const avatar = document.createElement('div');
        avatar.className = role === 'user' ? 'user-avatar' : 'ai-avatar';
        avatar.textContent = role === 'user' ? 'You' : 'AI';
        
        const bubble = document.createElement('div');
        bubble.className = role === 'user' ? 'user-bubble' : 'ai-bubble';
        bubble.textContent = content;
        
        messageElement.appendChild(avatar);
        messageElement.appendChild(bubble);
        aiAssistantMessages.appendChild(messageElement);
        
        // Add to conversation history with proper role mapping
        conversationHistory.push({
            role: role === 'user' ? 'user' : 'assistant',
            content: content
        });
        
        // Limit conversation history to 10 messages to avoid tokens limit
        if (conversationHistory.length > 10) {
            conversationHistory = conversationHistory.slice(-10);
        }
        
        // Scroll to bottom
        aiAssistantMessages.scrollTop = aiAssistantMessages.scrollHeight;
    }
    
    async function sendToOpenRouter(message) {
        try {
            // Show typing indicator with minimum display time
            const startTime = Date.now();
            
            // Make API request
            const response = await fetch('/api/ai-assistant/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    message: message,
                    history: conversationHistory
                })
            });
            
            // Ensure typing indicator shows for at least 800ms for better UX
            const elapsedTime = Date.now() - startTime;
            if (elapsedTime < 800) {
                await new Promise(resolve => setTimeout(resolve, 800 - elapsedTime));
            }
            
            // Hide typing indicator
            aiTypingIndicator.classList.remove('active');
            
            if (!response.ok) {
                console.error("API Error:", response.status);
                addMessage('assistant', 'I encountered an error processing your request. Please try again.');
                return;
            }
            
            const data = await response.json();
            
            if (data.success && data.reply) {
                // Add AI response to chat
                addMessage('assistant', data.reply);
            } else {
                // Show error message
                addMessage('assistant', 'Sorry, I couldn\'t generate a proper response. Please try asking in a different way.');
            }
            
        } catch (error) {
            console.error('Error sending to OpenRouter:', error);
            aiTypingIndicator.classList.remove('active');
            addMessage('assistant', 'I apologize for the technical difficulty. Please try again in a moment.');
        }
    }
    
    // Initialize with a greeting to show the assistant is ready
    setTimeout(() => {
        const initialMessage = aiAssistantMessages.querySelector('.ai-message .ai-bubble');
        if (initialMessage) {
            // Add initial message to conversation history
            conversationHistory.push({
                role: 'assistant',
                content: initialMessage.textContent
            });
        }
    }, 500);
    
    console.log("AI Assistant JS initialized");
});
