<?php

namespace App\ViewModels;

use Carbon\Carbon;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Spatie\ViewModels\ViewModel;

class FavoriteTvshowsViewModel extends ViewModel
{
    public $nowPlayingTvshows;

    public function __construct($nowPlayingTvshows)
    {
        $this->nowPlayingTvshows = $nowPlayingTvshows;
    }


    public function nowPlayingTvshows()
    {
        return $this->paginate(collect($this->nowPlayingTvshows)->map(function($tvshow) {

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] ,
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genre_find' => 1

            ])->only([
                'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres', 'genre_find'
            ]);
        }))->withPath('/favorites/tvs');


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
