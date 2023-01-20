<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvshowViewModel extends ViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
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
            'crew' => collect($this->tvshow['credits']['crew'])->take(3),
            'production_countries' => collect($this->tvshow['production_countries'])->pluck('name')->flatten()->implode(', '),

        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average','tagline', 'overview', 'first_air_date', 'credits' ,
            'videos', 'images', 'crew', 'production_countries'
        ]);
    }
}
