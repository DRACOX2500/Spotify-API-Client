const asideMenu = document.getElementById('aside-menu');
const asideMenuAlbum = document.getElementById('aside-album-list');
const searchList = document.getElementById('search-list');
const searchBtn = document.getElementById('search-btn');
const searchBar = document.getElementById('search-bar');
const overLoading = document.getElementById('over-loading');

searchBar.value = 'alestorm'

const artistCache = new Map();
const albumsCache = new Map();

const artistAside = new bootstrap.Offcanvas(asideMenu)

const albumAside = new bootstrap.Offcanvas(asideMenuAlbum)

function showLoading() {
	searchList.innerHTML = '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
}

function showAlbumLoading() {
	document.getElementsByTagName('html')[0].style.setProperty('overflow-y', 'hidden');
	overLoading.classList.add('over');
	overLoading.innerHTML = '<div class="absolute-loading"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
}

function hideAlbumLoading() {
	document.getElementsByTagName('html')[0].style.setProperty('overflow-y', 'auto');
	overLoading.classList.remove('over');
	overLoading.innerHTML = '';
}

showLoading()

function ajax(url, callback, method = 'GET') {
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = callback;
	xmlhttp.open(
		method,
		url,
		true
	);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send();
}

function getCardTitle(cardElement) {
	return cardElement.querySelectorAll('.card-title')[0].innerText;
}

function search(query, type = null) {
	showLoading()
	ajax(
		'/search/ajax/?query=' + query + (type ? '&type=' + type : ''),
		function () {
			if (!this.responseText) return;
			searchList.innerHTML = this.responseText;
			const cards = [...searchList.childNodes]

			// alphabetic sort
			cards.sort((a, b) => getCardTitle(a).localeCompare(getCardTitle(b)))

			// include search input value sort
			cards.sort((a, b) =>  !getCardTitle(a).toLowerCase().includes(searchBar.value.toLowerCase())
					- !getCardTitle(b).toLowerCase().includes(searchBar.value.toLowerCase()))
			searchList.innerHTML = '';
			searchList.append(...cards)

			const cardButtons = document.getElementsByClassName('artist-card-btn');
			for (let cardButton of cardButtons) {
				cardButton.addEventListener('click', showArtist.bind(cardButton));
			}
		}
	)
}

search(searchBar.value);
searchBtn.addEventListener('click', () => {
	if (searchBar.value.length <= 0) return
	search(searchBar.value)
})

function showAlbums(artistID, callback) {
	if (!artistID || typeof artistID !== 'string') return;
	const value = albumsCache.get(artistID);
	const open = (response) => {
		if (!response) return;
		asideMenuAlbum.innerHTML = response;
		hideAlbumLoading()
		callback();
		albumAside.show();
	}

	showAlbumLoading()
	if (value) {
		open(value);
	}
	else {
		ajax(
			'/album/ajax/' + artistID,
			function () {
				if (!this.responseText) return;
				albumsCache.set(artistID, this.responseText);
				open(this.responseText);
			}
		)
	}
}

function activateFavArtistBtnEffect(artistCache, id) {
	const toggleFav = function () {

		if (this.classList.contains('is-fav')) {
			this.classList.remove('is-fav');
			this.children[0].classList.remove('bi-star-fill');
			this.children[0].classList.add('bi-star');
		}
		else {
			this.classList.add('is-fav')
			this.children[0].classList.remove('bi-star');
			this.children[0].classList.add('bi-star-fill');
		}
		artistCache.set(id, asideMenu.innerHTML);
	};

	const bubblyButtons = document.getElementsByClassName("favorite-button");
	console.log(bubblyButtons)

	for (let i = 0; i < bubblyButtons.length; i++) {
		bubblyButtons[i].addEventListener('click', toggleFav.bind(bubblyButtons[i]));
	}
}

function showArtist() {
	const id = this.parentNode.parentElement.id;
	const value = artistCache.get(id);
	const open = (response) => {
		if (!response) return;
		asideMenu.innerHTML = response;

		const albumBtn = document.getElementsByClassName('album-list-btn')[0]
		albumBtn.addEventListener('click', () => {
			showAlbums(id, () =>  {
				artistAside.hide()
			})
		})
		activateFavArtistBtnEffect(artistCache, id);
		artistAside.show();
	}


	if (value) {
		open(value);
	}
	else {
		ajax(
			'artist/ajax/' + id,
			function () {
				if (!this.responseText) return;
				artistCache.set(id, this.responseText);
				open(this.responseText);
			}
		)
	}
	
}
