<?php
require_once 'api.php';

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Fetch recent anime movies
$recentMovies = $tmdbApi->getLatestAnimeMovies($currentPage);

// Save recent movies data to JSON file
$movieFilePath = './data/movies.json';
$currentMovieData = [];
if (file_exists($movieFilePath)) {
    $currentMovieData = json_decode(file_get_contents($movieFilePath), true);
}

// Check if there are already data for 50 different movies
if (count($currentMovieData) >= 50) {
    $currentMovieData = []; // Clear the existing data
}

$newMovies = $recentMovies['results'];
foreach ($newMovies as $movie) {
    $movieId = $movie['id'];
    if (!isset($currentMovieData[$movieId])) {
        $currentMovieData[$movieId] = $movie;
    }
}
file_put_contents($movieFilePath, json_encode($currentMovieData, JSON_PRETTY_PRINT));


// Meta Information

$metaDescription = "Watch Latest trending Anime TV Movies for free in HD in Both English Dubbed, Subbed as well as frech subbed";
$metaTitle = "Latest Anime Movies";
$siteName = "AnimeOcean";
$metaAuthor = "AnimeOcean";
$metaImage = "/assets/images/banner.png";
$metaKeywords = "Anime, free anime movies, anime in hd, watch anime japanese for free, animeocean";

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
      Recent Movies
      -->

      <section class="tv-series">
        <div class="container">

          <p class="section-subtitle">Watch Anime Movies for free</p>

          <h2 class="h2 section-title">Recent Anime Movies</h2>

          <ul class="movies-list">

            <?php foreach ($recentMovies['results'] as $movie) : ?>
        <?php
        // Fetch movie details to get the runtime
        $movieDetails = $tmdbApi->getMovieDetails($movie['id']);
        $runtime2 = $movieDetails['runtime'] ?? 'N/A';
        ?>
        <li>
            <div class="movie-card">
                <a href="/movie/<?= $movie['id'] ?>">
                    <figure class="card-banner">
                        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" alt="<?= $movie['title'] ?>">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <a href="/movie/<?= $movie['id'] ?>">
                        <h3 class="card-title"><?= $movie['title'] ?></h3>
                    </a>
                    <time datetime="<?= $movie['release_date'] ?>"><?= date('Y', strtotime($movie['release_date'])) ?></time>
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

<ul class="filter-list" style="margin-bottom:15px;">
    <?php if ($currentPage > 1) {
        $previousPage = ($currentPage > 1) ? $currentPage - 1 : 1;
        echo "<li>
            <a href=\"?page=$previousPage\" class=\"btn btn-primary filter-btn\">Previous Page</a>
        </li>";
    }
    
    if (isset($recentMovies['total_pages']) && $currentPage < $recentMovies['total_pages']) {
        $nextPage = $currentPage + 1;
        echo "<li>
            <a href=\"?page=$nextPage\" class=\"btn btn-primary filter-btn\">Next Page</a>
        </li>";
    }
    ?>
</ul>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

<?php include ($_SERVER["DOCUMENT_ROOT"] . "/include/footer.php"); ?>

</body>

</html>