type CardType = 'artist' | 'album';

export abstract class Card<CardType> {

    public type!: CardType;

    protected constructor(
        public element: HTMLElement,
    ) {
    }

    get id(): string {
        return this.element.getElementsByClassName('card')[0].id ?? '';
    }

    get title(): string {
        return this.element.getElementsByClassName('card-title')[0].textContent ?? '';
    }

    static foundType(element: Element) {
        return element.firstElementChild?.classList.contains('artist-card') ? 'artist' : 'album';
    }

    static ArrayToArrayNode(cards: Card<any>[]): Node[] {
        return cards.map((item) => {
            return item.element
        })
    }

}