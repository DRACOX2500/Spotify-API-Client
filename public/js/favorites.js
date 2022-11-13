const cardAlbumButtons = document.getElementsByClassName('album-card-btn');
for (let cardButton of cardAlbumButtons) {
    cardButton.addEventListener('click', showAlbum.bind(cardButton));
}