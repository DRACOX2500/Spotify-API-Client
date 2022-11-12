export class AudioPlayerService {

    private static audioPlayer = new Audio();
    private static timeout: NodeJS.Timeout | null = null;

    private static autoPause() {
        if (AudioPlayerService.timeout) {
            clearTimeout(
                AudioPlayerService.timeout
            );
        }
        AudioPlayerService.timeout =
            setTimeout(() => {
                AudioPlayerService.pause();
                AudioPlayerService.timeout = null;
            }, 30000);
    }

    static get source(): string {
        return AudioPlayerService.audioPlayer.src
    }

    static play(srcURL: string): void {
        if (srcURL === '#') return
        const player = AudioPlayerService.audioPlayer;

        if (player.paused || player.src !== srcURL) {
            if (player.src !== srcURL)
                player.src = srcURL

            player.play().then(() => {
                // btnElement.lastElementChild.classList.remove('d-none')
                // btnElement.firstElementChild.classList.add('d-none')
            })
            AudioPlayerService.autoPause()
        }
        else {
            AudioPlayerService.pause()
        }
    }

    static pause() {
        AudioPlayerService.audioPlayer.pause()
        // btnElement.lastElementChild.classList.add('d-none')
        // btnElement.firstElementChild.classList.remove('d-none')
    }
}