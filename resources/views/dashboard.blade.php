<!DOCTYPE html>
<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Tableau de Bord</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }

    .material-symbols-outlined.fill {
      font-variation-settings: 'FILL' 1;
    }
  </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="relative flex min-h-screen w-full">

<!-- SideNavBar -->
<aside class="flex flex-col w-64 p-4 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark text-gray-800 dark:text-gray-200 shrink-0">

    <div class="flex items-center gap-3 mb-8">
        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" 
        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBgavw87N5b5LhrSUYDy9ZaUIwrypQG-TlBTEtUv1Vqztmk0Lx1aQry5GmQcRCgKGVIYQxo6zNEfUF_NRPGG38ot5khYQNRj9-FhP41eFi2LjAQy-TBLGWmF0HpfS-HWz_4FFUwQXvuuscEBl5Lus6_2ETKsity1SgmIJ5IYe0EFwMZWUilPTNPeCBAY-1MVW8qOYUcW9AjbmEwzngC0u1CLfu0TykrHorXbuaAjBJgBJ-bxccwDYOmRiMEWcO5xSuxJSNCl2lDBA");'>
        </div>
        <div class="flex flex-col">
            <h1 class="text-base font-bold text-gray-900 dark:text-white">Kara SAMB</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gestionnaire</p>
        </div>
    </div>

    <nav class="flex flex-col gap-2 flex-grow">
        <!-- Dashboard -->
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary"
           href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined fill">dashboard</span>
            <p class="text-sm font-medium">Tableau de Bord</p>
        </a>

        <!-- Visites -->
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
           href="{{ route('visites.index') }}">
            <span class="material-symbols-outlined">calendar_month</span>
            <p class="text-sm font-medium">Visites</p>
        </a>

        <!-- Clients -->
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
           href="{{ route('clients.index') }}">
            <span class="material-symbols-outlined">groups</span>
            <p class="text-sm font-medium">Clients</p>
        </a>

        <!-- Rapports (non implémenté encore) -->
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10"
           href="#">
            <span class="material-symbols-outlined">bar_chart</span>
            <p class="text-sm font-medium">Rapports</p>
        </a>
    </nav>

    <div class="flex flex-col gap-4">

        <!-- Ajouter une visite -->
        <a href="{{ route('visites.create') }}"
           class="flex min-w-[84px] max-w-[480px] cursor-pointer 
           items-center justify-center overflow-hidden rounded-lg h-10 px-4 
           bg-primary text-white text-sm font-bold hover:bg-primary/90">
            <span class="truncate">Ajouter une visite</span>
        </a>

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center 
                justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-100 dark:bg-gray-800 
                text-sm font-medium text-gray-700 dark:text-gray-200 
                hover:bg-gray-200 dark:hover:bg-gray-700">
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-1 p-6 lg:p-8">
    <div class="w-full max-w-7xl mx-auto">

        <!-- Page Heading -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-black leading-tight tracking-tight text-gray-900 dark:text:white">
                    Tableau de Bord
                </h1>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                    Aperçu des visites clients et des tendances.
                </p>
            </div>

            <!-- Chips -->
            <div class="flex gap-2">
                <button class="flex h-9 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-white/10 
                pl-4 pr-3 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/20">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Aujourd'hui</p>
                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400" style="font-size: 20px;">expand_more</span>
                </button>

                <button class="flex h-9 items-center justify-center gap-x-2 rounded-lg bg-white dark:bg:white/10 
                pl-4 pr-3 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/20">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Cette semaine</p>
                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400" style="font-size: 20px;">expand_more</span>
                </button>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                <p class="text-base font-medium text-gray-600 dark:text-gray-400">Visiteurs Actuels</p>
                <p id="currentVisitors" class="text-3xl font-bold text-gray-900 dark:text:white">{{ $currentVisitors ?? 0 }}</p>
                <p id="currentVisitorsChange" class="text-base font-medium {{ isset($currentVisitorsChange) && $currentVisitorsChange < 0 ? 'text-red-600 dark:text-red-500' : 'text-green-600 dark:text-green-500' }}">
                    {{ isset($currentVisitorsChange) ? ( ($currentVisitorsChange > 0 ? '+' : '') . $currentVisitorsChange . '%' ) : '' }}
                </p>
            </div>

            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                <p class="text-base font-medium text-gray-600 dark:text-gray-400">Visites du Jour</p>
                <p id="visitsToday" class="text-3xl font-bold text-gray-900 dark:text:white">{{ $visitsToday ?? 0 }}</p>
                <p id="visitsTodayChange" class="text-base font-medium {{ isset($visitsTodayChange) && $visitsTodayChange < 0 ? 'text-red-600 dark:text-red-500' : 'text-red-600 dark:text-red-500' }}">
                    {{ isset($visitsTodayChange) ? ( ($visitsTodayChange > 0 ? '+' : '') . $visitsTodayChange . '%' ) : '' }}
                </p>
            </div>

            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                <p class="text-base font-medium text-gray-600 dark:text-gray-400">Visites de la Semaine</p>
                <p id="visitsWeek" class="text-3xl font-bold text-gray-900 dark:text:white">{{ $visitsWeek ?? 0 }}</p>
                <p id="visitsWeekChange" class="text-base font-medium {{ isset($visitsWeekChange) && $visitsWeekChange < 0 ? 'text-red-600 dark:text-red-500' : 'text-green-600 dark:text-green-500' }}">
                    {{ isset($visitsWeekChange) ? ( ($visitsWeekChange > 0 ? '+' : '') . $visitsWeekChange . '%' ) : '' }}
                </p>
            </div>

            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800">
                <p class="text-base font-medium text-gray-600 dark:text-gray-400">Taux de Conversion</p>
                <p id="conversionRate" class="text-3xl font-bold text-gray-900 dark:text:white">{{ isset($conversionRate) ? number_format($conversionRate, 1) . '%' : '0%' }}</p>
                <p id="conversionChange" class="text-base font-medium text-green-600 dark:text-green-500">
                    {{ isset($conversionChange) ? ( ($conversionChange > 0 ? '+' : '') . $conversionChange . '%' ) : '' }}
                </p>
            </div>
        </div>

        <!-- CHARTS (inchangés) -->
        <!-- Je laisse exactement ta version -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Graphique mensuel -->
            <div class="lg:col-span-2 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 
            p-6 bg-white dark:bg-background-dark">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-base font-bold text-gray-900 dark:text:white">Tendance des Visites Mensuelles</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">3 derniers mois</p>
                    </div>

                    <div class="flex gap-1 items-center">
                        <p id="monthlyTotal" class="text-4xl font-bold text-gray-900 dark:text:white">{{ $monthlyTotal ?? (is_array($monthlyVisits ?? null) ? array_sum($monthlyVisits) : 0) }}</p>
                        <p id="monthlyChange" class="text-base font-medium text-green-600 dark:text-green-500 mt-2">
                            {{ isset($monthlyChange) ? ( ($monthlyChange > 0 ? '+' : '') . $monthlyChange . '%' ) : '' }}
                        </p>
                    </div>
                </div>

                <div class="flex min-h-[250px] flex-1 flex-col gap-8 py-4">
                    <!-- SVG original -->
                    <svg class="h-full" fill="none" preserveAspectRatio="none" viewBox="-3 0 478 150" 
                    width="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="chartGradient" x1="236" x2="236" y1="1" y2="149" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#135bec" stop-opacity="0.2"></stop>
                                <stop offset="1" stop-color="#135bec" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                        <path
                            d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H0V109Z"
                            fill="url(#chartGradient)">
                        </path>
                        <path
                            d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25"
                            stroke="#135bec" stroke-linecap="round" stroke-width="3">
                        </path>
                    </svg>

                    <div id="monthLabels" class="flex justify-around text-gray-500 dark:text-gray-400 text-sm font-bold">
                        <!-- mois remplis dynamiquement -->
                    </div>
                </div>
            </div>

            <!-- Histogramme hebdomadaire -->
            <div class="lg:col-span-1 flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 
            p-6 bg-white dark:bg-background-dark">

                <p class="text-base font-bold text-gray-900 dark:text:white">Visites par Semaine</p>

                <div id="weeklyBars" class="grid min-h-[250px] grid-flow-col gap-4 grid-rows-[1fr_auto] 
                items-end justify-items-center px-3 pt-6">
                    <!-- barres remplis dynamiquement -->
                </div>
            </div>
        </div>
    </div>
