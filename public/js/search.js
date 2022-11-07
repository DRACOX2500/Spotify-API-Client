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

function search(query, type = 'artist') {
	showLoading()
	ajax(
		'/Ajax/spotify-search.php?q=' + query + '&type=' + type,
		function () {
			if (!this.responseText) return;
			searchList.innerHTML = this.responseText;

			const cardButtons = document.getElementsByClassName('card-btn');
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
				console.log('ok')
				open(this.responseText);
			}
		)
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
