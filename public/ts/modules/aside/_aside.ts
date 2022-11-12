import { Offcanvas } from 'bootstrap';

export abstract class Aside {

    protected offCanvas!: Offcanvas;

    protected constructor(
        protected asideElement: HTMLElement
    )
    {
        this.offCanvas = new Offcanvas(asideElement);
    }

    abstract show(...args: any[]): void;
    abstract hide(): void;
}