</main>

</div>

<!-- Script dynamique pour remplir la page depuis les données du contrôleur -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    try {
        // valeurs initiales côté serveur (sécurisées)
        const initial = {
            monthlyVisits: {!! json_encode($monthlyVisits ?? [100,150,120,180,200,140]) !!},
            monthLabels:   {!! json_encode($monthLabels ?? ['Jan','Fév','Mar','Avr','Mai','Juin']) !!},
            weeklyVisits:  {!! json_encode($weeklyVisits ?? [80,40,50,20,60,90,100]) !!},

            currentVisitors: {!! json_encode($currentVisitors ?? 0) !!},
            currentVisitorsChange: {!! json_encode($currentVisitorsChange ?? 0) !!},

            visitsToday: {!! json_encode($visitsToday ?? 0) !!},
            visitsTodayChange: {!! json_encode($visitsTodayChange ?? 0) !!},

            visitsWeek: {!! json_encode($visitsWeek ?? 0) !!},
            visitsWeekChange: {!! json_encode($visitsWeekChange ?? 0) !!},

            conversionRate: {!! json_encode($conversionRate ?? 0) !!},
            conversionChange: {!! json_encode($conversionChange ?? 0) !!},

            monthlyChange: {!! json_encode($monthlyChange ?? 0) !!}
        };

        const statsUrl = '/dashboard/stats'; // créer un endpoint GET qui renvoie JSON (voir note plus bas)
        const pollIntervalMs = 15000; // 15s

        // helpers
        function setText(id, value){
            const el = document.getElementById(id);
            if(!el) return;
            el.innerText = (value === null || value === undefined) ? '' : String(value);
        }
        function setChangeClass(id, value){
            const el = document.getElementById(id);
            if(!el) return;
            el.classList.remove('text-green-600','dark:text-green-500','text-red-600','dark:text-red-500');
            if(Number(value) < 0){
                el.classList.add('text-red-600','dark:text-red-500');
            } else {
                el.classList.add('text-green-600','dark:text-green-500');
            }
        }

        function renderWeeklyBars(weeklyVisits){
            const container = document.getElementById('weeklyBars');
            if(!container) return;
            container.innerHTML = '';
            const arr = Array.isArray(weeklyVisits) ? weeklyVisits : [];
            const maxVal = Math.max(...(arr.length? arr.map(v=>Number(v)||0) : [1]), 1);
            arr.forEach((val, i) => {
                const percent = Math.round((Number(val)||0) / maxVal * 100);
                const bar = document.createElement('div');
                bar.className = 'bg-primary/20 dark:bg-primary/40 rounded-t w-full';
                bar.style.height = percent + '%';
                container.appendChild(bar);
            });
            // labels row
            const days = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];
            arr.forEach((val, i) => {
                const p = document.createElement('p');
                p.className = 'text-gray-500 dark:text-gray-400 text-sm font-bold';
                p.innerText = days[i] ?? ('J' + (i+1));
                container.appendChild(p);
            });
        }

        function renderMonthLabels(labels){
            const container = document.getElementById('monthLabels');
            if(!container) return;
            container.innerHTML = '';
            (labels || []).forEach(lbl => {
                const p = document.createElement('p');
                p.className = 'text-sm font-bold';
                p.innerText = lbl;
                container.appendChild(p);
            });
        }

        function updateFromData(data){
            if(!data) return;
            // stats
            setText('currentVisitors', data.currentVisitors ?? '');
            setText('currentVisitorsChange', (data.currentVisitorsChange>0?'+':'') + (data.currentVisitorsChange ?? 0) + '%');
            setChangeClass('currentVisitorsChange', data.currentVisitorsChange ?? 0);

            setText('visitsToday', data.visitsToday ?? '');
            setText('visitsTodayChange', (data.visitsTodayChange>0?'+':'') + (data.visitsTodayChange ?? 0) + '%');
            setChangeClass('visitsTodayChange', data.visitsTodayChange ?? 0);

            setText('visitsWeek', data.visitsWeek ?? '');
            setText('visitsWeekChange', (data.visitsWeekChange>0?'+':'') + (data.visitsWeekChange ?? 0) + '%');
            setChangeClass('visitsWeekChange', data.visitsWeekChange ?? 0);

            setText('conversionRate', (data.conversionRate !== undefined ? Number(data.conversionRate).toFixed(1) : 0) + '%');
            setText('conversionChange', (data.conversionChange>0?'+':'') + (data.conversionChange ?? 0) + '%');
            setChangeClass('conversionChange', data.conversionChange ?? 0);

            // monthly
            const monthlyArr = Array.isArray(data.monthlyVisits) ? data.monthlyVisits : [];
            const monthlyTotal = monthlyArr.reduce((a,b)=>a+(Number(b)||0),0);
            setText('monthlyTotal', monthlyTotal);
            setText('monthlyChange', (data.monthlyChange>0?'+':'') + (data.monthlyChange ?? 0) + '%');
            setChangeClass('monthlyChange', data.monthlyChange ?? 0);

            // charts labels & bars
            renderMonthLabels(data.monthLabels || []);
            renderWeeklyBars(data.weeklyVisits || []);
        }

        // rendu initial depuis le serveur
        updateFromData(initial);

        // polling (ne fait rien si endpoint indisponible)
        async function fetchAndUpdate(){
            try {
                const res = await fetch(statsUrl, { credentials: 'same-origin' });
                if(!res.ok) return;
                const json = await res.json();
                updateFromData(json);
            } catch (e) {
                // silent fail (utile en dev si endpoint non créé)
                // console.info('dashboard poll failed', e);
            }
        }

        // lancer un premier fetch asynchrone puis poller
        fetchAndUpdate();
        const pollId = setInterval(fetchAndUpdate, pollIntervalMs);

        // optional cleanup on unload
        window.addEventListener('beforeunload', () => clearInterval(pollId));

    } catch (err) {
        console.error('Erreur lors du rendu du tableau de bord :', err);
    }
});
</script>

</body>
</html>
