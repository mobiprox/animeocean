<?php
require_once 'api.php';

// Fetch recent anime movies
$recentMovies = $tmdbApi->getLatestAnime();

// Fetch popular anime
$popularAnime = $tmdbApi->getPopularAnimeMovies();

// Fet Now playing anime

$nowPlaying = $tmdbApi->getNowPlayingMovies();


// Meta Information

$metaDescription = "Watch Latest trending and popular Japnese Anime Movies and TV Shows for free in HD in Both English Dubbed, Subbed as well as frech subbed";
$metaTitle = "Watch Latest Anime Movies & TV Shows";
$siteName = "AnimeOcean";
$metaAuthor = "AnimeOcean";
$metaImage = "/assets/images/banner.png";
$metaKeywords = "Anime, free anime tvshows, anime tv shows in hd, watch anime tv shows for free, animeocean";
?>
<!DOCTYPE html>
<html lang="en">

<!-- HEAD SECTION STARTS -->
<?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/header.php"); ?>
  
</head>

<!-- HEAD SECTION ENDS -->

<body id="top">

  <!-- 
    - #HEADER
  -->
<?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/menu.php"); ?>

  <main>
    <article>
<!-- cta search -->
          <?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/search_form.php"); ?>
          


      <!-- 
        - RECENT
      -->

      <section class="upcoming">
        <div class="container">

          <div class="flex-wrapper">

            <div class="title-wrapper">
              <p class="section-subtitle">Online Streaming</p>

              <h2 class="h2 section-title">Hot TV Shows</h2>
            </div>

           

          </div>

       <ul class="movies-list has-scrollbar">
    <?php foreach ($recentMovies['results'] as $movie) : ?>
        <?php
        // Fetch movie details to get the runtime
        $movieDetails = $tmdbApi->getMovieDetails($movie['id']);
        $runtime2 = $movieDetails['episode_run_time'] ?? 'N/A';
        ?>
        <li>
            <div class="movie-card">
                <a href="/tv/<?= $movie['id'] ;?>">
                    <figure class="card-banner">
                        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" alt="<?= $movie['name'] ?>">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <a href="/tv/<?= $movie['id'] ;?>">
                        <h3 class="card-title"><?= $movie['name'] ?></h3>
                    </a>
                    <time datetime="<?= $movie['first_air_date'] ?>"><?= date('Y', strtotime($movie['first_air_date'])) ?></time>
                </div>

                <div class="card-meta">
                    <div class="badge badge-outline">HD</div>
                    <div class="duration">
                        <ion-icon name="time-outline"></ion-icon>
                        <time datetime="<?= $runtime2 ?>"><?= $runtime2 ?> min</time>
                    </div>
                    <div class="rating">
                        <ion-icon name="star"></ion-icon>
                        <data><?= $movie['vote_average'] ?></data>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

        </div>
      </section>

      <!-- 
        - #SERVICE
      -->

      <section class="service">
        <div class="container">

          <div class="service-banner">
            <figure>
              <img src="https://image.tmdb.org/t/p/w500/67YXOoKGODyGvJXfXzVmgHNXYh8.jpg" alt="HD 4k resolution! only $3.99">
            </figure>

            <a href="#" download class="service-btn">
              <span>Start Watching Now!</span>

              <ion-icon name="download-outline"></ion-icon>
            </a>
          </div>

          <div class="service-content">

            <p class="service-subtitle">Free Streaming</p>

            <h2 class="h2 service-title">Watch and Download Anime Movies</h2>

            <p class="service-text">
              You can Watch and Download any Anime Movie from our website for free without having to pay or register for an account. All movies are available from multiple servers in English.
            </p>

            <ul class="service-list">

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <ion-icon name="tv"></ion-icon>
                  </div>

                  <div class="card-content">
                    <h3 class="h3 card-title">Enjoy on Your TV.</h3>

                    <p class="card-text">
                      Even if you visit from your smart TV, you will be able to watch Anime in HD for free!
                    </p>
                  </div>

                </div>
              </li>

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <ion-icon name="videocam"></ion-icon>
                  </div>

                  <div class="card-content">
                    <h3 class="h3 card-title">Watch Everywhere.</h3>

                    <p class="card-text">
                      Watch from anywhere, and on any device without restrictions
                    </p>
                  </div>

                </div>
              </li>

            </ul>

          </div>

        </div>
      </section>

      <!-- 
        - #TOP RATED
      -->

      <section class="top-rated">
        <div class="container">

          <p class="section-subtitle">Online Streaming</p>

          <h2 class="h2 section-title">Top Rated Anime Movies</h2>

          <ul class="movies-list">

            <?php foreach ($popularAnime['results'] as $anime_movie) : ?>
        <?php
        // Fetch movie details to get the runtime
        $movieDetails2 = $tmdbApi->getMovieDetails($anime_movie['id']);
        $runtime1 = $movieDetails2['runtime'] ?? 'N/A';
        ?>
        <li>
            <div class="movie-card">
                <a href="/movie/<?= $anime_movie['id'] ?>">
                    <figure class="card-banner">
                        <img src="https://image.tmdb.org/t/p/w500<?= $anime_movie['poster_path'] ?>" alt="<?= $anime_movie['title'] ?>">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <a href="/movie/<?= $anime_movie['id'] ?>">
                        <h3 class="card-title"><?= $anime_movie['title'] ?></h3>
                    </a>
                    <time datetime="<?= $anime_movie['release_date'] ?>"><?= date('Y', strtotime($anime_movie['release_date'])) ?></time>
                </div>

                <div class="card-meta">
                    <div class="badge badge-outline">HD</div>
                    <div class="duration">
                        <ion-icon name="time-outline"></ion-icon>
                        <time datetime="<?= $runtime1 ?>"><?= $runtime1 ?> min</time>
                    </div>
                    <div class="rating">
                        <ion-icon name="star"></ion-icon>
                        <data><?= $anime_movie['vote_average'] ?></data>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>

          </ul>

        </div>
      </section>


      <!-- 
        - #TV SERIES
      -->

      <section class="tv-series">
        <div class="container">

          <p class="section-subtitle">Now Playing</p>

          <h2 class="h2 section-title">Movies currently in theatre</h2>

          <ul class="movies-list">

                        <?php foreach ($nowPlaying['results'] as $now_movie) : ?>
              <?php
              // Fetch movie details to get the runtime
              $movieDetails3 = $tmdbApi->getMovieDetails($now_movie['id']);
              $runtime3 = $movieDetails['runtime'] ?? 'N/A';
              ?>
              <li>
                <div class="movie-card">
                  <a href="./movie-details.html">
                    <figure class="card-banner">
                      <img src="https://image.tmdb.org/t/p/w500<?= $now_movie['poster_path'] ?>" alt="<?= $now_movie['title'] ?>">
                    </figure>
                  </a>

                  <div class="title-wrapper">
                    <a href="./movie-details.html">
                      <h3 class="card-title"><?= $now_movie['title'] ?></h3>
                    </a>
                    <time datetime="<?= $now_movie['release_date'] ?>"><?= date('Y', strtotime($now_movie['release_date'])) ?></time>
                  </div>

                  <div class="card-meta">
                    <div class="badge badge-outline">HD</div>
                    <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="<?= $runtime3 ?>"><?= $runtime3 ?> min</time>
                    </div>
                    <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data><?= $now_movie['vote_average'] ?></data>
                    </div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>

          </ul>

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