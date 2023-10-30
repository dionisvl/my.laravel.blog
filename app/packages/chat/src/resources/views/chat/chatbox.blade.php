<!-- (A) CSS + JS -->
<link rel="stylesheet" href="{{ mix('packages/chat/css/main.css') }}"/>
<script>
    // Default:
    // const CHAT_SCHEME = 'ws'
    const CHAT_HOST = window.location.hostname
    // const CHAT_PORT = '8011'
    // const CHAT_ROUTE = 'ws'
    // Configured:
    const CHAT_SCHEME = '{{config('chat.client_side.scheme')}}'
    {{--const CHAT_HOST = '{{config('chat.client_side.host')}}'--}}
    const CHAT_PORT = '{{config('chat.client_side.port')}}'
    const CHAT_ROUTE = '{{config('chat.client_side.route')}}'
</script>
<script src="{{ mix('packages/chat/js/main.js') }}"></script>

<div id="chat-box-container">
    <!-- (B1) CHAT MESSAGES -->
    <div id="chat-message-list">
    </div>
    <!-- (B2) SET NAME -->
    <!-- (B3) SEND MESSAGE -->
    <div id="chat_input_container">
        <div class="input-group input-group-sm mb-sm-1">
            <div class="input-group-prepend">
                <label class="chat_label input-group-text" id="chat_username_label" for="chat_username">
                    Username:
                </label>
            </div>
            <input class="chat_input form-control" type="text" id="chat_username" name="chat_username"
                   value="test1"
                   aria-describedby="chat_username_label">
        </div>
        <div class="input-group input-group-sm mb-sm-1">
            <div class="input-group-prepend">
                <label class="chat_label input-group-text" id="chat_message_label" for="chat_message">
                    Message:
                </label>
            </div>
            <input class="chat_input form-control" type="text" id="chat_message" name="chat_username"
                   value="test message"
                   aria-describedby="chat_message_label">
        </div>
        <button id="chat_send" type="button" class="btn btn-primary btn-sm">Send</button>
        <button id="toggleBtn" type="button" class="btn btn-outline-secondary btn-sm"
                data-toggle="button" aria-pressed="false">◃toggle▹
        </button>
        <a class="btn btn-outline-secondary btn-sm" role="button" href="/chat/test" target="_blank">Open in new
            window</a>
    </div>
</div>
