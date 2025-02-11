<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daytap - Login</title>
        @vite('resources/css/app.css')

    </head>

    <body class="bg-gradient-to-r shadow-sm from-indigo-500 via-purple-500 to-pink-500 flex justify-center items-center h-screen">

    
<div class="flex">
    <img src="{{URL::asset('/img/sanic.png')}}" class="rounded-l-3xl absolute: left-14 bottom-0 right-20"> 
        <div class="bg-white w-80 p-10 rounded-r-3xl flex flex-col justify-center items-center space-y-4">
            <h1 class="text-3xl font-bold font-sans">
                Daytap
            </h1>   
            @if(session('message'))
                <p class="text-red-500"><b>{{ session('message') }}</b></p>
            @endif
            <form method="post" id="loginForm" action=" {{ route('login') }} ">
                {{ csrf_field() }}
                <div class="flex flex-col mb-7 justify-center ">
                    <label for="usuario"><b>Usuário</b></label>
                    <input type="text" id="name" name="name" class="bg-gray-100 inset-shadow-sm h-10 w-60 inset-shadow-gray-300 rounded p-2.5" placeholder="Usuário">
                </div>
                <div class="flex flex-col mb-3 justify-center ">
                    <label for="senha"><b>Senha</b></label>
                    <input type="text" id="password" name="password" class="bg-gray-100 inset-shadow-sm h-10 w-60 inset-shadow-gray-300 rounded p-2.5" placeholder="Senha">
                </div>
                <div class="flex flex-col mb-5 justify-center ">
                    <p class="text-gray-400 text-s">Não tem uma conta? <a class="text-blue-400" href="{{ route('createAccount')}}"><b>Cadastre-se</b></a></p>
                </div>
                <div class="flex flex-col justify-center ">
                    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border shadow-lg shadow-[#6672ad] border-blue-500 hover:border-transparent rounded">
                        Login
                        </button>
                </div>

            </form>
        </div>
</div>

    </body>

  
</html>
