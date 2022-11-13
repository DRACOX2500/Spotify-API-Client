<?php

namespace App\Entity;

class Artist extends Model
{

    public function __construct(
        public ExternalUrl $externalUrl,
        public ?Follower   $follower,
        public ?array      $genres,
        public string      $href,
        public string      $idSpotify,
        public ?array      $image,
        public string      $name,
        public ?int        $popularity,
        public string      $type,
        public string      $uri,
    )
    {
        $this->table = "artist";
    }

    public static function getDefaultInstance(): self
    {
            return new Artist(
                new ExternalUrl(''),
                null,
                null,
                '',
                '',
                null,
                '',
                null,
                '',
                ''
            );
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
     * @return Artist
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
     * @return Artist
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
     * @return Artist
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
     * @return Artist
     */
    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdSpotify(): string
    {
        return $this->idSpotify;
    }

    /**
     * @param string $idSpotify
     * @return Artist
     */
    public function setIdSpotify(string $idSpotify): self
    {
        $this->idSpotify = $idSpotify;
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
     * @return Artist
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
     * @return Artist
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
     * @return Artist
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
            $data['genres'] ?? null,
            $data['href'],
            $data['id'],
            isset($data['images']) ? array_map(static function($data) {
                return Image::fromJson($data);
            }, $data['images']) : null,
            $data['name'],
            $data['popularity'] ?? null,
            $data['type'],
            $data['uri']
        );
    }

    /**
     * @param \stdClass $object
     * @return self
     */
    public static function fromDB(\stdClass $object): self
    {
        $externalUrl = is_string($object->externalUrl) ? json_decode($object->externalUrl) : $object->externalUrl;
        $followers = is_string($object->follower) ? json_decode($object->follower) : $object->follower;
        $genres = is_string($object->genres) ? json_decode($object->genres) : $object->genres;
        $images = is_string($object->image) ? json_decode($object->image) : $object->image;

        return new self(
            ExternalUrl::fromDB($externalUrl),
            isset($object->follower) ? Follower::fromDB($followers) : null,
            $genres ?? null,
            $object->href,
            $object->idSpotify,
            isset($object->image) ? array_map(static function($data) {
                return Image::fromDB($data);
            }, $images) : null,
            $object->name,
            $object->popularity ?? null,
            $object->type,
            $object->uri
        );
    }
}