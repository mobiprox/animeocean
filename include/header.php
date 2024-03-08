<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $metaTitle ;?> | <?= $siteName ;?></title>
   <meta name="description" content="<?= $metaDescription ;?>">
   <meta name="keywords" content="<?= $metaKeywords ;?>">
    <meta name="author" content="<?= $metaAuthor ;?>">
    <meta property="og:title" content="<?= $metaTitle ;?> | <?= $siteName ;?>">
    <meta property="og:description" content="<?= $metaDescription ;?> ">
    <meta name="og:keywords" content="<?= $metaKeywords ;?>">
    <meta name="og:image" content="<?= $metaImage ;?>">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="/assets/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
  * {
  box-sizing: border-box;
}
.cta {
    margin-top:160px;
}
/* Position the search results container */
.search-results-container {
    position: absolute;
    top: auto; 
    left: 0;
    width: 100%;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none; /* Hide top border to align with input field */
    z-index: 1000; /* Ensure it's above other elements */
    display: none; /* Initially hide container */
}

/* Style the search results header */
.search-results-header {
    padding: 10px;
    display: flex;
    justify-content: space-between; /* Align close button to the right */
    align-items: center;
    border-bottom: 1px solid #ccc;
}

/* Style the close button */
.close-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 20px;
    color: #333;
}

/* Style search result items */
.search-result {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    display: flex; /* Display items side by side */
    align-items: center; /* Align items vertically */
}

/* Style details container */
.details {
    margin-left: 10px; /* Add space between image and details */
}

/* Style links */
.details a {
    text-decoration: none;
    color: #333;
}

/* Style hover effect for search result items */
.search-result:hover {
    background-color: #f0f0f0;
}


      /* Styles for the container div */
    .postmain {
        width: 96%;
        max-width: 96%;
        overflow: hidden;
        margin:auto;
    }

    /* Styles for the custom aspect ratio */
    .custom-aspect-ratio {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 aspect ratio (9 / 16 * 100) */
    }

    /* Styles for the iframe inside the custom aspect ratio */
    .custom-aspect-ratio iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Styles for the select dropdown */
    #serverSelect {
        width: 100%;
        max-width: 300px; /* Adjust max-width as needed */
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        box-sizing: border-box; /* Include padding and border in the width */
    }

    /* Additional styles for labels */
    label {
        font-weight: bold;
        margin-right: 10px;
    }

    /* Responsive adjustments */
    @media only screen and (max-width: 600px) {
        #serverSelect {
            max-width: 100%; /* Adjust width for smaller screens */
        }
    }
  .cast, .crew, .seasons {
      margin: 20px;
  }
  .movie-detail-banner {
    position: relative;
}
.rating-movie {
    position: absolute;
    top: 5px; /* Adjust as needed */
    right: 5px; /* Adjust as needed */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px; /* Set the width and height to make it a circle */
    height: 60px; /* Adjust as needed */
    border-radius: 50%; /* Make it a circle */
    border: 2px solid orange; /* Orange border */
    color:white;
    background-color:orange;
   
}
blockquote.quote {
    position: relative; 
    text-align: center;
    padding: 1rem 1.2rem;
    width: 80%; 
    margin: 1rem auto 2rem;
    margin-top:20px;
    color:white;
}
blockquote.EN {
    background:
    linear-gradient(to right, orange 4px, transparent 4px) 0 100%,
    linear-gradient(to left, orange 4px, transparent 4px) 100% 0,
    linear-gradient(to bottom, orange 4px, transparent 4px) 100% 0,
    linear-gradient(to top, orange 4px, transparent 4px) 0 100%;
    background-repeat: no-repeat;
    background-size: 20px 20px;
}
    

/* -- create the quotation marks -- */
blockquote.quote:before,
blockquote.quote:after{
    font-family: FontAwesome;
    position: absolute;
    color: orange;
    font-size: 34px;
}

blockquote.EN:before{
    content: '"'
    top: -12px;
    margin-right: -20px;
    right: 100%;
}
blockquote.EN:after{
    content: '"'
    margin-left: -20px;
    left: 100%;  
    top: auto;
    bottom: -20px;
}

  </style>