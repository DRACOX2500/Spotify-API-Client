<?php

namespace App\Entity;

class Artist
{

    public function __construct(
        private ExternalUrl $externalUrl,
        private ?Follower    $follower,
        private ?array       $genres,
        private string      $href,
        private string      $id,
        private ?array       $image,
        private string      $name,
        private ?int         $popularity,
        private string      $type,
        private string      $uri,
    )
    {
    }

    /**
     * @return ExternalUrl
     */
    public function getExternalUrl(): ExternalUrl
    {
        return $this->externalUrl;
    }

    /**
     * @param ExternalUrl $externalUrl
     */
    public function setExternalUrl(ExternalUrl $externalUrl): void
    {
        $this->externalUrl = $externalUrl;
    }

    /**
     * @return Follower
     */
    public function getFollower(): Follower
    {
        return $this->follower;
    }

    /**
     * @param Follower $follower
     */
    public function setFollower(Follower $follower): void
    {
        $this->follower = $follower;
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
     * @return Image[]
     */
    public function getImage(): array
    {
        return $this->image;
    }

    /**
     * @param Image[] $image
     */
    public function setImage(array $image): void
    {
        $this->image = $image;
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

    /**
     * @param array $data
     * @return self
     */
    public static function fromJson(array $data): self
    {
        return new self(
            ExternalUrl::fromJson($data['external_urls']),
            isset($data['followers']) ? Follower::fromJson($data['followers']) : null,
            isset($data['genres']) ? $data['genres'] : null,
            $data['href'],
            $data['id'],
            isset($data['images']) ? array_map(static function($data) {
                return Image::fromJson($data);
            }, $data['images']) : null,
            $data['name'],
            isset($data['popularity']) ? $data['popularity'] : null,
            $data['type'],
            $data['uri']
        );
    }
}