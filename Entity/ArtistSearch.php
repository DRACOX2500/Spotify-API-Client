<?php
namespace App\Entity;

use App\Entity\Artist;

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
        return Artist::fromJson($this->items[$index]);
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

    public static function fromJson(\stdClass $data): self
	{
		return new self(
			$data->href,
			array_map(static function($data) {
				return Artist::fromJson($data);
			}, $data->items),
			$data->limit,
			$data->next ?? null,
			$data->offset,
			$data->previous ?? null,
			$data->total
		);
	}

    public function display(): string {
        $divs = '';
        for ($i = 0; $i < count($this->getItems()); $i++) {
            $divs .= '<div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="'.$this->getItemByID($i)->getImages()[0]['url'].'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">'.$this->getItemByID($i)->getName().'</h5>
                            <p class="card-text">
                                <span>Popularity</span>
                                '.$this->getItemByID($i)->getPopularity().'
                            </p>
                            <p class="card-text">
                                <span>Type</span>
                                '.$this->getItemByID($i)->getType().'
                            </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>';
        }
        return $divs;
    }

}