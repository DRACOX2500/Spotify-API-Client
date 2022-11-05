const asideMenu = document.getElementById('aside-menu');
const searchList = document.getElementById('search-list');
const searchBtn = document.getElementById('search-btn');
const searchBar = document.getElementById('search-bar');

searchBar.value = 'alestorm'

const artistCache = new Map();

const artistAside = new bootstrap.Offcanvas(
	document.getElementById('aside-menu')
)

function showLoading() {
	searchList.innerHTML = '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
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

function showArtist() {
	const id = this.parentNode.parentElement.id;
	const value = artistCache.get(id);
	if (value) {
		((response) => {
			if (!response) return;
			asideMenu.innerHTML = response;
			artistAside.show();
		})(value)
	}
	else {
		ajax(
			'/Ajax/spotify-artist.php?format=html&artist_id=' + id,
			function () {
				if (!this.responseText) return;
				artistCache.set(id, this.responseText);
				asideMenu.innerHTML = this.responseText;
				artistAside.show();
			}
		)
	}
	
}
