
<section  class=" py-10 px-12">
    <!-- Card Grid -->
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">

            <!-- Card Item -->
            <div
                class="my-8 rounded shadow-md shadow-zinc-500  bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
                <!-- Clickable Area -->
                <a _href="link" class="cursor-pointer">
                    <figure>
                        <!-- Image -->
                        <img
                    src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}"
                            class="rounded-t h-72 w-full object-cover" />

                        <figcaption class="p-4">
                            <!-- Title -->
                            <p
                                class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300"
                                x-text="post.title">
                                <!-- Post Title -->
                            </p>

                            <!-- Description -->
                            <small
                                class="leading-5 text-gray-500 dark:text-gray-400"
                                x-text="post.description">
                                <!-- Post Description -->
                            </small>
                        </figcaption>
                    </figure>
                </a>
            </div>


    </div>
</section>


