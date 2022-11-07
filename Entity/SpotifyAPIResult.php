<?php

namespace App\Entity;

use App\Core\Utils;

class SpotifyAPIResult
{

    public function __construct(
        private string $hrefs,
        private array  $items,
        private int    $limit,
        private        $next,
        private int    $offset,
        private        $previous,
        private int    $total,
    )
    {
    }

    /**
     * @return string
     */
    public function getHrefs(): string
    {
        return $this->hrefs;
    }

    /**
     * @param string $hrefs
     */
    public function setHrefs(string $hrefs): void
    {
        $this->hrefs = $hrefs;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param int $index
     * @return array
     */
    public function getItemByID(int $index): mixed
    {
        return $this->items[$index];
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getNext(): mixed
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext(mixed $next): void
    {
        $this->next = $next;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return mixed
     */
    public function getPrevious(): mixed
    {
        return $this->previous;
    }

    /**
     * @param mixed $previous
     */
    public function setPrevious(mixed $previous): void
    {
        $this->previous = $previous;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['href'],
            array_map(static function ($data) {
                return Artist::fromJson($data);
            }, $data['items']),
            $data['limit'],
            $data['next'] ?? null,
            $data['offset'],
            $data['previous'] ?? null,
            $data['total']
        );
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromJsonAlbum(array $data): self
    {
        return new self(
            $data['href'],
            array_map(static function ($data) {
                return Album::fromJson($data);
            }, $data['items']),
            $data['limit'],
            $data['next'] ?? null,
            $data['offset'],
            $data['previous'] ?? null,
            $data['total']
        );
    }

    public function toHTMLAlbum(?string $class = ""): string
    {
        $divs = '';
        for ($i = 0; $i < count($this->getItems()); $i++) {

            /** @var Album $album */
            $album = $this->getItems()[$i];

            $divTracks = '';
            for ($j = 0; $j < count($album->getTracks()); $j++) {
                $track = $album->getTracks()[$j];
                $artistName = $track->getArtists()[0]->getName() ?? 'no-body';
                $artistUrl = $track->getArtists()[0]->getExternalUrl()->getSpotify() ?? '#';

                $divTracks .= '<div class="d-flex bg-main-darker flex-row align-item-center justify-content-between rounded py-1 px-5 my-2">
                                    <span class="badge text-dark bg-secondary px-2 mx-2">#'.($j + 1).'</span>
                                    <div class="d-flex flex-column justify-content-between">
                                        <a class="link-light" href="'.$track->getExternalUrls()->getSpotify().'" target="_blank">'.$track->getName().'</a>
                                        <a class="link-secondary" href="'.$artistUrl.'" target="_blank">'.$artistName.'</a>
                                    </div>
                                    <p>
                                        '.$album->getName().'
                                    </p>
                                    <span>
                                        <i class="bi bi-clock px-2"></i>
                                        '.Utils::millisecondToMinSecFormat($track->getDurationMs()).'
                                    </span>
                                </div>';
            }

            $divs .= '<div class="accordion-item bg-main">
                        <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$i.'" aria-expanded="true" aria-controls="collapse-'.$i.'">
                                <span class="badge text-dark bg-main-darker px-2 mx-2">#'.($i + 1).'</span>
                                '.$album->getName().'
                              </button>
                        </h2>
                        <div id="collapse-'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                    <div class="album-data">
                                        <img src="'.$album->getImages()[0]->getUrl().'" alt="album_picture">
                                        <div>
                                             <span class="al-type text-light">'.strtoupper($album->getAlbumType()).'</span>
                                             <span class="al-name text-light">'.$album->getName().'</span>
                                             <span>
                                                '.$album->getReleaseDate().'
                                                •
                                                '.$album->getTotalTracks().' tracks
                                             </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                         '.$divTracks.'
                                    </div>
                              </div>
                        </div>
                  </div>';
        }
        return $divs;
    }

    public function toHTML(?string $class = ""): string
    {
        $divs = '';
        for ($i = 0; $i < count($this->getItems()); $i++) {
            $image = "/assets/spotify.jpg";
            if (count($this->getItemByID($i)->getImage()) > 0) {
                $image = $this->getItemByID($i)->getImage()[0]->getUrl();
            }

            $divs .= '<div class="col">
                <div id="' . $this->getItems()[$i]->getIdSpotify() . '" class="card ' . $class . '" style="width: 18rem;">
                    <img src="' . $image . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">' . $this->getItemByID($i)->getName() . '</h5>
                        <p class="card-text text-secondary fs-5">
                            ' . ucfirst($this->getItemByID($i)->getType()) . '
                        </p>
                        <button type="button"
                            href="#"
                            class="btn bg-secondary stretched-link w-75 d-flex flex-row align-items-center card-btn">
                            <i class="bi bi-plus-square-fill p-2"></i>
                            More details...
                        </button>
                    </div>
                </div>
            </div>';
        }
        return $divs;
    }

}