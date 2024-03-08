 <section class="cta" style="border-radius:5px">
        <div class="container">

         <form action="" method="POST" class="cta-form">
    <input type="text" name="search" id="search" required placeholder="Search..." class="email-field livesearch">
   <div id="search-results-container" class="search-results-container">
    <div class="search-results-header">
        <h3>Search Results</h3>
        <button id="close-search-results-btn" class="close-btn">&times;</button>
    </div>
    <div id="search-results-overlay" class="search-results-overlay"></div>
</div>

    <button type="submit" class="cta-form-btn">Search</button>
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('search');
    const searchResultsContainer = document.getElementById('search-results-container');
    const searchResultsOverlay = document.getElementById('search-results-overlay');
    const closeSearchResultsBtn = document.getElementById('close-search-results-btn');

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query !== '') {
            // Make AJAX request to fetch search results
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    displayResults(response);
                }
            };
            xhr.open('GET', `/search.php?search=${query}`, true);
            xhr.send();
        } else {
            // Clear search results overlay and hide it if input is empty
            clearSearchResults();
        }
    });

    function displayResults(results) {
        let html = '';
        for (const type in results) {
            if (results.hasOwnProperty(type)) {
                const resultType = results[type];
                resultType.forEach(result => {
                    const url = type === 'movies' ? `/movie/${result.id}` : `/tv/${result.id}`;
                    html += `<div class="search-result">
                                <a href="${url}">
                                    <img src="${result.image}" alt="${result.title || result.name}" width="50" height="50">
                                </a>
                                <div class="details">
                                    <a href="${url}">${result.title || result.name}</a>
                                </div>
                             </div>`;
                });
            }
        }
        searchResultsOverlay.innerHTML = html;
        searchResultsContainer.style.display = 'block'; // Show search results container
    }

    function clearSearchResults() {
        searchResultsOverlay.innerHTML = '';
        searchResultsContainer.style.display = 'none'; // Hide search results container
    }

    closeSearchResultsBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default button behavior
        clearSearchResults();
    });
});
</script>





        </div>
      </section>