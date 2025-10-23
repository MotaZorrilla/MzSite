<!-- Chat Window -->
<div x-show="showChat" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4"
     class="chat-window" 
     style="position: fixed; bottom: 80px; right: 20px; width: 350px; max-width: 90%; height: 500px; background-color: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); z-index: 1000; display: flex; flex-direction: column; overflow: hidden;">

    <!-- Header -->
    <div class="chat-header" style="padding: 15px; background-color: #007bff; color: white; display: flex; justify-content: space-between; align-items: center;">
        <h5 style="margin: 0;">AI Assistant</h5>
        <button @click="showChat = false" style="background: none; border: none; color: white; font-size: 20px; cursor: pointer;">&times;</button>
    </div>

    <!-- Message Area -->
    <div class="chat-messages" x-ref="messageContainer" style="flex-grow: 1; padding: 15px; overflow-y: auto; background-color: #f9f9f9;">
        <!-- Messages will be appended here by Alpine.js -->
        <template x-for="message in messages" :key="message.id">
            <div :class="message.from === 'user' ? 'user-message' : 'ai-message'" style="margin-bottom: 10px; display: flex; flex-direction: column;">
                <div class="message-content" 
                     :style="message.from === 'user' ? 'align-self: flex-end; background-color: #007bff; color: white; border-radius: 10px 10px 0 10px;' : 'align-self: flex-start; background-color: #e9e9eb; color: #333; border-radius: 10px 10px 10px 0;'"
                     style="padding: 8px 12px; max-width: 80%;">
                    <p x-text="message.text" style="margin: 0;"></p>
                </div>
            </div>
        </template>
        <div x-show="loading" class="ai-message" style="margin-bottom: 10px; display: flex; flex-direction: column;">
             <div class="message-content" style="align-self: flex-start; background-color: #e9e9eb; color: #333; border-radius: 10px 10px 10px 0; padding: 8px 12px; max-width: 80%;">
                <p style="margin: 0;"><i>Typing...</i></p>
            </div>
        </div>
    </div>

    <!-- Input Area -->
    <div class="chat-input" style="padding: 10px; border-top: 1px solid #ddd;">
        <form @submit.prevent="sendMessage">
            <input x-model="newMessage" x-ref="chatInput" type="text" placeholder="Ask me about Héctor..." style="width: 100%; border: 1px solid #ccc; border-radius: 20px; padding: 8px 15px; font-size: 14px;">
        </form>
    </div>
</div>
