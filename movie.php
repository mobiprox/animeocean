<?php 
require_once 'api.php';


// Define variables
$title = isset($_GET['title']) ? $_GET['title'] : null;
$movieId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch movie details
$movieDetails = $tmdbApi->getMovieDetails($movieId);

// Define variables from API call
$movieTitle = $movieDetails['title'];
$releaseDate = $movieDetails['release_date'];
$overview = $movieDetails['overview'];
$genres = $movieDetails['genres'];
$runtime = $movieDetails['runtime'];
$voteAverage = $movieDetails['vote_average'];
$voteCount = $movieDetails['vote_count'];
$tagline = $movieDetails['tagline'];
$production_companies = $movieDetails['production_companies'];
$posterPath = $movieDetails['poster_path'];
$backdropPath = $movieDetails['backdrop_path'];
$status = $movieDetails['status'];
$imdb = $movieDetails['imdb_id'];
$movie_id = $movieDetails['id'];
if ($posterPath === null) {
    $image = "/assets/images/no-image.png";
} else {
    $image = "https://image.tmdb.org/t/p/w500" . $posterPath;
}


// Meta Information

$metaDescription = "Watch {$movieTitle} Anime movie for free in HD in Both English Dubbed, Subbed as well as frech subbed";
$metaTitle = "Watch {$movieTitle} in HD and 4K for free";
$siteName = "AnimeOcean";
$metaAuthor = "AnimeOcean";
$metaImage = "{$image}";
$metaKeywords = "Anime, free anime movies in HD, watch {$movieTitle}, animeocean";
?>

<!DOCTYPE html>
<html lang="en">
<!-- HEAD SECTION STARTS -->
<?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/header.php"); ?>

</head>

<!-- HEAD SECTION ENDS -->

<body id="#top">

  <!-- 
    - #HEADER
  -->

<?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/menu.php"); ?>





  <main>
    <article>
        
        <!-- cta search -->
          <?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/search_form.php"); ?>

      <!-- 
        - #MOVIE DETAIL
      -->

<section class="movie-detail">

  <div class="container">
    <figure class="movie-detail-banner">
      <img src="https://image.tmdb.org/t/p/w500<?= $posterPath; ?>" alt="<?php echo $movieTitle; ?> movie poster">
        <div class="rating rating-movie">
        
          <?= $voteAverage ?>
          </div>
      <button class="play-btn">
        <ion-icon name="play-circle-outline"></ion-icon>
      </button>
    </figure>
    <div class="movie-detail-content">
      <div class="detail-subtitle" style="display:inline-flex; gap:4px">
        <p class="vote-count"><?= $voteCount ?> Votes </p>
          </div>
      <h1 class="h1 detail-title">
        <?php echo $movieTitle; ?>
      </h1>
      <div class="meta-wrapper">
        <div class="badge-wrapper">
          <div class="badge badge-fill"><?= $status ?></div>
          <div class="badge badge-outline">HD</div>
        </div>
        <div class="ganre-wrapper">
          <?php 
            foreach($genres as $genre) {
              echo '<a href="#">' . $genre['name'] . ',</a>';
            }
          ?>
        </div>
        <div class="date-time">
          <div>
            <ion-icon name="calendar-outline"></ion-icon>
            <time datetime="<?= $releaseDate; ?>"><?= date('Y', strtotime($releaseDate)); ?></time>
          </div>
          <div>
            <ion-icon name="time-outline"></ion-icon>
            <time datetime="PT<?= $runtime; ?>M"><?= $runtime; ?> min</time>
          </div>
        </div>
      </div>
      <p class="storyline">
        <?=$overview; ?>
      </p>
      <div class="details-actions">
        <button class="share">
          <ion-icon name="share-social"></ion-icon>
          <span>Share</span>
        </button>
        <button class="btn btn-primary">
          <ion-icon name="play"></ion-icon>
          <span><a href="#video" style="text-decoration:none;color:white">Watch Now</a></span>
        </button>
      </div>
    </div>
    <div class="companies" syle="margin:15px">
           <h2 class="h2 section-subtitle">Companies:</h2>
        <?php
        foreach ($production_companies as $companies){
           echo '<span class="badge badge-outline"> ' . $companies['name'] . '</span>'; 
        }
        ?>
        </div>
  </div>
<blockquote class="callout quote EN">
      <p><?= $tagline ?></p>
    </blockquote>
 
 <!-- Video Section -->
 <?php if ($status === "Released") : ?>
<div class="video" id="video">
    <div class="postmain" id="watching">
    <!-- 16:9 aspect ratio -->
    <div class="custom-aspect-ratio">
        <iframe id="movieIframe" frameborder="0" scrolling="no" allowfullscreen></iframe>
    </div>
</div>

<ul class="top-rated filter-list">
    <li><label class="detail-subtitle">Servers:</label><li>
    <li><button class="filter-btn badge badge-outline" onclick="changeServer('2embed')" >2Embed (En)</button></li>
    <li><button class="filter-btn badge badge-outline" onclick="changeServer('vidsrc')" >VidSrc (En)</button></li>
    <li><button class="filter-btn badge badge-outline" onclick="changeServer('frembed')" >Frembed (Fr)</button></li>
    <li><button class="filter-btn badge badge-outline" onclick="changeServer('superembed')" >SuperEmbed (En)</button></li>
    <li><button class="filter-btn badge badge-outline" onclick="changeServer('remotestream')" >RemoteStream (En)</button></li>
    <li><button class="filter-btn badge badge-outline" onclick="changeServer('moviesapi')" >Movies API (En)</button></li>
