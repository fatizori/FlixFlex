

# FLIXFLEX Web Application

FLIXFLEX is a web application for Movies and TV shows. It allows the user to show a list of 'now playing movies and seris' in different pages. The user can also get and show a movie/Tvshow details [Title, release date, description or overview, the genres, cast, crew and similar movies/TVs] and  add/remove it to the favorite list. 

# Application description and uses

- The user can create a new account and log in the application.

- The user enter to the home page (`/`) where he find the list of no playing movies. He can get the list of TVshows also by clicking `TV shows` on the navigation bar. 

- In order to show the movie/TV details, click the movie/TV card. Then, if you want to mark it as 'favorite', you must `Log in`. If you click the gray heart to mark a fovorite when you are not autheticated, you will be redirected to the login page. 

- To mark a movie/TV as favorite, just click the gray heart in the details page, if you want to remove it click to the red heart.

- The user can search for movies and TVs by writing the name in the search bar.


# Technologies
## Laravel 9
 The application is made with the PHP Framework `Laravel 9`.

### Why Laravel?
- Laravel is the best choice to carry out an agile development project, because it contains well-defined configuration conventions as well as mechanisms for testing;
- The documentation (written in a user-friendly and relevant way);
- A large community;
- CLI for more interaction with the Framework;

It also offers several features:
- an advanced routing system (RESTFul and resources);
- a powerful SQL query builder and ORM;
- an efficient Template engine;
- an authentication system for connections;
- a validation system;
- a paging system;
- a migration system for databases;
- a system for sending emails;
- a caching system;
- session management...

- For the front end side, we used laravel blade with livewire, HTML, Tailwind for styling, Jquery.

## MySQL Database
Since there are not many data and tables for this application, and that the only main tables that exist (Users, Favorites) are structured in relations, we thought of using the relational DBMS approach by choosing MySQL like DBMS.

### Why MySQL?
- Compatibility with LARAVEL, in particular with the PHP PDO API;
- Simple queries;
- Business data is structured;

