<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-f-black1 overflow-hidden">

                <section  class=" py-10 px-12">
                        <!-- Card Grid -->
                        <div
                            class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                                @foreach ($nowPlayingMovies as $movie)
                                    <x-movie-card :movie="$movie" />
                                @endforeach

                        </div>
                </section>
                <nav class="ml-4 text-center text-sm text-white ">
                {{ $nowPlayingMovies->links() }}
                </nav>
            </div>
        </div>
    </div>

</x-app-layout>
