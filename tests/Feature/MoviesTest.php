<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function movies_list_is_correct()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Adventure, Drama, Mystery, Science Fiction, Thriller');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    //Some fake data
    private function fakeNowPlayingMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "adult" => false,
                        "backdrop_path" => "/r9PkFnRUIthgBp2JZZzD380MWZy.jpg",
                        "genre_ids" => [
                            0 => 16,
                            1 => 28,
                            2 => 12,
                            3 => 35,
                            4 => 10751,
                            5 => 14,
                        ],
                        "id" => 315162,
                        "original_language" => "en",
                        "original_title" => "Puss in Boots: The Last Wish",
                        "overview" => "Puss in Boots discovers that his passion for adventure has taken its toll: He has burned through eight of his nine lives, leaving him with only one life left.",
                        "popularity" => 8303.733,
                        "poster_path" => "/kuf6dutpsT0vSVehic3EZIqkOBt.jpg",
                        "release_date" => "2022-12-07",
                        "title" => "Puss in Boots: The Last Wish",
                        "video" => false,
                        "vote_average" => 8.6,
                        "vote_count" => 2163,
                    ]
                ]
            ], 200);
    }

    public function fakeGenres()
    {
        return Http::response([
                'genres' => [
                    [
                      "id" => 28,
                      "name" => "Action"
                    ],
                    [
                      "id" => 12,
                      "name" => "Adventure"
                    ],
                    [
                      "id" => 16,
                      "name" => "Animation"
                    ],
                    [
                      "id" => 35,
                      "name" => "Comedy"
                    ],
                    [
                      "id" => 80,
                      "name" => "Crime"
                    ],
                    [
                      "id" => 99,
                      "name" => "Documentary"
                    ],
                    [
                      "id" => 18,
                      "name" => "Drama"
                    ],

                ]
            ], 200);
    }

    public function fakeSingleMovie()
    {
        return Http::response([
                "adult" => false,
                "backdrop_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                "genres" => [
                    ["id" => 28, "name" => "Action"],
                    ["id" => 12, "name" => "Adventure"],
                    ["id" => 35, "name" => "Comedy"],
                    ["id" => 14, "name" => "Fantasy"],
                ],
                "homepage" => "http://jumanjimovie.com",
                "id" => 12345,
                "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
                "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
                "release_date" => "2019-12-04",
                "runtime" => 123,
                "title" => "Fake Jumanji: The Next Level",
                "vote_average" => 6.8,
                "credits" => [
                    "cast" => [
                        [
                            "cast_id" => 2,
                            "character" => "Dr. Smolder Bravestone",
                            "credit_id" => "5aac3960c3a36846ea005147",
                            "gender" => 2,
                            "id" => 18918,
                            "name" => "Dwayne Johnson",
                            "order" => 0,
                            "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                        ]
                    ],
                    "crew" => [
                        [
                            "credit_id" => "5d51d4ff18b75100174608d8",
                            "department" => "Production",
                            "gender" => 1,
                            "id" => 546,
                            "job" => "Casting Director",
                            "name" => "Jeanne McCarthy",
                            "profile_path" => null,
                        ]
                    ]
                ],
                "videos" => [
                    "results" => [
                        [
                            "id" => "5d1a1a9b30aa3163c6c5fe57",
                            "iso_639_1" => "en",
                            "iso_3166_1" => "US",
                            "key" => "rBxcF-r9Ibs",
                            "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                            "site" => "YouTube",
                            "size" => 1080,
                            "type" => "Trailer",
                        ]
                    ]
                ],

            ], 200);
    }
}