## TMDB API
The TMDB API  (https://www.themoviedb.org/documentation/api) is used to get movies/TVs data.
#### The used queris:
- `https://api.themoviedb.org/3/movie/now_playing?api_key=<<apikey>>&language=en-US&page=1`
- `https://api.themoviedb.org/3/tv/on_the_air?api_key=<<api_key>>&language=en-US&page=1`
- `https://api.themoviedb.org/3/movie/{movie_id}?api_key=<<api_key>>&append_to_response=credits,videos,similar`
- `https://api.themoviedb.org/3/tv/{tv_id}?api_key=<<api_key>>&append_to_response=credits,videos,similar`
- `https://api.themoviedb.org/3/search/company?api_key=<<api_key>>&page=1`

# Architecture
We use the MVC architecture 
## ViewModel 
In order to make the controller and view a bit lighter, and since we don't have models for movies and TVs , we use a ViewModel which is a class where you can put some complex logic for your views.
- We use the `spatie/laravel-view-models`  package.

## DB architecture 
We have two main tables: users and favorites. 

#### Users table
- id : auto_increments,
- name: string,
- email: string,
- password: string;

#### favorites table
- id: auto_increments,
- movie_tv_id: integer,
- user_id: integer, [foreign_key]

#### Relations between the two tables
- A user has no or many favorites 
- A favorite belongs to a user
## project schema
Here are the main used folders and files:

#### app/Http/Controllers/
- FavoritesController.php
- MoviesController.php
- TvshoswController.php

#### app/Http/Models/
- Favorite.php
- User.php

#### app/Http/View/Components/
- AppLayout.php
- MovieCard.php
- TvshowCard.php

#### app/Http/ViewModels/
- FavoriteMoviesViewModel.php
- FavoriteTvshowsViewModel.php
- MoviesViewModel.php
- MovieViewModel.php
- SearchMoviesViewModel.php
- SearchTvshosViewModel.php
- TvshowsViewModel.php
- TvshowViewModel.php
#### database/migrations/
#### resources/views/
##### auth/
- login.blade.php
- register.blade.php     
##### components/
- movie-card.blade.php
- tvshow-card.blade.php
##### favorite/
- movies.blade.php
- tvs.blade.php
##### layouts/
- app.blade.php
##### movie/
- detail.blade.php
- index.blade.php
##### tvshow/
- detail.blade.php
- index.blade.php
         
- navigation-menu.blade.php

#### routes/
- api.php
- web.php
#### tests/
#### .env
#### tailwind.config.js


## Installation

1. Clone the repo and `cd` into it
2. `composer install`
3. Rename  `.env.example` file to `.env`
4. Set your `TMDB_TOKEN` in your `.env` file. You can get an API key [here](https://www.themoviedb.org/documentation/api). Make sure to use the "API Read Access Token (v4 auth)" from the TMDb dashboard. [My token is there so I think there is no problem]
5. `php artisan key:generate`
6. if you use 'sail' and docker run: `sail up -d`, then `npm run dev`
-  if not run `php artisan serve` then `npm run dev`

## Endpoints

### POST /login [sign in the application]
- data: email: string, password: string

### POST /register [Create an account]
- data: name: string, email: string, password: string
### GET / [Get the list of now playing movies]
- Response : a collection of arrays contain the movies informations {adult, genres, backdrop_path,id, overview, release_date, title, poster_path, popolarity, video,vote_average, vote_count}
### GET /movies/{movie} [Get the detail of a movie by id]
- parameter : movie: integer, which is the id of the given movie
- Response : array contain the movie informations {adult, genres, backdrop_path,id,release_date, overview, title, poster_path, popolarity, video,vote_average, vote_count, similar movies, crew and cast}

### GET /tvshows [Get the list of on air TV shows]
- Response : a collection of arrays contain the TV shows informations {adult, genres, backdrop_path,id, overview, first_on_air_date, name, poster_path, popolarity, video,vote_average, vote_count}
### GET /tvshows/{tvshow} [Get the detail of a TV show by id]
- parameter : tvshow: integer, which is the id of the given TV
- Response : array contain the TV show informations {adult, genres, backdrop_path,id, overview,first_on_air_date, name, poster_path, popolarity, video,vote_average, vote_count, similar tv shows, crew and cast}

### GET /favorites [Get the list of favorite Movies]
#### Authentication required
- Response : a collection of arrays contain the movies informations {adult, genres, backdrop_path,id, overview, release_date, title, poster_path, popolarity, video,vote_average, vote_count}
### GET /favorites/tvs [Get the list of favorite Movies TV shows]
#### Authentication required
- Response : collection of arrays contain the TV show informations {adult, genres, backdrop_path,id, overview,first_on_air_date, name, poster_path, popolarity, video,vote_average, vote_count, similar tv shows, crew and cast}

### POST /favorites/{item}/{type} [Mark a movie or a TV show as favorite]
#### Authentication required
- paramaters: item: integer [the movie/Tv id ], type: integer [types of item(movie or tv): 1 for movies, 2 for tvs]

### DELETE /favorites/{item} [Remove a movie or a TV show from the favorite list]
#### Authentication required
- paramaters: item: integer [the movie/Tv id ]

# .env file
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QBNSOsnrv0Zu5bGuaJLM6j/myBl6e07qP/eY3uC30F4=
APP_SERVICE=flix.flex
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=flix
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

MEMCACHED_HOST=memcached

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

TMDB_TOKEN=eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2NTcwNWRhNDgzODBjNGFhN2ZiMzkwYWU2Zjc3NzI2NyIsInN1YiI6IjYzYzZlZmU1YmJkMGIwMDBhNzNjZWQ4ZiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.lCA8O7gMmo1-E138BLvmOjkeP7codCqBWRonBBzVLrE
```
