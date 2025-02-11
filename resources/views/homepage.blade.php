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
                <a href="{{ route('messages') }}" class="flex items-center space-x-2 text-gray-900 font-semibold text-lg">
                    <img src="{{ URL::asset('/img/bubble-chat.png') }}" class="w-6 h-6">
                    <span>Messages</span>
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

    @if($person)
        <div class="flex">
            <img src="{{ URL::asset('/userPics/' . $person->user_image) }}" class="w-100 h-100 rounded-l-3xl absolute: left-14 bottom-0 right-20"> 
            <div class="bg-white w-80 p-10 rounded-r-3xl flex flex-col justify-start items-start space-y-4">
                <h1 class="text-3xl font-bold font-sans">
                    {{ $person->name }}
                </h1>
                <p>
                    {{ $person->description }}
                </p>

                    <div class="flex">
                        <form method="post" id="likeUser" action="{{ route('likeUser') }}">
                            {{ csrf_field() }}
                                <input type="hidden" name="liked_person_id" value="{{ $person->id }}">
                                <button  type="submit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Like</button>
                        </form>


                        <form method="post" id="dislikeUser" action="{{ route('dislikeUser')}}">
                            {{ csrf_field() }}
                                <input type="hidden" name="disliked_person_id" value="{{ $person->id }}">
                                <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 ">Paia</button>
                        </form>
                    </div>

            </div>
        </div>
    @else
        <p class="text-white">No people available.</p>
    @endif
</body>

  
</html>
