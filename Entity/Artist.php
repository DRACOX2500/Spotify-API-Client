<?php
namespace App\Entity;

use App\Entity\Item;

class Artist
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
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function getItemByID(int $index): Item
    {
        $item = new Item(
            $this->items[$index]['external_urls'],
            $this->items[$index]['followers'],
            $this->items[$index]['genres'],
            $this->items[$index]['href'],
            $this->items[$index]['id'],
            $this->items[$index]['images'],
            $this->items[$index]['name'],
            $this->items[$index]['popularity'],
            $this->items[$index]['type'],
            $this->items[$index]['uri']
        );
        if ($item == null) {
            throw new \Exception('Invalid index, item does not exist');
        }
        return $item;
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
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next): void
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
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param mixed $previous
     */
    public function setPrevious($previous): void
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

    public function display(): string {
        $divs = '';
        for ($i = 0; $i < count($this->getItems()); $i++) {
            $image = $this->getItemByID(0)->getImages()[0]['url'];
            $name = $this->getItems()[0]['name'];
            $divs .= '<div class="card" style="width: 18rem;">
                <img src="'.$this->getItems()[$i]['images'][0]['url'].'" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">'.$this->getItems()[$i]['name'].'</h5>
                        <p class="card-text">
                            <span>Popularity</span>
                            '.$this->getItems()[$i]['popularity'].'
                        </p>
                        <p class="card-text">
                            <span>Type</span>
                            '.$this->getItems()[$i]['type'].'
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>';
        }
        return $divs;
    }

}