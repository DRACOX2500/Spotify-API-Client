const playButtons = document.getElementsByClassName('play-btn');
for (let i = 0; i < playButtons.length; i++) {
    playButtons[i].addEventListener('click', play.bind(playButtons[i]))
}
activateFavTrackBtnEffect()