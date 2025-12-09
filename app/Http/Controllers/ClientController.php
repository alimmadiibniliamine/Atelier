<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Liste + recherche
    public function index(Request $request)
    {
        $search = $request->query('q');

        $clients = Client::query()
            ->when($search, function ($query, $search) {
                $query->where('nom', 'like', "%$search%")
                      ->orWhere('prenom', 'like', "%$search%")
                      ->orWhere('telephone', 'like', "%$search%")
                      ->orWhere('entreprise', 'like', "%$search%");
            })
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients', 'search'));
    }

    // Formulaire ajout
    public function create()
    {
        return view('clients.create');
    }

    // Enregistrement
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'        => ['required', 'string', 'max:255'],
            'prenom'     => ['required', 'string', 'max:255'],
            'telephone'  => ['required', 'string', 'max:50'],
            'email'      => ['nullable', 'email', 'max:255'],
            'entreprise' => ['required', 'string', 'max:255'],
        ]);

        Client::create($data);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    // Formulaire modification
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Mise à jour
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'nom'        => ['required', 'string', 'max:255'],
            'prenom'     => ['required', 'string', 'max:255'],
            'telephone'  => ['required', 'string', 'max:50'],
            'email'      => ['nullable', 'email', 'max:255'],
            'entreprise' => ['required', 'string', 'max:255'],
        ]);

        $client->update($data);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    // Suppression (optionnel)
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
