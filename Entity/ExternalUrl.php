<?php

namespace App\Entity;

class ExternalUrl
{

    public function __construct(
        private string $spotify,
    )
    {
    }

    /**
     * @return string
     */
    public function getSpotify(): string
    {
        return $this->spotify;
    }

    /**
     * @param string $spotify
     */
    public function setSpotify(string $spotify): void
    {
        $this->spotify = $spotify;
    }

    /**
	 * @param array $data
	 * @return self
	 */
	public static function fromJson(array $data): self
	{
		return new self(
			$data['spotify']
		);
	}
}