<x-app-layout>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-f-black1 overflow-hidden">
                    <section class="text-white body-font overflow-hidden">
                        <div class="container px-2 py-8 ">
                            <div class="lg:w-full mx-auto flex flex-wrap">
                                <img alt="ecommerce" class="lg:w-1/4 w-full  object-center rounded " src="{{ $tvshow['poster_path'] }}">
                                <div class="lg:w-3/5 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                    <h2 class="text-lg text-white pb-2">"{{ $tvshow['tagline'] }}"</h2>
                                    <h1 class="text-[#D3A748] text-4xl title-font font-medium mb-1">{{ $tvshow['name'] }}</h1>
                                    <div class="flex mb-4">
                                        <span class="flex items-center">
                                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                            </svg>

                                            <span class="text-sm text-white ml-3">{{ $tvshow['vote_average'] }}</span>
                                            <span class="text-sm text-white ml-3">|</span>
                                            <span class="text-sm text-white ml-3">{{ $tvshow['first_air_date'] }}</span>

                                        </span>

                                    </div>
                                    <p class="text-sm text-white ">{{ $tvshow['genres'] }}</p>

                                    <p class="leading-relaxed pt-4">{{ $tvshow['overview'] }}</p>
                                    <p class="leading-relaxed text-md font-semibold pt-4">Production Countries: <span class="font-normal">{{ $tvshow['production_countries'] }}</span></p>


                                    <div class="pt-8">
                                        <p class="leading-relaxed font-semibold text-lg">Featured crew </p>
                                        <div class="flex mt-4">
                                                @foreach ($tvshow['crew'] as $crew)
                                                    <div class="mr-6">
                                                        <div>{{ $crew['name'] }}</div>
                                                        <div class="text-sm text-[#D3A748]">{{ $tvshow['job'] }}</div>
                                                    </div>

                                                @endforeach
                                        </div>

                                    </div>

                                    <div class="flex pt-10">

                                        <!--Trailer Modal -->

                                    <div x-data="{ isOpen: false }">
                                            @if (count($tvshow['videos']['results']) > 0)
                                                <div class="">
                                                    <button
                                                        @click="isOpen = true"
                                                        class="flex inline-flex items-center bg-[#D3A748] text-f-black1 rounded font-semibold px-5 py-2 hover:bg-yellow-700 transition ease-in-out duration-150"
                                                    >
                                                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                                        <span class="ml-2">Play Trailer</span>
                                                    </button>
                                                </div>

                                                <template x-if="isOpen">
                                                    <div
                                                        style="background-color: rgba(0, 0, 0, .5);"
                                                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                                    >
                                                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                                            <div class="bg-f-black2 rounded">
                                                                <div class="flex justify-end pr-4 pt-2">
                                                                    <button
                                                                        @click="isOpen = false"
                                                                        @keydown.escape.window="isOpen = false"
                                                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body px-8 py-8">
                                                                    <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                                        <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $tvshow['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            @endif


                                        </div>
                                        <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

            </div>
        </div>
    </div>
</x-app-layout>
