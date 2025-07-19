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
            <form action="{{route('AjukanPembayaran')}}" method="post" class="" enctype="multipart/form-data">
                @csrf
                <div class="mt-5">
                    <h2 class="text-center text-xl pt-5 font-semibold">SPPKu</h2>

                    <h1 class="text-center text-2xl pt-3 font-semibold">Ajukan Pembayaran</h1>
                    <div class="flex justify-start pl-12 pt-5">
                        <h1>Nama Sekolah</h1><p class="text-red-500 pl-1">*</p>
                        
                    </div>
                    <div class="lg:pl-12 pl-12 pt-2">
                        <select name="sekolah" id="" class="border border-gray-300 rounded-xl p-2 w-100">
                            @foreach ( $nama_sekolah as $single_data)
                                    <option value={{$single_data->id}}>{{$single_data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-start pl-12 pt-5">
                        <h1>Nama Siswa</h1><p class="text-red-500 pl-1">*</p>
                        
                    </div>
                    <div class="pl-12 pt-2">
                        <input type="text" name="nama" class="border border-gray-300 rounded-xl p-1 w-100" id="">
                    </div>
                    
                    <div class="pl-12 mt-5">
                        <p>Bukti</p>
                    </div>
                    <div class="justify-self-center border border-gray-300 mt-1 rounded-xl mr-2">
                        <input name="file" type="file" class="p-2 w-100">
                    </div>
                   @if(session('info_bayar'))
                    <ul class="text-center mt-5 text-green-500">
                                <li>Informasi : {{session('info_bayar')}}</li>
                    </ul>
                    @endif
                    <div class="pl-12">
                        <button class="w-100 bg-indigo-500 rounded-xl justify-self-center mt-5 p-1 text-white mb-10">Ajukan</button>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>