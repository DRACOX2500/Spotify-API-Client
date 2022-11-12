import {Card} from "./_card";
import {ArtistAside} from "../aside/artist-aside";

export class ArtistCard extends Card<'artist'> {

    public aside: ArtistAside;

    constructor(
        element: HTMLElement,
        public asideElement: HTMLElement,
    ) {
        super(element);
        this.aside = new ArtistAside(asideElement);
        const btn = element.getElementsByClassName('btn')[0];
        btn.addEventListener('click', this.aside.show.bind(element, this));
    }
}