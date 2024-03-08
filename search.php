<?php
require_once 'api.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Perform search for movies
    $moviesResult = $tmdbApi->searchMovies($searchQuery);
    // Perform search for TV shows
    $tvShowsResult = $tmdbApi->searchTvShow($searchQuery);

    // Filter movies and TV shows by genre ID and limit results to 10
    $filteredMovies = array_values(array_filter($moviesResult['results'], function($movie) {
        return in_array(16, $movie['genre_ids']);
    }));
    $filteredTVShows = array_values(array_filter($tvShowsResult['results'], function($tvShow) {
        return in_array(16, $tvShow['genre_ids']);
    }));

    // Extract required fields and limit results to 10
    $filteredMovies = array_map(function($movie) {
        return [
            'id' => $movie['id'],
            'title' => $movie['title'],
            'image' => 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
        ];
    }, array_slice($filteredMovies, 0, 10));

    $filteredTVShows = array_map(function($tvShow) {
        return [
            'id' => $tvShow['id'],
            'name' => $tvShow['name'],
            'image' => 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path']
        ];
    }, array_slice($filteredTVShows, 0, 10));

    $searchResults = [
        'movies' => $filteredMovies,
        'tv_shows' => $filteredTVShows
    ];

    // Output search results as JSON
    header('Content-Type: application/json');
    echo json_encode($searchResults);
    exit;
}


?>