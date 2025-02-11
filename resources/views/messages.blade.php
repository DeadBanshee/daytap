<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daytap</title>
        @vite('resources/css/app.css')

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
            Sair</button>
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
                <form method="post">
                {{ csrf_field() }}
                
                    <button type="submit" class="bg-gray-200 backdrop-blur-md cursor-pointer shadow-lg rounded-3xl p-3 flex items-center space-x-3 w-full text-left">
                        <img src="{{ URL::asset('/userPics/' . $matchTarget->user_image) }}" class="w-12 h-12 rounded-full border-2 border-gray-400">
                        <h1 class="text-gray-900 font-semibold text-lg">{{ $matchTarget->name }}</h1>
                    </button>

                </form>


                @endforeach


            </div>
        </div>

</body>

  
</html>
