<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $this->movie['vote_average'] ,
            'tagline' => $this->movie['tagline'] ,
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'cast' => collect($this->movie['credits']['cast'])->take(7)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'crew' => collect($this->movie['credits']['crew'])->take(3),
            'production_countries' => collect($this->movie['production_countries'])->pluck('name')->flatten()->implode(', '),

        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average','tagline', 'overview', 'release_date', 'credits' ,
            'videos', 'images','cast', 'crew', 'production_countries'
        ]);
    }
}
