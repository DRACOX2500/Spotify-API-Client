const asideMenu = document.getElementById('aside-menu');
const searchList = document.getElementById('search-list');
const searchBtn = document.getElementById('search-btn');
const searchBar = document.getElementById('search-bar');

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
			console.log(searchList)
			searchList.innerHTML = this.responseText;

			const cardButtons = document.getElementsByClassName('card-btn');
			for (let cardButton of cardButtons) {
				cardButton.addEventListener('click', showArtist.bind(cardButton));
			}
		}
	)
}

search('alestorm');
searchBtn.addEventListener('click', () => {
	if (searchBar.value.length <= 0) return
	search(searchBar.value)
})

function showArtist() {
	const id = this.parentNode.parentElement.id;
	ajax(
		'/Ajax/spotify-artist.php?format=html&artist_id=' + id,
		function () {
			if (!this.responseText) return;
			asideMenu.innerHTML = this.responseText;

			const closeAsideBtn = document.getElementsByClassName('close-aside')[0];
			if (closeAsideBtn) closeAsideBtn.addEventListener('click', () => {
				asideMenu.style.left = '0';
			})

			asideMenu.parentElement.classList.add('show');
			asideMenu.style.left = '490px';
		}
	)
}
