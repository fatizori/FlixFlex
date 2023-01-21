<?php

namespace App\ViewModels;
use Carbon\Carbon;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Spatie\ViewModels\ViewModel;

class FavoriteMoviesViewModel extends ViewModel
{
    public $nowPlayingMovies;

    public function __construct($nowPlayingMovies)
    {
        $this->nowPlayingMovies = $nowPlayingMovies;
    }


    public function nowPlayingMovies()
    {
        return $this->paginate(collect($this->nowPlayingMovies)->map(function($movie) {

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] ,
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genre_find' => 1


            ])->only([
                'poster_path', 'id', 'title', 'vote_average', 'overview', 'release_date', 'genre_find'
            ]);
        }))->withPath('/favorites');


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
