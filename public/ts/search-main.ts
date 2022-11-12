import { SearchLoading } from './modules/loading/search-loading';
import { ArtistAlbumsLoading } from "./modules/loading/artist-albums-loading";
import { SearchService } from "./services/search/SearchService";

const asideMenu = <HTMLElement>document.getElementById('aside-menu');
const asideMenuAlbum = <HTMLElement>document.getElementById('aside-album-list');
const searchList = <HTMLElement>document.getElementById('search-list');
const searchBtn = <HTMLButtonElement>document.getElementById('search-btn');
const searchBar = <HTMLInputElement>document.getElementById('search-bar');
const overLoading = <HTMLElement>document.getElementById('over-loading');

searchBar.value = 'alestorm';

// Cache
const artistCache = new Map<string, string>();
const albumsCache = new Map<string, string>();
const albumsAndTracksCache = new Map<string, string>();

const searchLoading = new SearchLoading(searchList);
const artistAlbumsLoading = new ArtistAlbumsLoading(overLoading)

function getCardTitle(card: ChildNode): string {
    return card.firstChild?.lastChild?.firstChild?.textContent ?? '';
}

function sortCards(cards: ChildNode[], query: string): void  {
    // alphabetic sort
    cards.sort((a, b) => getCardTitle(a).localeCompare(getCardTitle(b)))

    // include search input value sort
    cards.sort((a, b) =>
        +!getCardTitle(a).toLowerCase().includes(query.toLowerCase())
        - +!getCardTitle(b).toLowerCase().includes(query.toLowerCase()))
}

function search() {
    searchLoading.show()
    if (searchBar.value.length <= 0) return

    const query = searchBar.value
    SearchService.all(query, (reponse: string) => {
        if (!reponse) return;
        const tmp = document.createElement('div');
        tmp.innerHTML = reponse;

        const cards = Array.from(tmp.childNodes)

        sortCards(cards, query);

        searchLoading.hide()
        searchList.append(...cards)
    })
}

search();
searchBtn.addEventListener('click', search)


