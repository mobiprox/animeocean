<div align="center">
  
  <img src="https://animeocean.top/assets/images/banner.png" style="width:25%;"/>

  <h2 align="center">Watch Latest Anime Movies & TV Shows | AnimeOcean</h2>

 Watch the Latest trending and popular Japanese anime Movies and TV Shows for free in HD in Both English Dubbed, Subbed as well as French subbed built with PHP and TMDB API based on <a href="https://github.com/codewithsadee/filmlane">Filmelane design</a>

  <a href="https://www.animeocean.top"><strong>➥ Live Demo</strong></a>

</div>

<br />

## Demo Screenshots

### Homepage

<img src="./assets/images/www.animeocean.top.png"/>

### Details page

<img src="./assets/images/www.animeocean.top1.png"/>

## How this script functions
AnimeOcean uses The Movie Database to get selectively Anime movies and TV Show data. It also uses different free video sources to embed videos for the Anime based on the Tmdb ID. It comes with a live search feature that makes use of AJAX to simultaneously search movies and TV shows and then filters them to only render Animations.

The <pre>movie.php</pre> file is responsible for displaying all different movie details based on the submitted movie ID
The <pre>tv.php</pre> file is responsible for displaying all different TV Show details based on the submitted movie ID
The <pre>api.php</pre> file contains the TMDB API class, and you will need to edit it with your own TMDB API.
<pre>movies.php</pre> displays list of recent movies while the <pre>tvshows.php</pre> is for displaying the TV Show list.

Menu, header and footer files are found in the /include folder.

## Prerequisites

Before you begin, ensure you have met the following requirements:

* [Git](https://git-scm.com/downloads "Download Git") must be installed on your operating system.

## Run Locally

To run **AnimeOcean** locally, run this command on your git bash:

Linux and macOS:

```bash
sudo git clone https://github.com/mobiprox/animeocean.git
```

Windows:

```bash
git clone https://github.com/mobiprox/animeocean.git
```
### License

This project is **free to use** and does not contain any license.
