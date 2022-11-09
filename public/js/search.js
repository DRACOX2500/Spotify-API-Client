const asideMenu = document.getElementById('aside-menu');
const asideMenuAlbum = document.getElementById('aside-album-list');
const searchList = document.getElementById('search-list');
const searchBtn = document.getElementById('search-btn');
const searchBar = document.getElementById('search-bar');
const overLoading = document.getElementById('over-loading');

searchBar.value = 'alestorm'

const artistCache = new Map();
const albumsCache = new Map();
const albumsAndTracksCache = new Map();

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

			const cardArtistButtons = document.getElementsByClassName('artist-card-btn');
			const cardAlbumButtons = document.getElementsByClassName('album-card-btn');
			for (let cardButton of cardArtistButtons) {
				cardButton.addEventListener('click', showArtist.bind(cardButton));
			}
			for (let cardButton of cardAlbumButtons) {
				console.log(cardButton)
				cardButton.addEventListener('click', showAlbum.bind(cardButton));
			}
		}
	)
}

search(searchBar.value);
searchBtn.addEventListener('click', () => {
	if (searchBar.value.length <= 0) return
	search(searchBar.value)
})

function showAlbum() {
	const id = this.parentNode.parentElement.id;
	const value = albumsCache.get(id);
	const open = (response) => {
		if (!response) return;
		asideMenuAlbum.innerHTML = response;
		albumAside.show();
	}

	if (value) {
		open(value);
	}
	else {
		ajax(
			'/album/ajax2/' + id,
			function () {
				if (!this.responseText) return;
				albumsCache.set(id, this.responseText);
				open(this.responseText);
			}
		)
	}
}

function showAlbums(artistID, callback) {
	if (!artistID || typeof artistID !== 'string') return;
	const value = albumsAndTracksCache.get(artistID);
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
				albumsAndTracksCache.set(artistID, this.responseText);
				open(this.responseText);
			}
		)
	}
}

function insertFav(artistID, callback) {
	ajax(
		'/artist/insert/' + artistID,
		function () {
			if (!this.responseText) return;
			callback(JSON.parse(this.responseText));
		}
	)
}

function deleteFav(artistID, callback) {
	ajax(
		'/artist/delete/' + artistID,
		function () {
			if (!this.responseText) return;
			callback(JSON.parse(this.responseText));
		}
	)
}

function activateFavArtistBtnEffect(artistCache, id) {
	const toggleFav = function () {

		if (this.classList.contains('is-fav')) {
			this.classList.remove('is-fav');
			this.children[0].classList.remove('bi-star-fill');
			this.children[0].classList.add('bi-star');
			deleteFav(id, (result) => {
				if (result.code === 200) {
					this.children[0].classList.remove('bi-star-fill');
					this.children[0].classList.add('bi-star');
				}
				else {
					this.children[0].classList.remove('bi-star');
					this.children[0].classList.add('bi-star-fill');
				}
			})
		}
		else {
			this.classList.add('is-fav')
			this.children[0].classList.remove('bi-star');
			this.children[0].classList.add('bi-star-fill');
			insertFav(id, (result) => {
				if (result.code === 200 || result.code === 409) {
					this.children[0].classList.remove('bi-star');
					this.children[0].classList.add('bi-star-fill');
				}
				else {
					this.children[0].classList.remove('bi-star-fill');
					this.children[0].classList.add('bi-star');
				}
			})
		}
		artistCache.set(id, asideMenu.innerHTML);
	};

	const favoriteButtons = document.getElementsByClassName("favorite-button");

	for (let i = 0; i < favoriteButtons.length; i++) {
		favoriteButtons[i].addEventListener('click', toggleFav.bind(favoriteButtons[i]));
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
