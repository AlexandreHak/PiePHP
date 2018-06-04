// movie/add
let movieSearch = document.querySelector('.movie-search');
let moviesList = document.querySelector('.movie-search-list');
// genre/add
let addGenre = document.querySelector('.add-genre');
let genreList = document.querySelector('.genre-list');

if (movieSearch !== null && moviesList !== null) {
    let title = document.getElementById('title');
    let releaseDate = document.getElementById('release_date');
    let genre = document.getElementById('genre');
    let publisher = document.getElementById('publisher');
    let runtime = document.getElementById('runtime');
    let overview = document.getElementById('overview');
    let posterPath = document.getElementById('poster');
    let tmdbId = document.getElementById('id_tmdb');

    movieSearch.addEventListener('input', (event) => {
        if (movieSearch.value.length > 0) {
            $.ajax({
                url: `https://api.themoviedb.org/3/search/movie?api_key=fa45b49e89f7709536f5154c2b13a4ee&query=${movieSearch.value}`,
                // data: { name: "John", location: "Boston" }
            })
            .done(function( data ) {
                // search list
                moviesList.innerHTML = '';
                $.each(data.results, function(i, val) {
                    moviesList.insertAdjacentHTML('beforeend', `<button id="${val.id}" class="list-group-item list-group-item-action movie">${val.original_title} || ${val.release_date}</button>`);
                    // document.querySelector('');
                });
            });
        }
    
        if (movieSearch.value.length === 0) {
            moviesList.innerHTML = '';
            movieSearch.innerHTML = '';
        }
    });

    moviesList.addEventListener('click', (event) => {
        let movieId = event.target.id;
        
        $.ajax({
            url: `https://api.themoviedb.org/3/movie/${movieId}?api_key=fa45b49e89f7709536f5154c2b13a4ee` 
        })
        .done(function( film ) {
            title.value = film.original_title;        
            releaseDate.value = film.release_date;
            
            genre.value = ( film.genres.length > 0 ) ? film.genres[0].name.toLowerCase() : '';
            publisher.value = ( film.production_companies.length > 0 ) ? film.production_companies[0].name.toLowerCase() : '';
            
            if (publisher.value === '' && film.production_companies.length > 0) {
                let productionCompanie = film.production_companies[0].name.toLowerCase();

                $.ajax({
                    method: "POST",
                    url: "/PiePHP/publisher/add",
                    data: { name: productionCompanie },
                    dataType: 'json'
                })
                .done(function( info ) {
                    let msg = [];
                    for (let key in info) {
                        msg += info[key] + "\n";
                    }
                    alert( msg );
                    
                    if (info.hasOwnProperty('info')) {
                        publisher.insertAdjacentHTML('beforeend', `<option value="${ productionCompanie }">${ productionCompanie }</option>`);
                        publisher.value = productionCompanie;
                    }
                });
            }
            
            runtime.value = film.runtime;
            overview.textContent = film.overview;
            posterPath.value = film.poster_path;
            tmdbId.value = film.id;
        });
    });
}

if (addGenre !== null && genreList !== null) {
    addGenre.addEventListener('submit', ( event ) => {
        event.preventDefault();
        
        $.ajax({
            method: "POST",
            url: "/PiePHP/genre/add",
            data: { name: addGenre[0].value.toLowerCase() },
            dataType: 'json'
        })
        .done(function( info ) {
            let msg = [];
            for (let key in info) {
                msg += info[key] + "\n";
            }
            alert(msg);
        });
    });
}

// delete genre on click 




//http://api.themoviedb.org/3/search/movie?api_key=fa45b49e89f7709536f5154c2b13a4ee&query=coco
/**
 * this is how you handle ajax requset 
 */
// $.ajax({
//     url: `https://api.unsplash.com/search/photos?page=1&query=${searchedForText}`
// }).done(addImage);