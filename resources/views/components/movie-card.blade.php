<!-- Card Item -->
<div class="my-8 rounded shadow-md shadow-zinc-500  bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">

    <a href="link" class="cursor-pointer">
        <figure>
            <!-- Image -->
            <a href="{{ route('movies.show', $movie['id']) }}">
                <img src="{{ $movie['poster_path'] }}"
                    class="rounded-t h-96 w-full " />
            </a>

            <figcaption class="p-4">
                <!-- Title -->
                <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mb-2 font-bold leading-relaxed text-gray-800 dark:text-gray-300">
                    {{ $movie['title'] }}
                </a>


                <p class="leading-5 text-sm text-gray-500 dark:text-gray-400">
                        {{ $movie['vote_average'] }} <span class="mx-2">|</span> {{ $movie['release_date'] }}
                </p>

                <p class="leading-5 text-sm text-gray-500 dark:text-gray-400">
                        {{ $movie['genres'] }}
                </p>
            </figcaption>
        </figure>
    </a>
</div>

