<?php

namespace App\Entity;

class Follower
{

    public function __construct(
        public ?string $href,
        public int $total,
    )
    {
    }

    /**
     * @return string|null
     */
    public function getHref(): ?string
    {
        return $this->href;
    }

    /**
     * @param string|null $href
     */
    public function setHref(?string $href): void
    {
        $this->href = $href;
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
	 * @return self
	 */
	public static function fromJson(array $data): self
	{
		return new self(
			$data['href'] ?? null,
			$data['total']
		);
	}

    /**
     * @param \stdClass $object
     * @return self
     */
    public static function fromDB(\stdClass $object): self
    {
        return new self(
            $object->href ?? null,
            $object->total
        );
    }
}