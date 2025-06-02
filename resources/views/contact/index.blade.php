<x-public-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
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
                        @if(isset($contactInfo['email']))
                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-slate-200 transition-colors">
                                <i class="fas fa-envelope text-lg text-slate-500 group-hover:text-slate-700 transition-colors"></i>
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

                        @if(isset($contactInfo['phone']))
                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-slate-200 transition-colors">
                                <i class="fas fa-phone-alt text-lg text-slate-500 group-hover:text-slate-700 transition-colors"></i>
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

                        @if(isset($contactInfo['location']))
                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-slate-200 transition-colors">
                                <i class="fas fa-map-marker-alt text-lg text-slate-500 group-hover:text-slate-700 transition-colors"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-slate-800 mb-0.5">Lokasi</h3>
                                <p class="text-sm text-slate-600">{{ $contactInfo['location'] }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>

                @if(isset($contactInfo['socials']) && count($contactInfo['socials']) > 0)
                <section>
                    <h2 class="text-2xl font-semibold text-slate-800 mb-6 border-b border-slate-200 pb-3">
                        Ikuti Saya
                    </h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($contactInfo['socials'] as $social)
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                           title="{{ $social['name'] }}"
                           class="group flex items-center justify-center w-12 h-12 bg-slate-100 rounded-lg hover:bg-slate-200 border border-transparent hover:border-slate-300 transition-all duration-300 transform hover:scale-110">
                            {{-- Social Media Icons --}}
                            @php $iconName = strtolower($social['name']); @endphp
                            @if($iconName === 'github')
                                <i class="fab fa-github text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @elseif($iconName === 'linkedin')
                                <i class="fab fa-linkedin-in text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @elseif($iconName === 'twitter')
                                <i class="fab fa-twitter text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @elseif($iconName === 'instagram')
                                <i class="fab fa-instagram text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @elseif($iconName === 'facebook')
                                <i class="fab fa-facebook-f text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @elseif($iconName === 'youtube')
                                <i class="fab fa-youtube text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @elseif($iconName === 'dribbble')
                                <i class="fab fa-dribbble text-xl text-slate-600 group-hover:text-slate-800 transition-colors"></i>
                            @else
                                <span class="text-sm font-semibold text-slate-600 group-hover:text-slate-800 transition-colors">
                                    {{ substr($social['name'], 0, 1) }}
                                </span>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            {{-- <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-6 sm:p-8">
                    <h2 class="text-2xl font-semibold text-slate-800 mb-6">Kirim Pesan</h2>

                    @if(session('success_contact_form'))
                        <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                <span>{{ session('success_contact_form') }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5"> 
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact_name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                                <input type="text"
                                       id="contact_name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="block w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors shadow-sm"
                                       placeholder="Nama Anda"
                                       required>
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                                <input type="email"
                                       id="contact_email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="block w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors shadow-sm"
                                       placeholder="anda@email.com"
                                       required>
                                @error('email')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="contact_subject" class="block text-sm font-medium text-slate-700 mb-1">Subjek</label>
                            <input type="text"
                                   id="contact_subject"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   class="block w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors shadow-sm"
                                   placeholder="Subjek pesan Anda">
                            @error('subject')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_message" class="block text-sm font-medium text-slate-700 mb-1">Pesan</label>
                            <textarea id="contact_message"
                                      name="message"
                                      rows="5"
                                      class="block w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors shadow-sm resize-y"
                                      placeholder="Tulis pesan Anda di sini..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-white transition-all duration-300">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</x-public-layout>