import {Aside} from "./_aside";
import {CacheService} from "../../services/cache/cache-service";
import {AlbumCard} from "../card/album-card";
import {AlbumService} from "../../services/album/album-service";

export class AlbumAside extends Aside {

    constructor(
        asideElement: HTMLElement
    )
    {
        super(asideElement)
    }

    show(card: AlbumCard) {
        const id = card.id;
        const value = CacheService.albums.get(id);

        const open = (response: string) => {
            if (!response) return;
            card.asideElement.innerHTML = response;

            // const playButtons = document.getElementsByClassName('play-btn');
            // for (let i = 0; i < playButtons.length; i++) {
            //     playButtons[i].addEventListener('click', play.bind(playButtons[i]))
            // }
            // activateFavAlbumBtnEffect(albumsCache, id)
            card.aside.offCanvas.show();
        }

        if (value) {
            open(value);
        }
        else {
            AlbumService.get(id, (response: string) => {
                if (!response) return
                CacheService.albums.set(id, response)
                open(response)
            })
        }
    }

    hide() {
        this.offCanvas.hide()
    }
}