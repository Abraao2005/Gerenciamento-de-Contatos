<x-head title="Lista de Contatos">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Contatos</h1>
        <a href="{{ route('contatos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Novo Contato
        </a>
    </div>

    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="py-3 px-4">Nome</th>
                <th class="py-3 px-4">Email</th>
                <th class="py-3 px-4">Telefone</th>
                <th class="py-3 px-4">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contatos as $contato)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $contato->nome }}</td>
                    <td class="py-3 px-4">{{ $contato->email }}</td>
                    <td class="py-3 px-4">{{ $contato->contato }}</td>
                    <td class="py-3 px-4 space-x-2">
                        <a href="{{ route('contatos.show', $contato) }}" class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('contatos.edit', $contato) }}"
                            class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('contatos.destroy', $contato) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-head>
