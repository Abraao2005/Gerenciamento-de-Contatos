<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use PDOException;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::all();
        return view("home", ["contatos" => $contatos]);
    }

    public function create()
    {
        return view("form");
    }

    public function store(ContatoRequest $request)
    {
        try {
            $contato = Contato::create($request->validated());
            return redirect()->route('contatos.create', ["contato" => $contato]);
        } catch (PDOException $e) {
            Log::error("Erro ao criar contato: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao criar contato. Tente novamente.');
        }
    }

    public function show(string $id)
    {
        try {
            $contato = Contato::findOrFail($id);
            return view("show", ["contato" => $contato]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contatos.home')->with('error', 'Contato não encontrado.');
        }
    }

    public function edit(string $id)
    {
        try {
            $contato = Contato::findOrFail($id);
            return view("form", ["contato" => $contato]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contatos.home')->with('error', 'Contato não encontrado.');
        }
    }

    public function update(ContatoRequest $request, string $id)
    {
        try {
            $contato = Contato::create($request->validated());

            return redirect()->route('contatos.create', ['contato' => $contato])
                ->with('success', 'Contato criado com sucesso!');
        } catch (QueryException $e) {
            Log::error("Erro ao criar contato: " . $e->getMessage());

            $errorMessage = 'Erro ao criar contato. Tente novamente.';

            if (str_contains($e->getMessage(), 'contatos_email_unique')) {
                $errorMessage = 'O e-mail informado já está em uso.';
            } elseif (str_contains($e->getMessage(), 'contatos_contato_unique')) {
                $errorMessage = 'O número de contato informado já está em uso.';
            }

            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage);
        }
    }

    public function destroy(string $id)
    {
        try {
            $contato = Contato::findOrFail($id);
            $contato->delete();

            return redirect()->route('contatos.home')->with('success', 'Contato excluído com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contatos.home')->with('error', 'Contato não encontrado.');
        } catch (PDOException $e) {
            Log::error("Erro ao excluir contato: " . $e->getMessage());
            return redirect()->route('contatos.home')->with('error', 'Erro ao excluir contato.');
        }
    }
}
