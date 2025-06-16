<x-head title="{{ isset($contato) ? 'Editar Contato' : 'Novo Contato' }}">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            {{ isset($contato) ? 'Editar Contato' : 'Adicionar Novo Contato' }}
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Erro!</strong> Por favor corrija os seguintes campos:
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ isset($contato) ? route('contatos.update', $contato) : route('contatos.store') }}"
            class="space-y-6">
            @csrf
            @if (isset($contato))
                @method('PUT')
            @endif

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $contato->nome ?? '') }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $contato->email ?? '') }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required>
            </div>

            <div>
                <label for="contato" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <input type="tel" id="contato" name="contato"
                    value="{{ old('contato', $contato->contato ?? '') }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="+55 11 91234-5678" required>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-200">
                    {{ isset($contato) ? 'Atualizar' : 'Salvar' }}
                </button>
            </div>
        </form>
    </div>
</x-head>


<script>
    document.getElementById('contato').addEventListener('input', function(e) {
        let input = e.target;
        let value = input.value.replace(/\D/g, '');

        if (value.startsWith('55')) {
            value = value.slice(2);
        }

        if (value.length <= 11) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3')
                .replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
        } else {
            value = '+' + value;
            value = value.replace(/^(\+\d{1,3})(\d{1,4})(\d{1,4})(\d{0,4})$/, '$1 $2 $3 $4');
        }

        input.value = value.trim();
    });
</script>
