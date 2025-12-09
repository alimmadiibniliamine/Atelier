<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Enregistrement des Visites</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-white/90">

<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">

    {{-- Header --}}
    <header class="sticky top-0 z-10 flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-4 sm:px-6 md:px-10 py-3 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm">
        <div class="flex items-center gap-4 text-[#0d121b] dark:text-white">
            <div class="size-6 text-primary">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                </svg>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">
                Gestion des Visites - Kara SAMB
            </h2>
        </div>
        <div class="flex flex-1 justify-end gap-3">
            <button class="flex items-center justify-center rounded-full h-10 w-10 bg-slate-200/80 dark:bg-slate-800/80 text-[#0d121b] dark:text-white text-sm font-bold">
                <span class="material-symbols-outlined text-xl">notifications</span>
            </button>
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                 style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAupna637UbWQyASbkO37qPkT7VX5I5msGIDV1hIxxmOdiFWAKTLU7buPEwGzt9u9UAO7KM1ayCA6xU9yTsphm6ma7tit90aexrTg1Zmkuio7iuiqa5JmPdp6_ImDPVYoOYv-IKq7gTVLG264EXW0NOq4FYGKiwf2LEq_fORMFUUwMrOaoq7FJMLF3Pq6NWcPOzP5H_kiD-EpIvpFHqZx768QtSitgeXXm7ZWh8DCZb-GZLpseS6OXNNM9I_wstBWNQNpHgSkmxMg");'>
            </div>
        </div>
    </header>

    <main class="layout-container flex h-full grow flex-col">
        <div class="px-4 sm:px-6 md:px-10 flex flex-1 justify-center py-8">
            <div class="layout-content-container flex flex-col w-full">

               <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
    <p class="text-4xl font-black leading-tight tracking-[-0.033em] min-w-72 dark:text-white">
        Enregistrement des Visites
    </p>

    <!-- Bouton Historique Avancé -->
            <a href="{{ route('visites.historique') }}"
            class="flex items-center gap-2 rounded-lg bg-primary text-white h-10 px-4 text-sm font-bold 
                    hover:bg-primary/90 transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-white text-lg">history</span>
                Historique avancé
            </a>
        </div>


                {{-- Messages flash --}}
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('info'))
                    <div class="mb-4 rounded-lg bg-blue-100 text-blue-800 px-4 py-3 text-sm">
                        {{ session('info') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Colonne gauche : Formulaire --}}
                    <div class="lg:col-span-1 bg-white dark:bg-slate-900/70 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] mb-6 dark:text-white">
                            Ajouter une nouvelle visite
                        </h2>

                        <form class="flex flex-col gap-5" method="POST" action="{{ route('visites.store') }}">
                            @csrf

                            {{-- Client (nom du visiteur) --}}
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text-white/90">
                                    Nom du Visiteur
                                </p>
                                <select
                                    name="client_id"
                                    class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                           text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50
                                           border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800
                                           h-12 p-3 text-base font-normal leading-normal">
                                    <option value="">-- Sélectionner un client --</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>
                                            {{ $client->nom }} {{ $client->prenom }} @if($client->entreprise) ({{ $client->entreprise }}) @endif
                                        </option>
                                    @endforeach
                                </select>
                            </label>

                            {{-- Personne rencontrée --}}
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text-white/90">
                                    Personne Rencontrée
                                </p>
                                <input
                                    name="personne_rencontree"
                                    value="{{ old('personne_rencontree') }}"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                           text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50
                                           border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800
                                           h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-base font-normal"
                                    placeholder="Qui le visiteur vient-il voir ?">
                            </label>

                            {{-- Motif --}}
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text-white/90">
                                    Motif de la Visite
                                </p>
                                <select
                                    name="motif"
                                    class="form-select flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                           text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50
                                           border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800
                                           h-12 p-3 text-base font-normal leading-normal">
                                    <option value="Réunion" @selected(old('motif') == 'Réunion')>Réunion</option>
                                    <option value="Livraison" @selected(old('motif') == 'Livraison')>Livraison</option>
                                    <option value="Entretien" @selected(old('motif') == 'Entretien')>Entretien</option>
                                    <option value="Autre" @selected(old('motif') == 'Autre')>Autre</option>
                                </select>
                            </label>

                            {{-- Heure d'arrivée --}}
                            <label class="flex flex-col">
                                <p class="text-base font-medium leading-normal pb-2 dark:text-white/90">
                                    Heure d'Arrivée
                                </p>
                                <input
                                    type="datetime-local"
                                    name="arrivee_at"
                                    value="{{ old('arrivee_at') }}"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg
                                           text-[#0d121b] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50
                                           border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800
                                           h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-base font-normal">
                            </label>

                            <button
                                class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12
                                       bg-primary text-white gap-2 text-base font-bold leading-normal tracking-[0.015em]
                                       mt-4 hover:bg-primary/90 transition-colors">
                                <span class="material-symbols-outlined">login</span>
                                Enregistrer l'Arrivée
                            </button>
                        </form>
                    </div>

                    {{-- Colonne droite : Historique --}}
                    <div class="lg:col-span-2 bg-white dark:bg-slate-900/70 p-6 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">

                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                            <h2 class="text-2xl font-bold leading-tight tracking-[-0.015em] dark:text-white">
                                Historique des Visites Récentes
                            </h2>

                            <form method="GET" action="{{ route('visites.index') }}" class="relative w-full sm:w-64">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                    search
                                </span>
                                <input
                                    class="form-input w-full rounded-lg border border-slate-300 dark:border-slate-700
                                           bg-background-light dark:bg-slate-800 h-10 pl-10
                                           placeholder:text-slate-400 dark:placeholder:text-slate-500
                                           focus:ring-2 focus:ring-primary/50 focus:outline-none"
                                    placeholder="Rechercher un visiteur..."
                                    type="text"
                                    name="q"
                                    value="{{ $search }}">
                            </form>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400">
                                <tr>
                                    <th class="p-3 font-medium">Nom du Visiteur</th>
                                    <th class="p-3 font-medium">Personne Rencontrée</th>
                                    <th class="p-3 font-medium">Arrivée</th>
                                    <th class="p-3 font-medium">Départ</th>
                                    <th class="p-3 font-medium">Statut</th>
                                    <th class="p-3 font-medium">Action</th>
                                </tr>
                                </thead>
                                <tbody class="dark:text-white/90">
                                @forelse ($visites as $visite)
                                    <tr class="border-b border-slate-200 dark:border-slate-800">
                                        <td class="p-3 font-medium">
                                            {{ $visite->client->nom }} {{ $visite->client->prenom }}
                                            @if ($visite->client->entreprise)
                                                <span class="text-xs text-slate-500">({{ $visite->client->entreprise }})</span>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            {{ $visite->personne_rencontree }}
                                        </td>
                                        <td class="p-3">
                                            {{ $visite->arrivee_at?->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="p-3">
                                            @if ($visite->depart_at)
                                                {{ $visite->depart_at->format('d/m/Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @if ($visite->statut === 'EN_COURS')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 dark:bg-green-900/50 px-2.5 py-1 text-xs font-medium text-green-800 dark:text-green-300">
                                                    <span class="size-2 rounded-full bg-green-500"></span>
                                                    En cours
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 dark:bg-slate-800 px-2.5 py-1 text-xs font-medium text-slate-800 dark:text-slate-300">
                                                    <span class="size-2 rounded-full bg-slate-500"></span>
                                                    Terminée
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @if ($visite->statut === 'EN_COURS')
                                                <form method="POST" action="{{ route('visites.depart', $visite) }}">
                                                    @csrf
                                                    <button
                                                        class="flex items-center justify-center text-sm font-medium text-primary hover:text-primary/80">
                                                        Enregistrer le Départ
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-slate-400">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center text-slate-500 dark:text-slate-400">
                                            Aucune visite enregistrée pour le moment.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $visites->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</div>
</body>
</html>
