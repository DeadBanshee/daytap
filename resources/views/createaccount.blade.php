<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daytap - Create</title>
        @vite('resources/css/app.css')

    </head>

    <body class="bg-gradient-to-r shadow-sm inset-shadow-gray-300  from-indigo-500 via-blue-500 to-green-500 flex justify-center items-center  h-screen">
        <div class="bg-white w-80 p-10 rounded flex flex-col justify-center items-center space-y-4">
            <h1 class="text-3xl font-bold font-sans">
                Daytap
            </h1>
            <form method="post" id="createAccount" action="{{ route('storeNewAccount') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="flex flex-col mb-3 justify-center ">
                    <label for="usuario"><b>Usuário</b></label>
                    <input type="text" id="name" name="name" class="bg-gray-100 inset-shadow-sm h-10 w-60 inset-shadow-gray-300 rounded" placeholder=" Usuário">
                </div>
                <div class="flex flex-col mb-3 justify-center ">
                    <label for="senha"><b>Nova Senha</b></label>
                    <input type="text" id="password" name="password" class="bg-gray-100 inset-shadow-sm h-10 w-60 inset-shadow-gray-300 rounded" placeholder=" Nova Senha">
                </div>
                <div class="flex flex-col mb-3 justify-center ">
                    <label for="senha"><b>Confirmar Nova Senha</b></label>
                    <input type="text" class="bg-gray-100 inset-shadow-sm h-10 w-60 inset-shadow-gray-300 rounded" placeholder=" Nova Senha">
                </div>

                <label class="block">
                <span class="sr-only">Escolher foto de perfil</span>
                <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                "/>
                </label>

                <div class="flex flex-col mb-3 justify-center ">
                    <label for="senha"><b>Descrição:</b></label>
                    <input type="text" name="desc" id="desc" class="bg-gray-100 inset-shadow-sm h-10 w-60 inset-shadow-gray-300 rounded" placeholder="Descrição">
                </div>

                <div class="flex flex-col mb-5 mt-5 justify-center ">
                    <a class="text-blue-400" href="{{ route('welcome')}}"><b>Ir para o Login</b></a>
                </div>
                <div class="flex flex-col justify-center ">
                    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Create
                        </button>
                </div>

            </form>
        </div>
    </body>
</html>