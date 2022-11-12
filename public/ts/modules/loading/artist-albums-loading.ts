import {Loading} from "./_loading";

export class ArtistAlbumsLoading extends Loading {

    protected content = '<div class="absolute-loading"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'

    constructor(
        public parentElement: HTMLElement
    )
    {
        super(parentElement);
    }
}