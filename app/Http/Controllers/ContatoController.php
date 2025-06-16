<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            Contato::create($request->validated());
            return redirect()->route('contatos.home')->with('success', 'Contato criado com sucesso!');
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
            $contato = Contato::findOrFail($id);

            $contato->update($request->validated());

            return redirect()->route('contatos.home')->with('success', 'Contato atualizado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('contatos.home')->with('error', 'Contato não encontrado.');
        } catch (PDOException $e) {
            Log::error("Erro ao atualizar contato: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao atualizar contato. Tente novamente.');
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
