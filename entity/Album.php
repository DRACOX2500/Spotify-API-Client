<?php

namespace App\Entity;

class Album
{
    /**
     * @param string $albumGroup
     * @param string $albumType
     * @param Artist[] $artists
     * @param string[] $availableMarkets
     * @param ExternalUrl $externalUrls
     * @param string $href
     * @param string $id
     * @param Image[] $images
     * @param string $name
     * @param string $releaseDate
     * @param string $releaseDatePrecision
     * @param int $totalTracks
     * @param string $type
     * @param string $uri
     */
    public function __construct(
        private string $albumGroup,
        private string $albumType,
        private array $artists,
        private array $availableMarkets,
        private ExternalUrl $externalUrls,
        private string $href,
        private string $id,
        private array $images,
        private string $name,
        private string $releaseDate,
        private string $releaseDatePrecision,
        private int $totalTracks,
        private string $type,
        private string $uri,
    )
    {
    }

    /**
     * @return string
     */
    public function getAlbumGroup(): string
    {
        return $this->albumGroup;
    }

    /**
     * @return string
     */
    public function getAlbumType(): string
    {
        return $this->albumType;
    }

    /**
     * @return Artist[]
     */
    public function getArtists(): array
    {
        return $this->artists;
    }

    /**
     * @return string[]
     */
    public function getAvailableMarkets(): array
    {
        return $this->availableMarkets;
    }

    /**
     * @return ExternalUrl
     */
    public function getExternalUrls(): ExternalUrl
    {
        return $this->externalUrls;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Image[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @return string
     */
    public function getReleaseDatePrecision(): string
    {
        return $this->releaseDatePrecision;
    }

    /**
     * @return int
     */
    public function getTotalTracks(): int
    {
        return $this->totalTracks;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $albumGroup
     * @return self
     */
    public function setAlbumGroup(string $albumGroup): self
    {
        $this->albumGroup = $albumGroup;
        return $this;
    }

    /**
     * @param string $albumType
     * @return self
     */
    public function setAlbumType(string $albumType): self
    {
        $this->albumType = $albumType;
        return $this;
    }

    /**
     * @param Artist[] $artists
     * @return self
     */
    public function setArtists(array $artists): self
    {
        $this->artists = $artists;
        return $this;
    }

    /**
     * @param string[] $availableMarkets
     * @return self
     */
    public function setAvailableMarkets(array $availableMarkets): self
    {
        $this->availableMarkets = $availableMarkets;
        return $this;
    }

    /**
     * @param ExternalUrl $externalUrls
     * @return self
     */
    public function setExternalUrls(ExternalUrl $externalUrls): self
    {
        $this->externalUrls = $externalUrls;
        return $this;
    }

    /**
     * @param string $href
     * @return self
     */
    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param Image[] $images
     * @return self
     */
    public function setImages(array $images): self
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $releaseDate
     * @return self
     */
    public function setReleaseDate(string $releaseDate): self
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @param string $releaseDatePrecision
     * @return self
     */
    public function setReleaseDatePrecision(string $releaseDatePrecision): self
    {
        $this->releaseDatePrecision = $releaseDatePrecision;
        return $this;
    }

    /**
     * @param int $totalTracks
     * @return self
     */
    public function setTotalTracks(int $totalTracks): self
    {
        $this->totalTracks = $totalTracks;
        return $this;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $uri
     * @return self
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
            $data['album_group'],
            $data['album_type'],
            array_map(static function($data) {
                return Artist::fromJson($data);
            }, $data['artists']),
            $data['available_markets'],
            ExternalUrl::fromJson($data['external_urls']),
            $data['href'],
            $data['id'],
            array_map(static function($data) {
                return Image::fromJson($data);
            }, $data['images']),
            $data['name'],
            $data['release_date'],
            $data['release_date_precision'],
            $data['total_tracks'],
            $data['type'],
            $data['uri']
        );
    }
}