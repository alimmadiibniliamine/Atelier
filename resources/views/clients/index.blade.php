<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Gestion des clients</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:'FILL'0,'wght'400,'GRAD'0,'opsz'24;
        }
        .material-symbols-outlined.fill { font-variation-settings:'FILL'1; }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="relative flex min-h-screen w-full">
    {{-- Sidebar identique au dashboard, avec Clients en surbrillance --}}
    <aside class="flex flex-col w-64 p-4 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark text-gray-800 dark:text-gray-200 shrink-0">
        <div class="flex items-center gap-3 mb-8">
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                 style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBgavw87N5b5LhrSUYDy9ZaUIwrypQG-TlBTEtUv1Vqztmk0Lx1aQry5GmQcRCgKGVIYQxo6zNEfUF_NRPGG38ot5khYQNRj9-FhP41eFi2LjAQy-TBLGWmF0HpfS-HWz_4FFUwQXvuuscEBl5Lus6_2ETKsity1SgmIJ5IYe0EFwMZWUilPTNPeCBAY-1MVW8qOYUcW9AjbmEwzngC0u1CLfu0TykrHorXbuaAjBJgBJ-bxccwDYOmRiMEWcO5xSuxJSNCl2lDBA");'></div>
            <div class="flex flex-col">
                <h1 class="text-base font-bold text-gray-900 dark:text-white">Kara SAMB</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Gestionnaire</p>
            </div>
        </div>
        <nav class="flex flex-col gap-2 flex-grow">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
               href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <p class="text-sm font-medium">Tableau de Bord</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
               href="{{ route('visites.index') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <p class="text-sm font-medium">Visites</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary"
               href="{{ route('clients.index') }}">
                <span class="material-symbols-outlined fill">groups</span>
                <p class="text-sm font-medium">Clients</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10" href="#">
                <span class="material-symbols-outlined">bar_chart</span>
                <p class="text-sm font-medium">Rapports</p>
            </a>
        </nav>

        <div class="flex flex-col gap-4">
            <a href="{{ route('clients.create') }}"
               class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90">
                <span class="truncate">Ajouter un client</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-100 dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    {{-- Contenu principal --}}
    <main class="flex-1 p-6 lg:p-8">
        <div class="w-full max-w-6xl mx-auto">
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div class="flex flex-col gap-1">
                    <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900 dark:text-white">
                        Gestion des clients
                    </h1>
                    <p class="text-base text-gray-500 dark:text-gray-400">
                        Ajouter, modifier et rechercher les clients de l’entreprise.
                    </p>
                </div>

                <form method="GET" action="{{ route('clients.index') }}" class="flex items-center gap-2">
                    <input
                        type="text"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Rechercher (nom, entreprise, téléphone...)"
                        class="h-10 w-64 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 px-3 text-sm text-gray-900 dark:text-white">
                    <button
                        class="h-10 px-4 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary/90">
                        Rechercher
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-xl bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Nom</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Prénom</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Téléphone</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-600 dark:text-gray-300">Entreprise</th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($clients as $client)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/40">
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $client->nom }}</td>
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $client->prenom }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->telephone }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->email ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->entreprise }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('clients.edit', $client) }}"
                                   class="inline-flex items-center rounded-lg bg-primary text-white px-3 py-1 text-xs font-semibold hover:bg-primary/90 mr-2">
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('clients.destroy', $client) }}"
                                      class="inline-block"
                                      onsubmit="return confirm('Supprimer ce client ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-flex items-center rounded-lg bg-red-600 text-white px-3 py-1 text-xs font-semibold hover:bg-red-700">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                Aucun client enregistré pour le moment.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $clients->links() }}
            </div>

        </div>
    </main>
</div>
</body>
</html>
