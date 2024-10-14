<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload de Arquivo CNAB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                @if (session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                    <p>Arquivo enviado: {{ session('file') }}</p>
                @endif

                @if ($errors->any())
                    <ul style="color: red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file">Escolha o arquivo CNAB (txt):</label>
                    <input type="file" name="file" id="file" accept=".txt" required>
                    <button class="button-upload" type="submit">Enviar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
