<?php

namespace App\Entity;

class ArtistSearch
{

    public function __construct(
        private string $hrefs,
        private array $items,
        private int $limit,
        private $next,
        private int $offset,
        private $previous,
        private int $total,
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
     * @return Artist[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param int $index
     * @return Artist
     */
    public function getItemByID(int $index): Artist
    {
        return $this->items[$index];
    }

    /**
     * @param Artist[] $items
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

    public static function fromJson(array $data): self
	{
		return new self(
			$data['href'],
            array_map(static function($data) {
                return Artist::fromJson($data);
            }, $data['items']),
			$data['limit'],
			$data['next'] ?? null,
			$data['offset'],
			$data['previous'] ?? null,
			$data['total']
		);
	}

    public function toHTML(?string $class = ""): string {
        $divs = '';
        for ($i = 0; $i < count($this->getItems()); $i++) {
            $image = "/assets/spotify.jpg";
            if (count($this->getItemByID($i)->getImage()) > 0) {
                $image = $this->getItemByID($i)->getImage()[0]->getUrl();
            }

            $divs .= '<div class="col">
                <div id="'.$this->getItemByID($i)->getId().'" class="card '.$class.'" style="width: 18rem;">
                    <img src="'. $image .'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">'.$this->getItemByID($i)->getName().'</h5>
                        <p class="card-text text-secondary fs-5">
                            '.ucfirst($this->getItemByID($i)->getType()).'
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