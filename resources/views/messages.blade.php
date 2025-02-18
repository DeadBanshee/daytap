<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daytap</title>
        @vite('resources/css/app.css')
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body class="bg-gradient-to-r shadow-sm from-indigo-500 via-purple-500 to-pink-500 flex justify-center items-center h-screen">

        <div class="absolute top-5 left-5 ">
            <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-3xl p-3 flex items-center space-x-3">
                <img src="{{ URL::asset('/userPics/' . session('person_picture')) }}" class="w-12 h-12 rounded-full border-2 border-gray-300"> 
                <h1 class="text-gray-900 font-semibold text-lg">{{ session('person_name') }}</h1>
            </div>

            <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-3xl p-3 mt-5">
                <a href="{{ route('homepage') }}" class="flex items-center space-x-2 text-gray-900 font-semibold text-lg">
                    <img src="{{ URL::asset('/img/home.png') }}" class="w-6 h-6">
                    <span>Homepage</span>
                </a>
            </div>
        </div>

        <div class="absolute bottom-5 left-5">
            <form method="post" id="logout" action="{{ route('logout')}}">
                {{ csrf_field() }}
                <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 ">
                    Sair
                </button>
            </form>
        </div>

        <div class="flex">

            @if (session('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="absolute top-10 bg-white w-80 p-10 rounded-3xl space-y-4">
                    <h1><b>{{ session('message') }}</b></h1>
                </div>
            @endif

            <div class="bg-white w-80 p-10 rounded-3xl flex flex-col justify-start items-start space-y-4">
                <h1 class="text-3xl font-bold font-sans">
                    Messages
                </h1>

                @foreach ($matchlist as $match)
                @php
                    $matchTarget = \App\Models\Person::where('id', $match->liked_id)->first();
                    if($matchTarget->id == session('person_id')){
                        $matchTarget = \App\Models\Person::where('id', $match->liker_id)->first();
                    }
                @endphp
                <form method="post" id="openChat" action="{{ route('openChat') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="chatID" value="{{ $matchTarget->id }}">
                    <button type="submit" class="bg-gray-200 backdrop-blur-md cursor-pointer shadow-lg rounded-3xl p-3 flex items-center space-x-3 w-full text-left">
                        <img src="{{ URL::asset('/userPics/' . $matchTarget->user_image) }}" class="w-12 h-12 rounded-full border-2 border-gray-400">
                        <h1 class="text-gray-900 font-semibold text-lg">{{ $matchTarget->name }}</h1>
                    </button>
                </form>
                @endforeach
            </div>

            @if (session('chatID'))
                @php
                    $chatTarget = \App\Models\Person::where('id', session('chatID'))->first();
                @endphp

                <div class="bg-white shadow-lg w-[400px] h-[500px] rounded-3xl flex flex-col p-4 space-y-4 ml-10">

                    {{-- Chat Header --}}
                    <div class="flex items-center space-x-3 border-b pb-3">
                        <img src="{{ URL::asset('/userPics/' . $chatTarget->user_image) }}" class="w-12 h-12 rounded-full border-2 border-gray-400">
                        <h1 class="text-lg font-bold">{{ $chatTarget->name }}</h1>
                    </div>

                    {{-- Messages Box --}}
                    <div id="messagesBox" class="flex-1 overflow-y-auto space-y-3 p-2 flex flex-col">
                        
                    @foreach(session('messageHistory') as $message)
                        <div class="flex justify-{{ $message->sender_id == session('person_id') ? 'end' : 'start' }} p-3">
                            <div class="{{ $message->sender_id == session('person_id') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-900' }} break-words p-3 rounded-lg w-fit max-w-[80%]">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endforeach

                    </div>

                    {{-- Input Box --}}
                    <div id="inputBox" class="flex items-center space-x-2">
                        <input type="text" class="flex-1 bg-gray-100 border border-gray-300 rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Digite sua mensagem...">
                        <button id="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Enviar</button>
                    </div>

                </div>
            @endif

        </div>

        <script>
            document.getElementById('sendMessage').addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default button action

                // Get the input message
                var messageInput = document.querySelector('#inputBox input');
                var message = messageInput.value.trim();
                if (!message) return; // Don't send if message is empty

                // Prepare data
                var receiverId = "{{ session('chatID') }}"; // The person you're chatting with
                var senderId = "{{ session('person_id') }}"; // Current logged-in user

                // Send the message via AJAX
                fetch("{{ route('sendMessages') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        sender_id: senderId,
                        receiver_id: receiverId,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        // Add message to chat box
                        var messageDiv = document.createElement('div');
                        messageDiv.classList.add('flex', 'justify-end');
                        messageDiv.innerHTML = `
                            <div class="bg-blue-500 text-white break-words p-3 rounded-lg w-fit max-w-[80%]">
                                ${data.message}
                            </div>
                        `;
                        document.getElementById('messagesBox').appendChild(messageDiv);

                        // Clear input field
                        messageInput.value = '';
                        messageInput.focus();
                    }
                })
                .catch(error => console.log(error));
            });

            // Short polling to receive new messages
            function fetchMessages() {
                var receiverId = "{{ session('chatID') }}"; // The person you're chatting with
                var senderId = "{{ session('person_id') }}"; // Current logged-in user

                fetch("{{ route('receiveMessages') }}", {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        data.forEach(function(message) {
                            var messageDiv = document.createElement('div');
                            if (message.sender_id === parseInt(senderId)) {
                                messageDiv.classList.add('flex', 'justify-end');
                                messageDiv.innerHTML = `
                                    <div class="bg-blue-500 text-white break-words p-3 rounded-lg w-fit max-w-[80%]">
                                        ${message.message}
                                    </div>
                                `;
                            } else {
                                messageDiv.classList.add('flex', 'justify-start');
                                messageDiv.innerHTML = `
                                    <div class="bg-gray-200 text-gray-900 p-3 rounded-lg w-fit max-w-[80%]">
                                        ${message.message}
                                    </div>
                                `;
                            }
                            document.getElementById('messagesBox').appendChild(messageDiv);
                        });
                    }
                })
                .catch(error => console.log(error));

                // Poll every 5 seconds
                setTimeout(fetchMessages, 5000);
            }

            // Start polling when the page is loaded
            document.addEventListener('DOMContentLoaded', function() {
                fetchMessages();
            });
        </script>

    </body>
</html>
