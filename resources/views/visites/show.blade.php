<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8">
    <title>Rapport de visite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-xl shadow-lg p-8 max-w-xl w-full">
    <h1 class="text-2xl font-bold mb-4">Rapport de visite</h1>

    <dl class="space-y-3 text-sm">
        <div>
            <dt class="font-semibold text-slate-600">Client</dt>
            <dd class="text-slate-900">
                {{ $visite->client?->nom }} {{ $visite->client?->prenom }}
                @if($visite->client?->entreprise)
                    ({{ $visite->client->entreprise }})
                @endif
            </dd>
        </div>
        <div>
            <dt class="font-semibold text-slate-600">Motif</dt>
            <dd class="text-slate-900">{{ $visite->motif }}</dd>
        </div>
        <div>
            <dt class="font-semibold text-slate-600">Personne rencontrée</dt>
            <dd class="text-slate-900">{{ $visite->personne_rencontree }}</dd>
        </div>
        <div>
            <dt class="font-semibold text-slate-600">Arrivée</dt>
            <dd class="text-slate-900">{{ optional($visite->arrivee_at)->format('d/m/Y H:i') }}</dd>
        </div>
        <div>
            <dt class="font-semibold text-slate-600">Départ</dt>
            <dd class="text-slate-900">
                @if($visite->depart_at)
                    {{ $visite->depart_at->format('d/m/Y H:i') }}
                @else
                    Non renseigné
                @endif
            </dd>
        </div>
        <div>
            <dt class="font-semibold text-slate-600">Statut</dt>
            <dd class="text-slate-900">{{ $visite->statut }}</dd>
        </div>
    </dl>

    <div class="mt-6 flex justify-between">
        <a href="{{ url()->previous() }}" class="text-sm text-primary hover:underline">
            ← Retour
        </a>
        <a href="{{ route('visites.export', ['client_id' => $visite->client_id]) }}" class="text-sm text-primary hover:underline">
            Exporter les visites de ce client
        </a>
    </div>
</div>
</body>
</html>
