<?php
require_once 'api.php';

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Fetch recent anime TV
$recentTV = $tmdbApi->getLatestAnimeTV($currentPage);

// Save recent tv shows data to JSON file
$tvFilePath = './data/tv.json';
$currentTvData = [];
if (file_exists($tvFilePath)) {
    $currentTvData = json_decode(file_get_contents($tvFilePath), true);
}

// Check if there are already data for 50 different TV
if (count($currentTvData) >= 50) {
    $currentTvData = []; // Clear the existing data
}

$newTVs = $recentTV['results'];
foreach ($newTVs as $TV) {
    $rel_tvId = $TV['id'];
    if (!isset($currentTvData[$rel_tvId])) {
        $currentTvData[$rel_tvId] = $TV;
    }
}
file_put_contents($tvFilePath, json_encode($currentTvData, JSON_PRETTY_PRINT));


// Meta Information

$metaDescription = "Watch Latest trending Anime TV Shows for free in HD in Both English Dubbed, Subbed as well as frech subbed";
$metaTitle = "Latest Anime TV Shows";
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

          <p class="section-subtitle">Watch Anime TVShows for free </p>

          <h2 class="h2 section-title">Recent Anime TVShows</h2>

          <ul class="movies-list">

            <?php foreach ($recentTV['results'] as $tv) : ?>
        <?php
        // Fetch movie details to get the runtime
        $tvDetails = $tmdbApi->getTVDetails($tv['id']);
        $runtime2 = $tvDetails['episode_run_time'][0] ?? 'N/A';
        ?>
        <li>
            <div class="movie-card">
                <a href="/tv/<?= $tv['id'] ; ?>">
                    <figure class="card-banner">
                        <img src="https://image.tmdb.org/t/p/w500<?= $tv['poster_path'] ?>" alt="<?= $tv['name'] ?>">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <a href="/tv/<?= $tv['id'] ; ?>">
                        <h3 class="card-title"><?= $tv['name'] ?></h3>
                    </a>
                    <time datetime="<?= $tv['first_air_date'] ?>"><?= date('Y', strtotime($tv['first_air_date'])) ?></time>
                </div>

                <div class="card-meta">
                    <div class="badge badge-outline">HD</div>
                    <div class="duration">
                        <ion-icon name="time-outline"></ion-icon>
                        <time datetime="<?= $runtime2 ?>"><?= $runtime2 ?> min Ep</time>
                    </div>
                    <div class="rating">
                        <ion-icon name="star"></ion-icon>
                        <data><?= $tv['vote_average'] ?></data>
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
    
    if (isset($recentTV['total_pages']) && $currentPage < $recentTV['total_pages']) {
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