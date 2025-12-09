<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet"/>
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
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="flex min-h-screen items-center justify-center p-4">
    <div class="w-full max-w-md bg-white dark:bg-background-dark rounded-xl shadow-sm border border-slate-200/50 dark:border-slate-800/50 p-6 sm:p-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-center text-[#0d121b] dark:text-white mb-2">
            Créer un compte
        </h1>
        <p class="text-center text-sm text-slate-600 dark:text-slate-400 mb-6">
            Renseignez les informations pour accéder à l’application.
        </p>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 text-sm p-3 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
            @csrf

            <label class="flex flex-col">
                <span class="text-sm font-medium text-[#0d121b] dark:text-white mb-1">Nom complet</span>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="form-input rounded-lg border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-11 px-3 text-sm text-[#0d121b] dark:text-white"
                    placeholder="Votre nom et prénom"
                />
            </label>

            <label class="flex flex-col">
                <span class="text-sm font-medium text-[#0d121b] dark:text-white mb-1">Email</span>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="form-input rounded-lg border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-11 px-3 text-sm text-[#0d121b] dark:text-white"
                    placeholder="votre.email@exemple.com"
                />
            </label>

            <label class="flex flex-col">
                <span class="text-sm font-medium text-[#0d121b] dark:text-white mb-1">Mot de passe</span>
                <input
                    type="password"
                    name="password"
                    required
                    class="form-input rounded-lg border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-11 px-3 text-sm text-[#0d121b] dark:text-white"
                    placeholder="Au moins 8 caractères"
                />
            </label>

            <label class="flex flex-col">
                <span class="text-sm font-medium text-[#0d121b] dark:text-white mb-1">Confirmer le mot de passe</span>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="form-input rounded-lg border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-11 px-3 text-sm text-[#0d121b] dark:text-white"
                    placeholder="Répétez le mot de passe"
                />
            </label>

            <label class="flex flex-col">
                <span class="text-sm font-medium text-[#0d121b] dark:text-white mb-1">Rôle</span>
                <select
                    name="role"
                    class="form-select rounded-lg border border-slate-300 dark:border-slate-700 bg-background-light dark:bg-slate-800 h-11 px-3 text-sm text-[#0d121b] dark:text-white"
                    required
                >
                    <option value="">-- Sélectionner un rôle --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="receptionniste" {{ old('role') === 'receptionniste' ? 'selected' : '' }}>Réceptionniste</option>
                </select>
            </label>

            <button
                type="submit"
                class="mt-2 h-11 rounded-lg bg-primary text-white text-sm font-bold hover:bg-primary/90">
                Créer le compte
            </button>

            <div class="text-center text-sm text-slate-600 dark:text-slate-400 mt-2">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">
                    Se connecter
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

