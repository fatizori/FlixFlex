<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use App\ViewModels\SearchMoviesViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maxNumeroPage = 1 ;

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];
        dump($genres);

        if($request->filled('search')){

            $searchMovies = [];
            for ($i = 1; $i <= $maxNumeroPage; $i++) {
                $searchMovies = array_merge($searchMovies,Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$request->search.'?&page='.$i)
                ->json()['results']);
             }

            $searchMovies= new  SearchMoviesViewModel($searchMovies, $genres,$request->search );

            return view('movie.index', $searchMovies);

        }else {

            $nowPlayingMovies = [];

            for ($i = 1; $i <= $maxNumeroPage; $i++) {
                $nowPlayingMovies = array_merge($nowPlayingMovies, Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/now_playing?&page='.$i)
                ->json()['results']);
                dump($nowPlayingMovies);
            }


            $viewModel = new MoviesViewModel(
                $nowPlayingMovies,
                $genres
            );

            return view('movie.index', $viewModel);
        }

        return view('movie.index', $viewModel);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get the favorite details if the movie is marked as favorite
        $favoriteItem = Favorite::findFavoriteById($id);

        //Get the Movie details from TMDB API
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,similar')
            ->json();

        if (Auth::check()) {
            if($favoriteItem->isEmpty()){
                //Use the viewModel to format movie data
                $viewModel = new MovieViewModel($movie, 0);
            }else{
                //Use the viewModel to format movie data
                $viewModel = new MovieViewModel($movie, 1);
            }
        }else{
            $viewModel = new MovieViewModel($movie, 0);
        }


        return view('movie.detail', $viewModel);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
