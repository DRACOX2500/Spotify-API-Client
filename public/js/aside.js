
const asideMenu = document.getElementById('aside-menu');
const asideMenuAlbum = document.getElementById('aside-album-list');
const overLoading = document.getElementById('over-loading');

const artistCache = new Map();
const albumsCache = new Map();
const albumsAndTracksCache = new Map();

let artistAside = null;
let albumAside = null;

if (asideMenu) artistAside = new bootstrap.Offcanvas(asideMenu);
if (asideMenuAlbum) albumAside = new bootstrap.Offcanvas(asideMenuAlbum);

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

const player = new Audio();
let timeoutId = null;

function pause(btnElement) {
    player.pause()
    btnElement.lastElementChild.classList.add('d-none')
    btnElement.firstElementChild.classList.remove('d-none')
    clearTimeout(timeoutId)
    timeoutId = null;
}

function play() {
    const btnElement = this

    const audio = btnElement.parentNode.lastElementChild
    const source = String(audio.firstElementChild.src);
    if (source === '#') return


    if (player.paused || source && player.src !== source) {
        if (player.src !== source) pause(btnElement)

        player.setAttribute('src', source)
        player.play().then(() => {
            btnElement.lastElementChild.classList.remove('d-none')
            btnElement.firstElementChild.classList.add('d-none')

            // pause all other buttons
            let playButtons = [...document.getElementsByClassName('play-btn')];
            playButtons = playButtons.filter((_btn) =>
                _btn.parentElement.parentElement.parentElement.id
                !== btnElement.parentElement.parentElement.parentElement.id
            )
            playButtons.forEach((_btn) => {
                _btn.lastElementChild.classList.add('d-none')
                _btn.firstElementChild.classList.remove('d-none')
            })
        })
        if (timeoutId !== null) clearTimeout(timeoutId)
        timeoutId = setTimeout(() => pause(btnElement), 30000)
    }
    else {
        pause(btnElement)
    }
}

function insertAlbumFav(albumID, callback) {
    ajax(
        '/album/insert/' + albumID,
        function () {
            if (!this.responseText) return;
            callback(JSON.parse(this.responseText));
        }
    )
}

function deleteAlbumFav(albumID, callback) {
    ajax(
        '/album/delete/' + albumID,
        function () {
            if (!this.responseText) return;
            callback(JSON.parse(this.responseText));
        }
    )
}

function insertTrackFav(albumID, callback) {
    ajax(
        '/track/insert/' + albumID,
        function () {
            if (!this.responseText) return;
            callback(JSON.parse(this.responseText));
        }
    )
}

function deleteTrackFav(albumID, callback) {
    ajax(
        '/track/delete/' + albumID,
        function () {
            if (!this.responseText) return;
            callback(JSON.parse(this.responseText));
        }
    )
}

function activateFavTrackBtnEffect(cache, cacheKey) {


    const toggleFav = function () {
        const id = this.parentElement.parentElement.id.split('t-')[1];

        if (this.classList.contains('track-fav')) {
            this.classList.remove('track-fav');
            this.children[0].classList.remove('d-none');
            this.children[1].classList.add('d-none');
            deleteTrackFav(id, (result) => {
                if (result.code === 200) {
                    this.children[0].classList.remove('d-none');
                    this.children[1].classList.add('d-none');
                }
                else {
                    this.children[1].classList.remove('d-none');
                    this.children[0].classList.add('d-none');
                }
            })
        }
        else {
            this.classList.add('track-fav')
            this.children[1].classList.remove('d-none');
            this.children[0].classList.add('d-none');
            insertTrackFav(id, (result) => {
                if (result.code === 200 || result.code === 409) {
                    this.children[1].classList.remove('d-none');
                    this.children[0].classList.add('d-none');
                }
                else {
                    this.children[0].classList.remove('d-none');
                    this.children[1].classList.add('d-none');
                }
            })
        }
        cache?.set(cacheKey, asideMenuAlbum.innerHTML);
    };

    const favoriteButtons = document.getElementsByClassName("like-track-btn");

    for (let i = 0; i < favoriteButtons.length; i++) {
        favoriteButtons[i].addEventListener('click', toggleFav.bind(favoriteButtons[i]));
    }
}

function activateFavAlbumBtnEffect(cache, id, primaryId) {


    const toggleFav = function () {
        if (!id) {
            id = this.parentElement.id.split('a-')[1];
        }

        if (this.classList.contains('is-fav')) {
            this.classList.remove('is-fav');
            this.children[0].classList.remove('bi-star-fill');
            this.children[0].classList.add('bi-star');
            deleteAlbumFav(id, (result) => {
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
            insertAlbumFav(id, (result) => {
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
        cache.set(primaryId ?? id, asideMenuAlbum.innerHTML);
    };

    const favoriteButtons = document.getElementsByClassName("album-fav-btn");

    for (let i = 0; i < favoriteButtons.length; i++) {
        favoriteButtons[i].addEventListener('click', toggleFav.bind(favoriteButtons[i]));
    }
}

function showAlbum() {
    const id = this.parentNode.parentElement.id;
    const value = albumsCache.get(id);
    const open = (response) => {
        if (!response) return;
        asideMenuAlbum.innerHTML = response;
        const playButtons = document.getElementsByClassName('play-btn');
        for (let i = 0; i < playButtons.length; i++) {
            playButtons[i].addEventListener('click', play.bind(playButtons[i]))
        }
        activateFavTrackBtnEffect(albumsCache, id);
        activateFavAlbumBtnEffect(albumsCache, id);
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

        const playButtons = document.getElementsByClassName('play-btn');
        for (let i = 0; i < playButtons.length; i++) {
            playButtons[i].addEventListener('click', play.bind(playButtons[i]))
        }

        hideAlbumLoading();
        callback();
        activateFavTrackBtnEffect(albumsAndTracksCache, artistID)
        activateFavAlbumBtnEffect(albumsAndTracksCache, null, artistID);
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
            '/artist/ajax/' + id,
            function () {
                if (!this.responseText) return;
                artistCache.set(id, this.responseText);
                open(this.responseText);
            }
        )
    }

}