<x-app-layout>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-f-black1 overflow-hidden">
                    <section class="text-white body-font overflow-hidden">
                        <div class="container px-2 py-8 ">
                            <div class="lg:w-full mx-auto flex flex-wrap">
                                <img alt="ecommerce" class="lg:w-1/4 w-full  object-center rounded " src="{{ $movie['poster_path'] }}">
                                <div class="lg:w-3/5 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                    <h2 class="text-lg text-white pb-2">"{{ $movie['tagline'] }}"</h2>
                                    <h1 class="text-[#D3A748] text-4xl title-font font-medium mb-1">{{ $movie['title'] }}</h1>
                                    <div class="flex mb-4">
                                        <span class="flex items-center">
                                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                            </svg>

                                            <span class="text-sm text-white ml-3">{{ $movie['vote_average'] }}</span>
                                            <span class="text-sm text-white ml-3">|</span>
                                            <span class="text-sm text-white ml-3">{{ $movie['release_date'] }}</span>

                                        </span>

                                    </div>
                                    <p class="text-sm text-white ">{{ $movie['genres'] }}</p>

                                    <p class="leading-relaxed pt-4">{{ $movie['overview'] }}</p>
                                    <p class="leading-relaxed text-md font-semibold pt-4">Production Countries: <span class="font-normal">{{ $movie['production_countries'] }}</span></p>


                                    <div class="pt-8">
                                        <p class="leading-relaxed font-semibold text-lg">Featured crew </p>
                                        <div class="flex mt-4">
                                                @foreach ($movie['crew'] as $crew)
                                                    <div class="mr-6">
                                                        <div>{{ $crew['name'] }}</div>
                                                        <div class="text-sm text-[#D3A748]">{{ $crew['job'] }}</div>
                                                    </div>

                                                @endforeach
                                        </div>

                                    </div>

                                    <div class="flex pt-10">

                                        <!--Trailer Modal -->

                                    <div x-data="{ isOpen: false }">
                                            @if (count($movie['videos']['results']) > 0)
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
                                                                        <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            @else
                                                <div class="">
                                                    <button
                                                        class="flex inline-flex items-center bg-gray-300 text-f-black1 rounded font-semibold px-5 py-2 hover:bg-gray-600 transition ease-in-out duration-150 cursor-not-allowed disabled:opacity-50"
                                                        disabled
                                                    >
                                                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                                        <span class="ml-2">No Trailer</span>
                                                    </button>
                                                </div>
                                            @endif


                                        </div>
                                        <!--If the user is authenticated he can make a favorite, if no he will be redirected to the login page-->
                                            @auth
                                            <!-- favorite form for auth -->
                                                <form action="" id="makefav" method="POST">
                                                    <input type="hidden" value="{{$movie['favorite']}}" class="favboolean" />
                                                    @csrf
                                                    <button  id="likem"
                                                        class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                                        <svg @if($movie['favorite']  == 0) fill="gray" @else fill="red" @endif id="like" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endauth
                                            @guest
                                            <!-- favorite form for guest -->

                                                   <a  href="{{route('login')}}"
                                                       class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                                       <svg fill="gray"  id="like" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                           <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                                       </svg>
                                                   </a>

                                           @endguest

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Cast -->
                        <div >
                            <div class=" mx-auto px-4 py-4">
                                <h2 class="text-3xl font-semibold">Cast</h2>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 gap-4">
                                    @foreach ($movie['cast'] as $cast)
                                        <div class="mt-6">

                                                <img src="{{ $cast['profile_path'] }}" alt="actor" class=" w-3/4 hover:opacity-75 hover:-translate-y-1 transition ease-in-out duration-150">

                                            <div class="mt-2">
                                                <p  class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</p>
                                                <div class="text-sm text-gray-400">
                                                    {{ $cast['character'] }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- end cast -->

                        <!--Similar movies -->
                        <div >
                                <div class=" mx-auto px-4 py-4">
                                    <h2 class="text-3xl font-semibold">Similar Movies</h2>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-7 gap-4">
                                        @foreach ($movie['similar'] as $similar)
                                            <div class="mt-6">
                                                <a href="{{ route('movies.show', $similar['id']) }}">
                                                    <img src="{{$similar['poster_path'] }}" alt="movie poster" class=" w-3/4 hover:opacity-75 hover:-translate-y-1 transition ease-in-out duration-150">
                                                </a>
                                                <div class="mt-2">
                                                    <p  class="text-lg mt-2 hover:text-gray:300">{{ $similar['title'] }}</p>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div> <!-- end similar movies -->
                    </section>

            </div>
        </div>
    </div>
    <script type="text/javascript">

        var isfavorite = $(".favboolean").val();

            //Make a movie as favorite
            $("#likem").click(function(){
                if(isfavorite == 0){
                    $("#makefav").on("submit", function (e) {
                        $("#like").css({ fill: 'red' });
                        var dataString = $(this).serialize();
                        $.ajax({
                            type: "POST",
                            url: "{{route('favorites.store', [ $movie['id'], 1])}}",
                            data: dataString,
                            success: function () {
                                isfavorite = 1;
                            }
                        });
                        e.preventDefault();
                    });
                }else{

                    $("#makefav").on("submit", function (e) {
                        $("#like").css({ fill: 'gray' });
                        var dataString = $(this).serialize();
                        $.ajax({
                            type: "DELETE",
                            url: "{{route('favorites.delete', [ $movie['id']])}}",
                            data: dataString,
                            success: function () {
                                isfavorite = 0;
                            }
                        });
                        e.preventDefault();
                    });


                }
            });



    </script>

</x-app-layout>
