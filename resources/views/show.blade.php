<x-head title="Detalhes do Contato">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">{{ $contato->nome }}</h1>
        <p><strong>Email:</strong> {{ $contato->email }}</p>
        <p><strong>Telefone:</strong> {{ $contato->contato }}</p>

        <div class="mt-6 space-x-3">
            <a href="{{ route('contatos.edit', $contato) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Editar
            </a>
            <a href="{{ route('contatos.home') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Voltar
            </a>
        </div>
    </div>
</x-head>