</ul>

<!-- Script to dynamically change iframe source based on selected server -->
<script>
    function changeServer(server) {
        var movieIframe = document.getElementById("movieIframe");
        var movieId = "<?php echo $movie_id; ?>";

        switch (server) {
            case "2embed":
                movieIframe.src = "https://www.2embed.cc/embed/" + movieId;
                break;
            case "vidsrc":
                movieIframe.src = "https://vidsrc.me/embed/movie?tmdb=" + movieId;
                break;
            case "frembed":
                movieIframe.src = "https://frembed.com/api/film.php?id=" + movieId;
                break;
            case "superembed":
                movieIframe.src = "/se_player.php?video_id=" + movieId + "&tmdb=1";
                break;
            case "remotestream":
                movieIframe.src = "https://remotestream.cc/e/?tmdb=" + movieId;
                break;
            case "moviesapi":
                movieIframe.src = "https://moviesapi.club/movie/" + movieId;
                break;
            default:
                // Default case, you can handle this as needed
                break;
        }
    }

    // Set initial iframe source based on the default server
    changeServer("2embed");
</script>

</div>
<?php endif ;?>
</section>

<!-- Cast and Crew Section -->

<div class="cast">
    <h2 class="h2 section-title">Movie Cast</h2>
    <br/>
    <?php
    $credits = $tmdbApi->getMovieCredits($movie_id);

    if ($credits && isset($credits['cast']) && count($credits['cast']) > 0) {
        echo '<ul class="movies-list has-scrollbar">'; 
        
        foreach ($credits['cast'] as $castMember) {
            $name = $castMember['name'];
            $character = $castMember['character'];
            $profilePath = $castMember['profile_path'];
            $cast_image = $profilePath ? 'https://image.tmdb.org/t/p/original' . $profilePath : '/assets/images/no-image.png';
            echo '<li>
                    <div class="movie-card">
                        <figure class="card-banner">
                            <img src="' . $cast_image . '" alt="' . $name . '" style="width:250px; height:350px">
                        </figure>
                        <div class="card-meta">
                            <div class="badge badge-outline" style="border-radius:5px">' . $character . '</div>
                        </div>
                        <h3 class="badge badge-fill" style="color:black; font-size:small; border-radius:5px">' . $name . '</h3>
                    </div>
                </li>';
        }

        echo '</ul>';
    }
    ?>
</div>

<div class="crew">
    <h2 class="h2 section-title">Movie Crew</h2>
    <br/>
    <?php
    if ($credits && isset($credits['crew']) && count($credits['crew']) > 0) {
        echo '<ul class="movies-list has-scrollbar">'; 
        
        foreach ($credits['crew'] as $crewMember) {
            $crew_name = $crewMember['name'];
            $job = $crewMember['job'];
            $profilePath = $crewMember['profile_path'];
            $crew_image = $profilePath ? 'https://image.tmdb.org/t/p/original' . $profilePath : '/assets/images/no-image.png';

            echo '<li>
                    <div class="movie-card">
                        <figure class="card-banner">
                            <img src="' . $crew_image . '" style="width:250px; height:350px">
                        </figure>
                        <div class="card-meta">
                            <div class="badge badge-outline" style="border-radius:5px">' . $job . '</div>
                        </div>
                        <h3 class="badge badge-fill" style="color:black; font-size:small; border-radius:5px">' . $crew_name . '</h3>
                    </div>
                </li>';
        }

        echo '</ul>';
    }
    ?>
</div>





      <!-- 
        Releated Movie
      -->

      <section class="tv-series">
        <div class="container">

          <h2 class="h2 section-title">Related Movies</h2>

    <?php

// Read the JSON data from the file
$json_data = file_get_contents('./data/movies.json');

// Decode the JSON data
$movies = json_decode($json_data, true);

// Select four random movies
$random_movies = array_rand($movies, 4);

// Output the HTML structure for the random movies
echo '<ul class="movies-list">';
foreach ($random_movies as $relmovie_id) {
    $relmovie = $movies[$relmovie_id];
    $rel_image = $relmovie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $relmovie['poster_path'] : '/assets/images/no-image.png';
   echo '<li>
                <div class="movie-card">
                  <a href="/movie/' . $relmovie_id . '">
                    <figure class="card-banner">
                      <img src="' . $rel_image . '" alt="' . $relmovie['title'] . '">
                    </figure>
                  </a>

                  <div class="title-wrapper">
                    <a href="/movie/' . $relmovie_id . '">
                      <h3 class="card-title">' . $relmovie['title'] . '</h3>
                    </a>
                    <time datetime="' . $relmovie['release_date'] . '">' . date('Y', strtotime($relmovie['release_date'])) . '</time>
                  </div>

                  <div class="card-meta">
                    <div class="badge badge-outline">HD</div>
                    <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>' . $relmovie['vote_average'] . '</data>
                    </div>
                  </div>
                </div>
              </li>';
}
echo '</ul>';
?>


        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->
<?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/footer.php"); ?>

</body>

</html>