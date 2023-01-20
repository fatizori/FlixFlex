<?php

namespace App\Http\Controllers;

use App\ViewModels\TvshowsViewModel;
use App\ViewModels\TvshowViewModel;
use Illuminate\Http\Request;
use App\ViewModels\SearchTvshowsViewModel;

use Illuminate\support\Facades\Http;

class TvshowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTvs = [];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')
        ->json()['genres'];

        if($request->filled('search')){

            $searchTvs = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/tv?query='.$request->search)
            ->json()['results'];

            $searchTvs= new  SearchTvshowsViewModel($searchTvs, $genres,$request->search );

            return view('tvshow.index', $searchTvs);

        }else {
            $nowPlayingTvshows = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/on_the_air?&page=4')
            ->json()['results'];

            $viewModel = new TvshowsViewModel(
                $nowPlayingTvshows,
                $genres
            );

            return view('tvshow.index', $viewModel);
        }





        return view('tvshow.index',$viewModel);
    }

    /**
     * Show the form for creating a new resource.
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
        $tvshow = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos')
        ->json();

        $viewModel = new TvshowViewModel($tvshow);

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
