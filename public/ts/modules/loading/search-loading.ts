import {Loading} from "./_loading";

export class SearchLoading extends Loading {

    protected content = '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'

    constructor(
        public parentElement: HTMLElement
    )
    {
        super(parentElement, 'over');
    }
}