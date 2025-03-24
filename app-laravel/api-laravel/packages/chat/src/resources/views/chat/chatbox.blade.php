<!-- (A) CSS + JS -->
<link rel="stylesheet" href="{{ mix('packages/chat/css/main.css') }}"/>
<script>
  // Default:
  // const CHAT_SCHEME = 'ws'
  // const CHAT_HOST = window.location.hostname
  // const CHAT_PORT = '8011'
  // const CHAT_ROUTE = 'ws'
  // Configured:
  const CHAT_SCHEME = '{{config('chat.client_side.scheme')}}'
  const CHAT_HOST = '{{config('chat.client_side.host')}}'
  const CHAT_PORT = '{{config('chat.client_side.port')}}'
  const CHAT_ROUTE = '{{config('chat.client_side.route')}}'
</script>
<script src="{{ mix('packages/chat/js/main.js') }}"></script>

<div id="chat-box-container" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <!-- (B1) CHAT MESSAGES -->
    <div id="chat-message-list" class="p-3 max-h-60 overflow-y-auto">
        <!-- Messages will be loaded here -->
    </div>

    <!-- (B2) SET NAME & (B3) SEND MESSAGE -->
    <div id="chat_input_container" class="p-3 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center mb-2 mx-2">
            <label class="w-20 text-sm text-gray-600 font-medium" id="chat_username_label" for="chat_username">
                Username:
            </label>
            <input class="flex-1 px-3 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2
             focus:ring-blue-500 focus:border-transparent w-10"
                   type="text" id="chat_username" name="chat_username"
                   value="test1"
                   aria-describedby="chat_username_label">
        </div>

        <div class="flex items-center mb-3 mx-2">
            <label class="w-20 text-sm text-gray-600 font-medium" id="chat_message_label" for="chat_message">
                Message:
            </label>
            <input class="flex-1 px-3 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2
            focus:ring-blue-500 focus:border-transparent w-10"
                   type="text" id="chat_message" name="chat_message"
                   value="test message"
                   aria-describedby="chat_message_label">
        </div>

        <div class="flex space-x-2">
            <button id="chat_send" type="button"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded transition duration-200">
                Send
            </button>
            <button id="toggleBtn" type="button"
                    class="border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm py-1 px-3 rounded transition duration-200"
                    data-toggle="button" aria-pressed="false">
                ◃Toggle▹
            </button>
            <a class="border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm py-1 px-3 rounded transition duration-200"
               role="button" href="/chat/test" target="_blank">
                New window
            </a>
        </div>
    </div>
</div>
