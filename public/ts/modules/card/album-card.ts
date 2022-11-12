import {Card} from "./_card";
import {AlbumAside} from "../aside/album-aside";

export class AlbumCard extends Card<'album'> {

    public aside: AlbumAside;

    constructor(
        element: HTMLElement,
        public asideElement: HTMLElement,
    ) {
        super(element);
        this.aside = new AlbumAside(asideElement);
        const btn = element.getElementsByClassName('btn')[0];
        btn.addEventListener('click', this.aside.show.bind(element, this));
    }
}