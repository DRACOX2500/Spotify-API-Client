
const searchList = document.getElementById('search-list');
const searchBtn = document.getElementById('search-btn');
const searchBar = document.getElementById('search-bar');

if (!searchBar.value) {
	searchBar.value = 'alestorm'
}


const searchForm = document.getElementById('search-form');

// Disable redirect form
searchForm.onsubmit = (e) => {
	e.preventDefault()
	return false;
};

function showLoading() {
	searchList.innerHTML = '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
}

showLoading()

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
