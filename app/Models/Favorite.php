<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_tv_id',
        'type'
    ];

     /**
     * Get the user that made the favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Find if a movie or tvshow is made as favorite by a user.
     */
    public static function findFavoriteById($id)
    {
        if (Auth::check()) {
            $favoriteItem = Favorite::where('movie_tv_id', $id)->where('user_id', auth()->user()->id)->get();
            return $favoriteItem;
        }

    }

}
