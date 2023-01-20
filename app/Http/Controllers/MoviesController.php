<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use App\ViewModels\SearchMoviesViewModel;

use Illuminate\Http\Request;
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
        $searchMovies = [];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];

        if($request->filled('search')){

            $searchMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$request->search)
            ->json()['results'];

            $searchMovies= new  SearchMoviesViewModel($searchMovies, $genres,$request->search );

            return view('movie.index', $searchMovies);

        }else {
            $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?&page=3')
            ->json()['results'];

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
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos')
            ->json();

        $viewModel = new MovieViewModel($movie);

        return view('movie.detail', $viewModel);
    }

    /**
     * Search for movies
     *
     * @param  int  $search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $results = [];

            $results = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$request->search)
            ->json()['results'];


         dump($results);
         $viewModel = new  SearchMoviesViewModel($results);

         return view('movie.index', $viewModel);
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
