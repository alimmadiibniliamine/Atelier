<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Historique des Visites</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0" rel="stylesheet"/>
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
<body class="font-display bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-white">

<div class="flex min-h-screen">
    <!-- SideNavBar -->
    <aside class="w-64 shrink-0 bg-[#f8f9fc] dark:bg-[#181f2c] border-r border-[#e7ebf3] dark:border-[#2a3140] p-4 flex flex-col justify-between">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 p-2">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                     style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDm31whziKfIledgo5A-QkgzjNJMm4j59XLAEZY--JWsHDN8jObyf0gAhqyFqRsDhY0wjY-RndwduAuI0lvnixEz9PD8BbOWtSSYTgQhmECQzOWDi9WT4rBCLXJmzWvQmWP9MOuM4K_muYGtEyyhiezn_ACPMTyfNMZedBytuikyQFkx_eAvPhyPXRha16Q-taoc2UHE_uTHQwalcL5jf7dFGVBZIJZnXpR42zCfusZ4AZK35LC8ZOFB4_u6i90j_5GODtYaDAaJQ");'>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-[#0d121b] dark:text-white text-base font-medium leading-normal">Kara SAMB</h1>
                    <p class="text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">Gestionnaire</p>
                </div>
            </div>
            <nav class="flex flex-col gap-2 mt-4">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors"
                   href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text-white">dashboard</span>
                    <p class="text-[#0d121b] dark:text-white text-sm font-medium leading-normal">Dashboard</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors"
                   href="{{ route('clients.index') }}">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">group</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Clients</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 dark:bg-primary/30"
                   href="{{ route('visites.historique') }}">
                    <span class="material-symbols-outlined text-primary dark:text:white" style="font-variation-settings: 'FILL' 1;">history</span>
                    <p class="text-primary dark:text:white text-sm font-bold leading-normal">Historique des Visites</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors"
                   href="#">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">bar_chart</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Rapports</p>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors"
                   href="#">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">toggle_on</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Paramètres</p>
                </a>
            </nav>
        </div>
        <div class="flex flex-col gap-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#e7ebf3] dark:hover:bg-primary/20 transition-colors w-full text-left">
                    <span class="material-symbols-outlined text-[#0d121b] dark:text:white">logout</span>
                    <p class="text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Déconnexion</p>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-7xl mx-auto">

            <!-- Messages flash -->
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

            <!-- PageHeading -->
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div class="flex flex-col">
                    <h1 class="text-[#0d121b] dark:text:white text-4xl font-black leading-tight tracking-[-0.033em]">
                        Historique des Visites
                    </h1>
                    <p class="text-[#4c669a] dark:text-[#a0aec0] text-base font-normal leading-normal mt-1">
                        Consultez, filtrez et exportez les détails de toutes les visites enregistrées.
                    </p>
                </div>

                <!-- Export : garde les filtres actuels -->
                <a href="{{ route('visites.export', request()->query()) }}"
                   class="flex items-center justify-center gap-2 cursor-pointer rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                    <span class="material-symbols-outlined text-white text-lg">download</span>
                    <span class="truncate">Exporter</span>
                </a>
            </div>

            <!-- Filtres -->
            <form method="GET" action="{{ route('visites.historique') }}"
                  class="flex flex-wrap gap-3 p-3 bg-white dark:bg-[#181f2c] rounded-xl border border-[#e7ebf3] dark:border-[#2a3140] mb-6">

                <!-- Client -->
                <div class="relative">
                    <span class="material-symbols-outlined text-lg absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        person
                    </span>
                    <select name="client_id"
                            class="h-8 pl-9 pr-7 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] text-[#0d121b] dark:text:white text-sm font-medium leading-normal hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors border-0">
                        <option value="">Tous les clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(($filters['client_id'] ?? null) == $client->id)>
                                {{ $client->nom }} {{ $client->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined text-lg absolute right-1 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        arrow_drop_down
                    </span>
                </div>

                <!-- Date -->
                <div class="relative">
                    <span class="material-symbols-outlined text-lg absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        calendar_month
                    </span>
                    <input type="date" name="date"
                           value="{{ $filters['date'] ?? '' }}"
                           class="h-8 pl-9 pr-3 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] text-[#0d121b] dark:text:white text-sm font-medium leading-normal hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors border-0">
                </div>

                <!-- Motif -->
                <div class="relative">
                    <span class="material-symbols-outlined text-lg absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        info
                    </span>
                    <select name="motif"
                            class="h-8 pl-9 pr-7 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] text-[#0d121b] dark:text:white text-sm font-medium leading-normal hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors border-0">
                        <option value="">Tous les motifs</option>
                        @foreach($motifs as $motif)
                            <option value="{{ $motif }}"
                                @selected(($filters['motif'] ?? null) == $motif)>
                                {{ $motif }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined text-lg absolute right-1 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        arrow_drop_down
                    </span>
                </div>

                <!-- Personne rencontrée -->
                <div class="relative">
                    <span class="material-symbols-outlined text-lg absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        groups
                    </span>
                    <select name="personne_rencontree"
                            class="h-8 pl-9 pr-7 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] text-[#0d121b] dark:text:white text-sm font-medium leading-normal hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors border-0">
                        <option value="">Toutes les personnes</option>
                        @foreach($personnes as $p)
                            <option value="{{ $p }}"
                                @selected(($filters['personne_rencontree'] ?? null) == $p)>
                                {{ $p }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined text-lg absolute right-1 top-1/2 -translate-y-1/2 text-[#4c669a] dark:text-[#a0aec0]">
                        arrow_drop_down
                    </span>
                </div>

                <div class="flex items-center gap-2 ml-auto">
                    <button type="submit"
                            class="flex h-8 items-center justify-center px-4 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90 transition-colors">
                        Appliquer les filtres
                    </button>
                    <a href="{{ route('visites.historique') }}"
                       class="flex h-8 items-center justify-center px-3 rounded-lg bg-[#e7ebf3] dark:bg-[#2a3140] text-[#0d121b] dark:text:white text-sm font-medium hover:bg-[#cfd7e7] dark:hover:bg-[#343a4a] transition-colors">
                        Réinitialiser
                    </a>
                </div>
            </form>

            <!-- Table -->
            <div class="bg-white dark:bg-[#181f2c] rounded-xl border border-[#e7ebf3] dark:border-[#2a3140] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                        <tr class="bg-[#f8f9fc] dark:bg-black/20">
                            <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/5">Date</th>
                            <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/4">Client</th>
                            <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/4">Motif de la visite</th>
                            <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal w-1/5">Personne rencontrée</th>
                            <th class="p-4 text-[#0d121b] dark:text:white text-sm font-medium leading-normal">Rapport</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($visites as $visite)
                            <tr class="border-t border-t-[#cfd7e7] dark:border-t-[#2a3140] hover:bg-[#f8f9fc] dark:hover:bg-black/20 transition-colors">
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">
                                    {{ optional($visite->arrivee_at)->format('Y-m-d H:i') }}
                                </td>
                                <td class="h-[72px] p-4 text-[#0d121b] dark:text:white text-sm font-normal leading-normal">
                                    {{ $visite->client?->nom }} {{ $visite->client?->prenom }}
                                    @if($visite->client?->entreprise)
                                        <span class="text-xs text-[#4c669a] dark:text-[#a0aec0]">({{ $visite->client->entreprise }})</span>
                                    @endif
                                </td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">
                                    {{ $visite->motif }}
                                </td>
                                <td class="h-[72px] p-4 text-[#4c669a] dark:text-[#a0aec0] text-sm font-normal leading-normal">
                                    {{ $visite->personne_rencontree }}
                                </td>
                                <td class="h-[72px] p-4 text-primary text-sm font-bold leading-normal tracking-[0.015em] cursor-pointer hover:underline">
                                    <a href="{{ route('visites.show', $visite) }}">Voir le rapport</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="h-[72px] p-4 text-center text-[#4c669a] dark:text-[#a0aec0] text-sm">
                                    Aucune visite trouvée avec les filtres actuels.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-center p-4 mt-4">
                {{ $visites->links() }}
            </div>
        </div>
    </main>
</div>
</body>
</html>
