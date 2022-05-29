function onResponse(response)
{
    return response.json();
}

let movie_json;

function onMovie(data)
{
    const section = document.querySelector('#section');
    section.classList.remove('hidden');
    const movie = document.querySelector('#section .movie');
    movie.innerHTML = '';
    movie_json = data.results[0];
    const title = document.createElement('h2');
    const year = document.createElement('h1');
    const img = document.createElement('img');
    title.textContent = movie_json.title;
    year.textContent = movie_json.description;
    img.src = movie_json.image;
    movie.appendChild(title);
    movie.appendChild(year);
    movie.appendChild(img);
    fetch("favourites_db.php?action=check&title=" + movie_json.title)
    .then(onResponse).then(onFavourite);
}

function onSearch(event)
{
    event.preventDefault();
    const url = "home_rest.php?movie=" + movie_form.movie.value;
    fetch(url).then(onResponse).then(onMovie);
}

const movie_form = document.forms['movie-form'];
movie_form.addEventListener('submit', onSearch);

function onText(event)
{
    if (text.value.length != 0) {
        movie_form['submit'].disabled = false;
    } else {
        movie_form['submit'].disabled = true;
    }
}

const text = movie_form['movie'];
text.addEventListener('keyup', onText);

let selected = false;

function setNumFavourites(data)
{
    const num = document.querySelector('#num-favourites');
    num.textContent = data.number;
}

function onFavourite(data)
{
    const string = document.querySelector('#star div');
    setNumFavourites(data);
    if (data.present) {
        star.src = "img/yellow_star.png"
        selected = true;
        string.textContent = "Film tra i preferiti!";
    } else {
        star.src = "img/star.png"
        selected = false;
        string.textContent = "Aggiungi ai preferiti";
    }
}

function refreshFavourites()
{
    fetch("favourites_db.php?action=check&title=" + movie_json.title)
    .then(onResponse).then(setNumFavourites);
    fetch("search_favourites.php").then(onResponse).then(displayFavourites);
}

function onStarClick(event)
{
    const string = document.querySelector('#star div');
    if (!selected) {
        star.src = "img/yellow_star.png"
        selected = true;
        string.textContent = "Film tra i preferiti!";
        const url = "favourites_db.php?action=add&title=" + movie_json.title + 
        "&desc=" + movie_json.description + "&poster=" + movie_json.image;
        fetch(url).then(refreshFavourites);
    } else {
        star.src = "img/star.png"
        selected = false;
        string.textContent = "Aggiungi ai preferiti";
        fetch("favourites_db.php?action=remove&title=" + movie_json.title)
        .then(refreshFavourites);
    }
}

const star = document.querySelector('#star img');
star.addEventListener('click', onStarClick);

function displayFavourites(movies)
{
    const favourites = document.querySelector('section');
    favourites.innerHTML = "";
    if (movies.length != 0) {
        favourites.classList.remove('hidden');
    } else {
        favourites.classList.add('hidden');
        return;
    }
    for (const movie of movies) {
        const movie_box = document.createElement('div');
        movie_box.classList.add('movie');
        const title = document.createElement('h2');
        const year = document.createElement('h1');
        const img = document.createElement('img');
        title.textContent = movie.title;
        year.textContent = movie.description_;
        img.src = movie.poster;
        movie_box.appendChild(title);
        movie_box.appendChild(year);
        movie_box.appendChild(img);
        favourites.appendChild(movie_box);
    }
}

fetch("search_favourites.php").then(onResponse).then(displayFavourites);

function onMenuClick(event)
{
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.add('open');
    close_area.classList.remove('hidden');
    const page = document.querySelector('.page');
    page.classList.add('opacity');
}

const menu = document.querySelector('#menu');
menu.addEventListener('click', onMenuClick);

function onCloseSidebar(event)
{
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.remove('open');
    close_area.classList.add('hidden');
    const page = document.querySelector('.page');
    page.classList.remove('opacity');
}

const close_img = document.querySelector('.sidebar img');
close_img.addEventListener('click', onCloseSidebar);

const close_area = document.querySelector('.close-sidebar');
close_area.addEventListener('click', onCloseSidebar);