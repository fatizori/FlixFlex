<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvshowViewModel extends ViewModel
{
    public $tvshow;
    public $favorite;

    public function __construct($tvshow, $favorite)
    {
        $this->tvshow = $tvshow;
        $this->favorite = $favorite;
    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->tvshow['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $this->tvshow['vote_average'] ,
            'tagline' => $this->tvshow['tagline'] ,
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'cast' => collect($this->tvshow['credits']['cast'])->take(7)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'crew' => collect($this->tvshow['credits']['crew'])->take(3),
            'similar' => collect($this->tvshow['similar']['results'])->take(7)->map(function($similar) {
                return collect($similar)->merge([
                    'poster_path' => $similar['poster_path']
                        ? 'https://image.tmdb.org/t/p/w500'.$similar['poster_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'production_countries' => collect($this->tvshow['production_countries'])->pluck('name')->flatten()->implode(', '),
            'favorite'=> $this->favorite

        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average','tagline', 'overview', 'first_air_date', 'credits' ,
            'videos', 'images','cast', 'crew', 'production_countries','created_by','number_of_episodes','number_of_seasons','similar','favorite'
        ]);
    }
}
