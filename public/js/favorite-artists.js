const cardArtistButtons = document.getElementsByClassName('artist-card-btn');
for (let cardButton of cardArtistButtons) {
    cardButton.addEventListener('click', showArtist.bind(cardButton));
}