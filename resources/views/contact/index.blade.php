<x-public-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-8">
        <header class="text-center mb-12 md:mb-16">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-slate-900">
                Hubungi Saya
            </h1>
            <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">
                Saya senang mendengar dari Anda! Baik itu pertanyaan, peluang kolaborasi, atau sekadar menyapa.
            </p>
        </header>

        <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
            <div class="md:col-span-1 space-y-10">
                <section>
                    <h2 class="text-2xl font-semibold text-slate-800 mb-6 border-b border-slate-200 pb-3">
                        Informasi Kontak
                    </h2>
                    <div class="space-y-6">
                        @if (isset($contactInfo['email']))
                            <div class="flex items-start gap-4 group">
                                <div
                                    class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-slate-200 transition-colors">
                                    <i
                                        class="fas fa-envelope text-lg text-slate-500 group-hover:text-slate-700 transition-colors"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-slate-800 mb-0.5">Email</h3>
                                    <a href="mailto:{{ $contactInfo['email'] }}"
                                        class="text-sm text-slate-600 hover:text-sky-600 hover:underline transition-colors duration-300">
                                        {{ $contactInfo['email'] }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if (isset($contactInfo['phone']))
                            <div class="flex items-start gap-4 group">
                                <div
                                    class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-slate-200 transition-colors">
                                    <i
                                        class="fas fa-phone-alt text-lg text-slate-500 group-hover:text-slate-700 transition-colors"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-slate-800 mb-0.5">Telepon</h3>
                                    <a href="tel:{{ $contactInfo['phone'] }}"
                                        class="text-sm text-slate-600 hover:text-sky-600 hover:underline transition-colors duration-300">
                                        {{ $contactInfo['phone'] }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if (isset($contactInfo['location']))
                            <div class="flex items-start gap-4 group">
                                <div
                                    class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-slate-200 transition-colors">
                                    <i
                                        class="fas fa-map-marker-alt text-lg text-slate-500 group-hover:text-slate-700 transition-colors"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-slate-800 mb-0.5">Lokasi</h3>
                                    <p class="text-sm text-slate-600">{{ $contactInfo['location'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                @if (isset($contactInfo['socials']) && count($contactInfo['socials']) > 0)
                    <section>
                        <h2 class="text-2xl font-semibold text-slate-800 mb-6 border-b border-slate-200 pb-3">
                            Ikuti Saya
                        </h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($contactInfo['socials'] as $social)
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                    title="{{ $social['name'] }}"
                                    class="group flex items-center justify-center w-12 h-12 bg-slate-100 rounded-lg hover:bg-slate-200 border border-transparent hover:border-slate-300 transition-all duration-300 transform hover:scale-110">
                                    {{-- Social Media Icons --}}
                                    @php $iconName = strtolower($social['name']); @endphp
                                    @if ($iconName === 'github')
                                        <i
                                            class="fab fa-github text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @elseif($iconName === 'linkedin')
                                        <i
                                            class="fab fa-linkedin-in text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @elseif($iconName === 'twitter')
                                        <i
                                            class="fab fa-twitter text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @elseif($iconName === 'instagram')
                                        <i
                                            class="fab fa-instagram text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @elseif($iconName === 'facebook')
                                        <i
                                            class="fab fa-facebook-f text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @elseif($iconName === 'youtube')
                                        <i
                                            class="fab fa-youtube text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @elseif($iconName === 'dribbble')
                                        <i
                                            class="fab fa-dribbble text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                                    @else
                                        <span
                                            class="text-sm font-semibold text-slate-600 group-hover:text-slate-800 transition-colors">
                                            {{ substr($social['name'], 0, 1) }}
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>
