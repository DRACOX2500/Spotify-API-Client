export abstract class Loading {

    protected content = ''

    constructor(
        public parentElement: HTMLElement,
        private optionalClass?: string
    )
    {
    }

    show() {
        if (this.optionalClass)
            this.parentElement.classList.add(this.optionalClass);
        this.parentElement.innerHTML = this.content;
    }

    hide() {
        if (this.optionalClass)
            this.parentElement.classList.remove(this.optionalClass);
        this.parentElement.innerHTML = '';
    }
}