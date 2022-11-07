<?php

namespace App\Entity;

class Artist extends Model
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
    public function setExternalUrl(ExternalUrl $externalUrl): self
    {
        $this->externalUrl = $externalUrl;
        return $this;
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
    public function setFollower(Follower $follower): self
    {
        $this->follower = $follower;
        return $this;
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
    public function setGenres(array $genres): self
    {
        $this->genres = $genres;
        return $this;
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
    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
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
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
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
    public function setImage(array $image): self
    {
        $this->image = $image;
        return $this;
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
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
    public function setPopularity(int $popularity): self
    {
        $this->popularity = $popularity;
        return $this;
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
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
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
    public function setUri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
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