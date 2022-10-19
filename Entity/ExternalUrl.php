<?php

namespace App\Entity;

class ExternalUrl
{

    public function __construct(
        public string $spotify,
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
}