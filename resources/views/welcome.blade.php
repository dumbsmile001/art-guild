<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Art Guild') }} — share your art, find your people</title>

        <!-- Google Fonts: casual, friendly vibes -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind + Vite -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <!-- custom extra layer (tiny overrides) -->
        <style>
            /* smooth scroll and a bit of organic touch */
            html {
                scroll-behavior: smooth;
            }
            body {
                font-family: 'Lexend', sans-serif;
            }
            .font-display {
                font-family: 'DM Sans', sans-serif;
            }
            /* subtle grain texture (casual grit) */
            .grain::before {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.035'/%3E%3C/svg%3E");
                pointer-events: none;
                z-index: 999;
                opacity: 0.4;
            }
            /* custom messy underline for links */
            .messy-underline {
                position: relative;
            }
            .messy-underline::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: currentColor;
                transition: width 0.2s ease;
            }
            .messy-underline:hover::after {
                width: 100%;
            }
            @keyframes float {
                0% { transform: translateY(0px) rotate(0deg); }
                100% { transform: translateY(-8px) rotate(1deg); }
            }
            .float-hover:hover {
                animation: float 0.25s ease-in-out forwards;
            }
        </style>
    </head>
    <body class="bg-gradient-to-br from-purple-50 via-white to-purple-50 text-gray-800 antialiased grain">

        <!-- ========== HEADER (casual & minimal) ========== -->
        <header class="sticky top-0 z-30 bg-white/70 backdrop-blur-md border-b border-purple-100/60">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 py-4 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl rotate-3 group-hover:rotate-6 transition-transform"></div>
                    <span class="font-display font-bold text-xl tracking-tight text-gray-800">art<span class="text-purple-600">guild</span></span>
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-3 sm:gap-5">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-purple-700 bg-purple-50 px-4 py-2 rounded-full hover:bg-purple-100 transition">dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-purple-600 transition px-3 py-2">sign in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium bg-purple-600 text-white px-5 py-2 rounded-full shadow-sm shadow-purple-200 hover:bg-purple-700 hover:scale-105 transition-transform">join free →</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- ========== HERO (playful, purple-drenched) ========== -->
        <main>
            <section class="relative overflow-hidden pt-12 pb-20 md:pt-20 md:pb-28">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-purple-200/40 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-fuchsia-200/30 rounded-full blur-2xl"></div>

                <div class="max-w-7xl mx-auto px-5 sm:px-8 relative z-2">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <!-- left copy -->
                        <div class="space-y-6">
                            <div class="inline-flex items-center gap-2 bg-purple-100/80 rounded-full px-4 py-1.5 text-purple-700 text-sm font-medium">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-600"></span>
                                </span>
                                <span>creative community, zero ego</span>
                            </div>
                            <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.1] text-gray-900">
                                share art,<br>
                                find <span class="bg-gradient-to-r from-purple-600 to-fuchsia-600 bg-clip-text text-transparent">your weird tribe.</span>
                            </h1>
                            <p class="text-lg text-gray-600 max-w-md leading-relaxed">
                                Art Guild is the cozy corner of the internet where creators post sketches, get real feedback, and hype each other up. no gatekeeping, just good vibes.
                            </p>
                            <div class="flex flex-wrap gap-4 pt-2">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-purple-600 text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-purple-700 hover:shadow-purple-200 transition-all hover:-translate-y-0.5">
                                        start posting ✨
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                @endif
                                <a href="#features" class="inline-flex items-center gap-1 text-gray-700 font-medium px-5 py-3 rounded-full hover:bg-gray-100 transition">
                                    see how it works 
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </a>
                            </div>
                            <div class="flex items-center gap-6 pt-4 text-sm text-gray-500">
                                <div class="flex -space-x-2">
                                    <div class="w-7 h-7 rounded-full bg-purple-300 border-2 border-white"></div>
                                    <div class="w-7 h-7 rounded-full bg-fuchsia-300 border-2 border-white"></div>
                                    <div class="w-7 h-7 rounded-full bg-indigo-300 border-2 border-white"></div>
                                    <div class="w-7 h-7 rounded-full bg-purple-400 border-2 border-white flex items-center justify-center text-[10px] font-bold text-white">+2k</div>
                                </div>
                                <span>joined by 2,000+ artists this month</span>
                            </div>
                        </div>

                        <!-- right: chill art grid / doodle cards -->
                        <div class="relative">
                            <div class="grid grid-cols-2 gap-4 auto-rows-min">
                                <div class="bg-gradient-to-br from-purple-200 to-purple-300 rounded-3xl p-6 shadow-md rotate-1 hover:rotate-0 transition-transform duration-300">
                                    <div class="text-5xl mb-3">🎨</div>
                                    <p class="font-medium text-purple-900">"finally a place where my messy sketches are welcome"</p>
                                    <p class="text-xs text-purple-700 mt-2">— mara, painter</p>
                                </div>
                                <div class="bg-white rounded-2xl p-5 shadow-md border border-purple-100 -rotate-2 hover:rotate-0 transition-transform duration-300 mt-6">
                                    <div class="flex gap-1 mb-2">
                                        <span class="w-2 h-2 bg-purple-400 rounded-full"></span>
                                        <span class="w-2 h-2 bg-purple-400 rounded-full"></span>
                                        <span class="w-2 h-2 bg-purple-400 rounded-full"></span>
                                    </div>
                                    <div class="h-20 w-full bg-purple-100 rounded-xl mb-2 flex items-center justify-center text-3xl">🖌️</div>
                                    <p class="text-xs font-medium text-gray-600">daily doodle feed</p>
                                </div>
                                <div class="col-span-2 bg-gradient-to-r from-purple-100 to-fuchsia-100 rounded-2xl p-4 flex items-center gap-3 shadow-sm">
                                    <div class="text-3xl">✨</div>
                                    <div>
                                        <p class="font-semibold text-purple-800">no algorithms, just humans</p>
                                        <p class="text-xs text-gray-600">your art gets seen by real people who actually care</p>
                                    </div>
                                </div>
                                <div class="bg-indigo-50 rounded-2xl p-4 text-center shadow-sm">
                                    <span class="text-2xl">🎭</span>
                                    <p class="text-xs font-medium text-indigo-800">collab circles</p>
                                </div>
                                <div class="bg-purple-50 rounded-2xl p-4 text-center shadow-sm -rotate-1">
                                    <span class="text-2xl">💬</span>
                                    <p class="text-xs font-medium text-purple-800">kind critiques only</p>
                                </div>
                            </div>
                            <!-- floating blob -->
                            <div class="absolute -z-10 -bottom-8 -right-8 w-48 h-48 bg-purple-200/50 rounded-full blur-2xl"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========== FEATURE SECTION (purple dark twist) ========== -->
            <section id="features" class="py-20 bg-purple-950 text-white relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%234c1d95" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                <div class="max-w-7xl mx-auto px-5 sm:px-8 relative z-2">
                    <div class="text-center max-w-2xl mx-auto mb-16">
                        <span class="text-purple-300 text-sm uppercase tracking-wide font-semibold bg-purple-800/40 px-3 py-1 rounded-full">why art guild?</span>
                        <h2 class="font-display text-4xl md:text-5xl font-bold mt-4 tracking-tight">built for <span class="text-purple-300">real artists</span>, not influencers</h2>
                        <p class="text-purple-200/70 text-lg mt-4">No clout chasing, no engagement bait — just a warm place to grow.</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="bg-purple-900/60 backdrop-blur-sm rounded-3xl p-7 border border-purple-800 hover:bg-purple-900/80 transition group">
                            <div class="w-12 h-12 rounded-2xl bg-purple-700 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">🎨</div>
                            <h3 class="text-xl font-bold mb-2">portfolio feed</h3>
                            <p class="text-purple-200/80 text-sm leading-relaxed">post sketches, wips, finished pieces. your profile is a living sketchbook, not a sterile gallery.</p>
                        </div>
                        <div class="bg-purple-900/60 backdrop-blur-sm rounded-3xl p-7 border border-purple-800 hover:bg-purple-900/80 transition group">
                            <div class="w-12 h-12 rounded-2xl bg-purple-700 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">👥</div>
                            <h3 class="text-xl font-bold mb-2">guild circles</h3>
                            <p class="text-purple-200/80 text-sm leading-relaxed">create or join small groups (watercolor, pixel art, ocs, etc). share works-in-progress and give <span class="italic">kind</span> feedback.</p>
                        </div>
                        <div class="bg-purple-900/60 backdrop-blur-sm rounded-3xl p-7 border border-purple-800 hover:bg-purple-900/80 transition group">
                            <div class="w-12 h-12 rounded-2xl bg-purple-700 flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition">🪄</div>
                            <h3 class="text-xl font-bold mb-2">discovery, human-curated</h3>
                            <p class="text-purple-200/80 text-sm leading-relaxed">real people (yes, humans) spotlight hidden gems every week. no starving artist vibes.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========== TESTIMONIAL / CHILL QUOTE SECTION ========== -->
            <section class="py-20 bg-white">
                <div class="max-w-5xl mx-auto px-5 text-center">
                    <div class="inline-flex items-center gap-1 bg-gray-100 rounded-full px-4 py-1.5 text-sm text-gray-600 mb-8">
                        <span>💜</span> from the community
                    </div>
                    <figure>
                        <p class="text-2xl md:text-3xl font-medium text-gray-800 leading-relaxed max-w-3xl mx-auto">
                            “i used to feel weird sharing my sketchy doodles online. but Art Guild feels like a cozy studio where everyone actually <span class="text-purple-600">gets it</span>.”
                        </p>
                        <figcaption class="mt-6">
                            <p class="font-semibold text-gray-900">— Casey L., digital artist</p>
                            <p class="text-sm text-gray-500">joined 2 months ago, posted 30+ pieces</p>
                        </figcaption>
                    </figure>
                    <div class="flex justify-center gap-1 mt-10">
                                        </div>
                </div>
            </section>

            <!-- ========== CTA (vibrant purple gradient) ========== -->
            @if (Route::has('register'))
            <section class="py-16 my-8 mx-5 sm:mx-8 rounded-4xl bg-gradient-to-br from-purple-600 to-purple-800 shadow-xl">
                <div class="max-w-4xl mx-auto text-center px-5">
                    <h2 class="font-display text-3xl md:text-5xl font-bold text-white">drop your art here 🧃</h2>
                    <p class="text-purple-100 text-lg mt-3 max-w-lg mx-auto">no application, no pressure. create your profile in 30 seconds.</p>
                    <div class="mt-8">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white text-purple-700 font-bold px-8 py-3 rounded-full shadow-lg hover:scale-105 transition-transform">
                            join the guild — free forever
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-purple-200 text-xs mt-5">✨ no credit card • just art & weird friends ✨</p>
                </div>
            </section>
            @endif

            <!-- ========== FOOTER (simple & cute) ========== -->
            <footer class="border-t border-purple-100 bg-white/80 py-10 mt-8">
                <div class="max-w-7xl mx-auto px-5 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-purple-600 rounded-md rotate-6"></div>
                        <span class="font-display font-bold text-gray-700 text-sm">art<span class="text-purple-600">guild</span></span>
                        <span class="text-gray-400 text-xs ml-2">a safe place for messy art</span>
                    </div>
                    <div class="flex gap-6 text-xs text-gray-500">
                        <a href="#" class="hover:text-purple-600 transition">code of kindness</a>
                        <a href="#" class="hover:text-purple-600 transition">@artguild</a>
                        <span>© {{ date('Y') }} All Rights Reserved</span>
                    </div>
                </div>
            </footer>
        </main>
    </body>
</html>