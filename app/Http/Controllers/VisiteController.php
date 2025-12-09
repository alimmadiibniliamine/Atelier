<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Visite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class VisiteController extends Controller
{
    // Page principale : formulaire + historique
    public function index(Request $request)
    {
        $search = $request->query('q');

        // Clients pour le select
        $clients = Client::orderBy('nom')->orderBy('prenom')->get();

        // Visites récentes, avec recherche par nom/prénom/entreprise
        $visites = Visite::with('client')
            ->when($search, function ($query, $search) {
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                      ->orWhere('prenom', 'like', "%$search%")
                      ->orWhere('entreprise', 'like', "%$search%");
                });
            })
            ->orderByDesc('arrivee_at')
            ->paginate(10)
            ->withQueryString();

        return view('visites.index', compact('clients', 'visites', 'search'));
    }

    // Rediriger /visites/create vers index (car tout est sur une seule page)
    public function create()
    {
        return redirect()->route('visites.index');
    }

    // Enregistrer une nouvelle visite (arrivée)
    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'          => ['required', 'exists:clients,id'],
            'personne_rencontree'=> ['required', 'string', 'max:255'],
            'motif'              => ['required', 'string', 'max:255'],
            'arrivee_at'         => ['required', 'date'],
        ]);

        // `datetime-local` renvoie un format "YYYY-MM-DDTHH:MM"
        $data['arrivee_at'] = Carbon::parse($data['arrivee_at']);
        $data['statut'] = 'EN_COURS';

        Visite::create($data);

        return redirect()
            ->route('visites.index')
            ->with('success', 'Arrivée du visiteur enregistrée avec succès.');
    }

    // Enregistrer le départ (clôturer la visite)
    public function depart(Request $request, Visite $visite)
    {
        if ($visite->statut === 'TERMINEE') {
            return back()->with('info', 'Cette visite est déjà terminée.');
        }

        $visite->update([
            'depart_at' => now(),
            'statut'    => 'TERMINEE',
        ]);

        return back()->with('success', 'Départ du visiteur enregistré avec succès.');
    }




        /**
     * Builder commun pour les filtres (client, date, motif, personne rencontrée)
     */
    private function buildVisitesQuery(Request $request)
    {
        $query = Visite::with('client');

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->input('client_id'));
        }

        if ($request->filled('date')) {
            $query->whereDate('arrivee_at', $request->input('date'));
        }

        if ($request->filled('motif')) {
            $query->where('motif', $request->input('motif'));
        }

        if ($request->filled('personne_rencontree')) {
            $query->where('personne_rencontree', $request->input('personne_rencontree'));
        }

        return $query->orderByDesc('arrivee_at');
    }

    /**
     * Historique avancé (maquette Historique des Visites)
     */
    public function historique(Request $request)
    {
        $clients   = Client::orderBy('nom')->orderBy('prenom')->get();
        $motifs    = Visite::select('motif')->distinct()->orderBy('motif')->pluck('motif');
        $personnes = Visite::select('personne_rencontree')->distinct()->orderBy('personne_rencontree')->pluck('personne_rencontree');

        $visites = $this->buildVisitesQuery($request)
            ->paginate(10)
            ->withQueryString();

        return view('visites.historique', [
            'clients'   => $clients,
            'motifs'    => $motifs,
            'personnes' => $personnes,
            'visites'   => $visites,
            'filters'   => $request->only(['client_id', 'date', 'motif', 'personne_rencontree']),
        ]);
    }

    /**
     * Export CSV des visites filtrées
     */
    public function export(Request $request): StreamedResponse
    {
        $fileName = 'visites_' . now()->format('Ymd_His') . '.csv';

        $query = $this->buildVisitesQuery($request);

        $response = new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');

            // En-têtes CSV
            fputcsv($handle, [
                'Date arrivée',
                'Date départ',
                'Client',
                'Entreprise',
                'Motif',
                'Personne rencontrée',
                'Statut',
            ], ';');

            $query->chunk(200, function ($rows) use ($handle) {
                foreach ($rows as $visite) {
                    fputcsv($handle, [
                        optional($visite->arrivee_at)->format('Y-m-d H:i'),
                        optional($visite->depart_at)->format('Y-m-d H:i'),
                        $visite->client?->nom . ' ' . $visite->client?->prenom,
                        $visite->client?->entreprise,
                        $visite->motif,
                        $visite->personne_rencontree,
                        $visite->statut,
                    ], ';');
                }
            });

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'"');

        return $response;
    }

    /**
     * Rapport détaillé d’une visite (page Voir le rapport)
     */
    public function show(Visite $visite)
    {
        $visite->load('client');

        return view('visites.show', compact('visite'));
    }

}
