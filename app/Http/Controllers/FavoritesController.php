<?php

namespace App\Http\Controllers;

use App\ViewModels\FavoriteMoviesViewModel;
use App\ViewModels\FavoriteTvshowsViewModel;
use App\ViewModels\SearchMoviesViewModel;
use App\ViewModels\SearchTvshowsViewModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Http;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function movies(Request $request)
    {
        $maxNumeroPage = 1 ;

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];

        if($request->filled('search')){ //search section

            $searchMovies = [];
            for ($i = 1; $i <= $maxNumeroPage; $i++) {
                $searchMovies = array_merge($searchMovies,Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$request->search.'?&page='.$i)
                ->json()['results']);
             }

            $searchMovies= new  SearchMoviesViewModel($searchMovies, $genres,$request->search );

            return view('movie.index', $searchMovies);

        }else { //favorite section
            $favoritesMovies = Favorite::where('user_id', auth()->user()->id)
                                ->where('type', 1)
                                ->get();


            $favList = [];
            foreach ($favoritesMovies as $favorite){

                $favList1 = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/'.$favorite['movie_tv_id'])
                ->json();
                array_push($favList, $favList1);
            }

            $viewModel = new FavoriteMoviesViewModel(
            $favList
            );
            return view('favorite.movies', $viewModel);
        }
        return view('favorite.movies', $viewModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tvshows(Request $request)
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
            $favoritesTvs = Favorite::where('user_id', auth()->user()->id)
                                ->where('type', 2)
                                ->get();


            $favList = [];
            foreach ($favoritesTvs as $favorite){

                $favList1 = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/'.$favorite['movie_tv_id'])
                ->json();
                array_push($favList, $favList1);
            }

            $viewModel = new FavoriteTvshowsViewModel(
            $favList
            );
            return view('favorite.tvs', $viewModel);
        }
        return view('favorite.tvs', $viewModel);
    }


    /**
     * Add a new favorite movie or tv show to the list of favorites
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, $type)
    {
        $favoriteItem = Favorite::findFavoriteById($id);
        if($favoriteItem->isEmpty()){
            $favorite = new Favorite();

            $favorite->movie_tv_id = $id;
            $favorite->type = $type;
            $favorite->user_id= auth()->user()->id;

            $favorite ->save();

        }
       // return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $result=Favorite::where('movie_tv_id',$id)->delete();
    }
}
