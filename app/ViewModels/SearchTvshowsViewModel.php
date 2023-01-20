<?php

namespace App\ViewModels;

use Carbon\Carbon;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Spatie\ViewModels\ViewModel;

class SearchTvshowsViewModel extends ViewModel
{
    public $nowPlayingTvshows;
    public $genres;
    public $search_key;

    public function __construct($nowPlayingTvshows, $genres, $search_key)
    {
        $this->nowPlayingTvshows = $nowPlayingTvshows;
        $this->genres = $genres;
        $this->search_key = $search_key;
    }


    public function nowPlayingTvshows()
    {
        return $this->paginate(collect($this->nowPlayingTvshows)->map(function($tvshow) {

            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] ,
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        }))->withPath('/tvshows?search='.$this->search_key);


    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
