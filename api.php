<?php

class TmdbApi
{
    private $apiKey;
    private $apiBaseUrl = 'https://api.themoviedb.org/3';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
public function searchMovies($query)
{
    $url = $this->apiBaseUrl . '/search/movie?api_key=' . $this->apiKey . '&query=' . urlencode($query) . '&with_genres=16';
    $response = $this->makeRequest($url);

    return json_decode($response, true);
}

public function searchTvShow($query)
    {
        $url = $this->apiBaseUrl . '/search/tv?api_key=' . $this->apiKey . '&with_genres=16&query=' . urlencode($query);
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }
public function getMovieDetails($movieId)
    {
        $url = $this->apiBaseUrl . '/movie/' . $movieId . '?api_key=' . $this->apiKey .'&with_genres=16&with_original_language=ja';
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }
    
    public function getTVDetails($tvId)
    {
        $url = $this->apiBaseUrl . '/tv/' . $tvId . '?api_key=' . $this->apiKey .'&with_genres=16&with_original_language=ja';
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }

   public function getMovieCredits($movieId)
    {
        $url = $this->apiBaseUrl . '/movie/' . $movieId . '/credits?api_key=' . $this->apiKey;
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }
    
       public function getTVCredits($tvId)
    {
        $url = $this->apiBaseUrl . '/tv/' . $tvId . '/credits?api_key=' . $this->apiKey;
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }

    public function getMovieVideos($movieId)
    {
        $url = $this->apiBaseUrl . '/movie/' . $movieId . '/videos?api_key=' . $this->apiKey .'&with_genres=16&with_original_language=ja';
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }

public function getAnimeMovies($page = 1)
{
    $url = $this->apiBaseUrl . '/discover/movie?api_key=' . $this->apiKey . '&page=' . $page . '&with_genres=16&with_original_language=ja';
    $response = $this->makeRequest($url);

    return json_decode($response, true);
}

public function getNowPlayingMovies($page = 1)
{
    $min_date = date('Y-m-d');
    $max_date = date('Y-m-d', strtotime('+1 week'));

    $url = $this->apiBaseUrl . '/discover/movie?api_key=' . $this->apiKey . '&page=' . $page . '&with_genres=16&include_adult=false&include_video=false&language=en-US&with_original_language=ja&page=1&sort_by=popularity.desc&with_release_type=2|3&release_date.gte=' . $min_date . '&release_date.lte=' . $max_date;
    $response = $this->makeRequest($url);

    return json_decode($response, true);
}


public function getPopularAnimeMovies($page = 1)
{
    $url = $this->apiBaseUrl . '/discover/movie?api_key=' . $this->apiKey . '&page=' . $page . '&with_genres=16&sort_by=popularity.desc&&with_original_language=ja';
    $response = $this->makeRequest($url);

    return json_decode($response, true);
    echo $url;
}

    public function getLatestAnime($page = 1)
{
    $url = $this->apiBaseUrl . '/discover/tv?api_key=' . $this->apiKey . '&sort_by=first_air_date.gte.desc&with_genres=16&with_original_language=ja&language=en-US&with_keywords=237451&page=' . $page;
    $response = $this->makeRequest($url);

    return json_decode($response, true);
}


public function getLatestAnimeMovies($page = 1, $minDate = null, $maxDate = '2024-12-31') {
    $url = $this->apiBaseUrl . '/discover/movie?include_adult=false&include_video=false&language=en-US&with_original_language=ja&page=' . $page . '&sort_by=release_date.desc&with_release_type=2|3';

    if ($minDate !== null) {
        $url .= '&release_date.gte=' . $minDate;
    }

    if ($maxDate !== null) {
        $url .= '&release_date.lte=' . $maxDate;
    }

    $url .= '&with_genres=16';
    $url .= '&api_key=' . $this->apiKey;

    $response = $this->makeRequest($url);

    return json_decode($response, true);
}

public function getLatestAnimeTV($page = 1, $minDate = null, $maxDate = '2024-12-31') {
    $url = $this->apiBaseUrl . '/discover/tv?include_adult=false&include_video=false&language=en-US&with_original_language=ja&page=' . $page . '&sort_by=release_date.desc&with_release_type=2|3';

    if ($minDate !== null) {
        $url .= '&release_date.gte=' . $minDate;
    }

    if ($maxDate !== null) {
        $url .= '&release_date.lte=' . $maxDate;
    }

    $url .= '&with_genres=16';
    $url .= '&api_key=' . $this->apiKey;

    $response = $this->makeRequest($url);

    return json_decode($response, true);
}


 public function getTvShowSeason($tvShowId, $seasonNumber)
    {
        $url = $this->apiBaseUrl . '/tv/' . $tvShowId . '/season/' . $seasonNumber . '?api_key=' . $this->apiKey . '&with_genres=16&language=en-US&with_original_language=ja&';
        $response = $this->makeRequest($url);

        return json_decode($response, true);
    }
 public function getLatestTvShows($page = 1)
{
    // Get the current date in the format used by the API (assuming it's 'Y-m-d')
    $currentDate = date('Y-m-d');

    // Exclude animation genre (Genre ID 16) and TV shows without backdrop image
    // Also, filter shows that have already been released
    $url = $this->apiBaseUrl . '/discover/tv?api_key=' . $this->apiKey . '&sort_by=first_air_date.desc&with_genres=16&with_original_language=ja&with_backdrop=true&language=en-US&page=' . $page . '&air_date.lte=' . $currentDate;

    $response = $this->makeRequest($url);

    return json_decode($response, true);
}

    private function makeRequest($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

// Instantiate TmdbApi class with your API key
$apiKey = 'YOUR_API_KEY'; // Change with your TMDB API Key
$tmdbApi = new TmdbApi($apiKey);
?>
