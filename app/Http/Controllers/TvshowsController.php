<?php

namespace App\Http\Controllers;

use App\ViewModels\TvshowsViewModel;
use App\ViewModels\TvshowViewModel;
use Illuminate\Http\Request;
use App\ViewModels\SearchTvshowsViewModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use Illuminate\Support\Facades\Http;

class TvshowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maxNumeroPage = 2 ; //The max number of pages you want to get from the api
        /**
         * Get a collection of all existed genres to use it when
         * showing tvs because in the tvs result the genres are numbers
         * and the corresponding values are in this collection
        */
        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')
        ->json()['genres'];

        if($request->filled('search')){
            $searchTvs = [];
            //Search Tvs section
            for ($i = 1; $i <= $maxNumeroPage; $i++) {
                $searchTvs = array_merge($searchTvs, Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/tv?query='.$request->search.'?&page='.$i)
                ->json()['results']);
            }

            $searchTvs= new  SearchTvshowsViewModel($searchTvs, $genres,$request->search );

            return view('tvshow.index', $searchTvs);

        }else {
            $nowPlayingTvshows=[];
            //Get NowPlayingTvs
            for ($i = 1; $i <= $maxNumeroPage; $i++) {
                $nowPlayingTvshows = array_merge($nowPlayingTvshows, Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/on_the_air?&page='.$i)
                ->json()['results']);
            }

            $viewModel = new TvshowsViewModel(
                $nowPlayingTvshows,
                $genres
            );

            return view('tvshow.index', $viewModel);
        }

        return view('tvshow.index',$viewModel);
    }



    /**
     * Show a Tv show by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get the favorite details if the Tv show is marked as favorite
        $favoriteItem = Favorite::findFavoriteById($id);

        //Get the Tv show details from TMDB API
        $tvshow = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,similar')
        ->json();

        if (Auth::check()) {
            if($favoriteItem->isEmpty()){
                //Use the viewModel to format movie data
                $viewModel = new TvshowViewModel($tvshow, 0);
            }else{
                //Use the viewModel to format movie data
                $viewModel = new TvshowViewModel($tvshow, 1);
            }
        }else{
            $viewModel = new TvshowViewModel($tvshow, 0);
        }


        return view('tvshow.detail', $viewModel);
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
        //
    }
}
