<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ajouter un client</title>
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
    {{-- Sidebar --}}
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
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg:white/10" href="#">
                <span class="material-symbols-outlined">bar_chart</span>
                <p class="text-sm font-medium">Rapports</p>
            </a>
        </nav>

        <div class="flex flex-col gap-4">
            <a href="{{ route('clients.index') }}"
               class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-100 dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                <span class="truncate">Retour à la liste</span>
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
        <div class="w-full max-w-3xl mx-auto">
            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <div class="flex flex-col gap-1">
                    <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900 dark:text-white">
                        Ajouter un client
                    </h1>
                    <p class="text-base text-gray-500 dark:text-gray-400">
                        Enregistrer un nouveau client dans le système.
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="rounded-xl bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800 p-6">
                <form method="POST" action="{{ route('clients.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Nom
                        </label>
                        <input
                            type="text"
                            name="nom"
                            value="{{ old('nom') }}"
                            required
                            class="h-11 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 px-3 text-sm text-gray-900 dark:text-white"
                            placeholder="Ex : NDIAYE">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Prénom
                        </label>
                        <input
                            type="text"
                            name="prenom"
                            value="{{ old('prenom') }}"
                            required
                            class="h-11 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 px-3 text-sm text-gray-900 dark:text-white"
                            placeholder="Ex : Mamadou">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Téléphone
                        </label>
                        <input
                            type="text"
                            name="telephone"
                            value="{{ old('telephone') }}"
                            required
                            class="h-11 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 px-3 text-sm text-gray-900 dark:text:white"
                            placeholder="Ex : 77 123 45 67">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Email (optionnel)
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="h-11 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 px-3 text-sm text-gray-900 dark:text:white"
                            placeholder="Ex : client@example.com">
                    </div>

                    <div class="flex flex-col md:col-span-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                            Entreprise
                        </label>
                        <input
                            type="text"
                            name="entreprise"
                            value="{{ old('entreprise') }}"
                            required
                            class="h-11 rounded-lg border border-gray-300 dark:border-gray-700 bg-background-light dark:bg-gray-800 px-3 text-sm text-gray-900 dark:text:white"
                            placeholder="Ex : Kara Services">
                    </div>

                    <div class="md:col-span-2 flex justify-end mt-4">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center h-11 px-6 rounded-lg bg-primary text-white text-sm font-bold hover:bg-primary/90">
                            Enregistrer le client
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
</body>
</html>
