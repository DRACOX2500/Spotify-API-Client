<?php
namespace App\Entity;

use App\ExternalUrl\ExternalUrl;
use App\Follower\Follower;

class Item {

    public function __construct(
        public ExternalUrl $external_urls,
        public Follower $followers,
        public array $genres,
        public string $href,
        public string $id,
        public array $images,
        public string $name,
        public int $popularity,
        public string $type,
        public string $uri,
    )
    {}

    /**
     * @return ExternalUrl
     */
    public function getExternalUrls(): ExternalUrl
    {
        return $this->external_urls;
    }

    /**
     * @param ExternalUrl $external_urls
     */
    public function setExternalUrls(ExternalUrl $external_urls): void
    {
        $this->external_urls = $external_urls;
    }

    /**
     * @return Follower
     */
    public function getFollowers(): Follower
    {
        return $this->followers;
    }

    /**
     * @param Follower $followers
     */
    public function setFollowers(Follower $followers): void
    {
        $this->followers = $followers;
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param array $genres
     */
    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref(string $href): void
    {
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPopularity(): int
    {
        return $this->popularity;
    }

    /**
     * @param int $popularity
     */
    public function setPopularity(int $popularity): void
    {
        $this->popularity = $popularity;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
}