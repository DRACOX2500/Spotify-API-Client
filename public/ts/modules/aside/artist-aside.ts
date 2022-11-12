import { Aside } from "./_aside";
import { CacheService } from "../../services/cache/cache-service";
import { ArtistService } from "../../services/artist/artist-service";
import { ArtistCard } from "../card/artist-card";

export class ArtistAside extends Aside {

    constructor(
        asideElement: HTMLElement
    )
    {
        super(asideElement)
    }

    show(card: ArtistCard) {
        const id = card.id;
        const value = CacheService.artists.get(id);

        const open = (response: string) => {
            if (!response) return;

            card.asideElement.innerHTML = response;

            // const albumBtn = document.getElementsByClassName('album-list-btn')[0]
            // albumBtn.addEventListener('click', () => {
            //     showAlbums(id, () =>  {
            //         artistAside.hide()
            //     })
            // })
            // activateFavArtistBtnEffect(artistCache, id);
            card.aside.offCanvas.show();
        }

        if (value) {
            open(value);
        }
        else {
            ArtistService.get(id, (response: string) => {
                if (!response) return
                CacheService.artists.set(id, response)
                open(response)
            })
        }
    }

    hide() {
        this.offCanvas.hide()
    }
}