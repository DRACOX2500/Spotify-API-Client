import { SearchLoading } from './modules/loading/search-loading';
import { ArtistAlbumsLoading } from "./modules/loading/artist-albums-loading";
import { SearchService } from "./services/search/search-service";
import { Card } from "./modules/card/_card";
import {ArtistAside} from "./modules/aside/artist-aside";
import {ArtistCard} from "./modules/card/artist-card";
import {AlbumCard} from "./modules/card/album-card";

const asideMenu = <HTMLElement>document.getElementById('aside-menu');
const asideMenuAlbum = <HTMLElement>document.getElementById('aside-album-list');
const searchList = <HTMLElement>document.getElementById('search-list');
const searchBtn = <HTMLButtonElement>document.getElementById('search-btn');
const searchBar = <HTMLInputElement>document.getElementById('search-bar');
const overLoading = <HTMLElement>document.getElementById('over-loading');

searchBar.value = 'alestorm';

// Cache
// const artistCache = new Map<string, string>();
// const albumsCache = new Map<string, string>();
// const albumsAndTracksCache = new Map<string, string>();

const searchLoading = new SearchLoading(searchList);
const artistAlbumsLoading = new ArtistAlbumsLoading(overLoading)

const asideArtist = new ArtistAside(asideMenu);

function sortCards(cards: Card<any>[], query: string): void  {
    // alphabetic sort
    cards.sort((a, b) => a.title.localeCompare(b.title))

    // include search input value sort
    cards.sort((a, b) =>
        +!a.title.toLowerCase().includes(query.toLowerCase())
        - +!b.title.toLowerCase().includes(query.toLowerCase()))
}

function search() {
    searchLoading.show()
    if (searchBar.value.length <= 0) return

    const query = searchBar.value
    SearchService.all(query, (reponse: string) => {
        if (!reponse) return;
        const tmp = document.createElement('div');
        tmp.innerHTML = reponse;

        const cards: Card<any>[] = []
        tmp.childNodes.forEach((node, i) => {
            const element = tmp.children.item(i);
            if (!element) return;

            const type = Card.foundType(element)
            if (type === 'artist') {
                cards.push(new ArtistCard(<HTMLElement>element, asideMenu))
            }
            else {
                cards.push(new AlbumCard(<HTMLElement>element, asideMenuAlbum))
            }
        })

        sortCards(cards, query);

        searchLoading.hide()
        searchList.append(...Card.ArrayToArrayNode(cards))
    })
}

search();
searchBtn.addEventListener('click', search)


