<!-- (A) CSS + JS -->
<link rel="stylesheet" href="{{ mix('packages/chat/css/main.css') }}"/>
<script>
  const CHAT_SCHEME = '{{config('chat.client_side.scheme')}}'
  const CHAT_HOST = '{{config('chat.client_side.host')}}'
  const CHAT_PORT = '{{config('chat.client_side.port')}}'
  const CHAT_USER_COLOR = '@php echo config('chat.colors')[array_rand(config('chat.colors'))] @endphp'
</script>
<script src="{{ mix('packages/chat/js/main.js') }}"></script>

<!-- (B) CHAT DOCKET -->
<div id="chat-wrap">
    <!-- (B1) CHAT MESSAGES -->
    <div id="chat-messages"></div>

    <!-- (B2) SET NAME -->
    <form id="chat-name" onsubmit="return chat.start()">
        <input type="text" id="chat-name-set" placeholder="What is your name?" value="Some Username" required/>
        <input type="submit" id="chat-name-go" value="Start"/>
    </form>

    <!-- (B3) SEND MESSAGE -->
    <form id="chat-send" onsubmit="return chat.send()">
        <input type="text" id="chat-send-text" placeholder="Enter message" required/>
        <input type="submit" id="chat-send-go" value="Send"/>
    </form>
</div>
