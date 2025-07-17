<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
   <!-- Tempat SignUp !-->
    <div class="justify-self-center w-128 bg-white shadow-xs lg:mt-65 mt-10 rounded-xl">
            <form action="{{route('Register')}}" method="post" class="">
                @csrf
                <div class="mt-5">
                    <h2 class="text-center text-xl pt-5 font-semibold">SPPKu</h2>

                    <h1 class="text-center text-2xl pt-3 font-semibold">Sign Up</h1>
                    <div class="flex justify-start pl-12 pt-5">
                        <h1>Name</h1><p class="text-red-500 pl-1">*</p>
                        
                    </div>
                    <div class="pl-12 pt-2">
                        <input type="text" name="name" class="border border-gray-300 rounded-xl p-1 w-100" id="">
                    </div>
                    <div class="flex justify-start pl-12 pt-5">
                        <h1>Email Address</h1><p class="text-red-500 pl-1">*</p>
                        
                    </div>
                    <div class="pl-12 pt-2">
                        <input type="password" name="email" class="border border-gray-300 rounded-xl p-1 w-100" id="">
                    </div>
                    <div class="flex justify-start pl-12 pt-5">
                        <h1>Password</h1><p class="text-red-500 pl-1">*</p>
                        
                    </div>
                    <div class="pl-12 pt-2">
                        <input type="password" name="password" class="border border-gray-300 rounded-xl p-1 w-100" id="">
                    </div>
                    @if ($errors->any())
                    <ul class="text-center text-red-500">
                                
                            
                        @foreach ($errors as $error )
                            <li></li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="pl-12">
                        <button class="w-100 bg-indigo-500 rounded-xl justify-self-center mt-5 p-1 text-white mb-10">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>