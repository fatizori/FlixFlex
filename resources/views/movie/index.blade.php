<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-f-black1 overflow-hidden">
                <form  method="GET">
                    <div class="flex justify-center">
                      <div class="mb-3 xl:w-96">
                        <input
                          type="search"
                          name="search"
                          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition  ease-in-out m-0
                                 focus:text-gray-700 focus:border-solid focus:border-2 focus:bg-white focus:ring-0 focus:border-[#D3A748] focus:outline-none"
                          id="search"
                          placeholder="Search Movies"
                        />
                      </div>
                    </div>
                </form>
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
