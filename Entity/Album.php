<?php

namespace App\Entity;

class Album extends Model
{

    /**
     * @var Track[]
     */
    private array $tracks;

    /**
     * @param string|null $albumGroup
     * @param string $albumType
     * @param Artist[] $artists
     * @param string[] $availableMarkets
     * @param Copyright[]|null $copyrights
     * @param array|null $externalIds
     * @param ExternalUrl $externalUrls
     * @param array|null $genres
     * @param string $href
     * @param string $idSpotify
     * @param array $images
     * @param string|null $label
     * @param string $name
     * @param int|null $popularity
     * @param string $releaseDate
     * @param string $releaseDatePrecision
     * @param int $totalTracks
     * @param string $type
     * @param string $uri
     */
    public function __construct(
        public ?string     $albumGroup,
        public string      $albumType,
        public array       $artists,
        public array       $availableMarkets,
        public ?array      $copyrights,
        public ?array      $externalIds,
        public ExternalUrl $externalUrls,
        public ?array      $genres,
        public string      $href,
        public string      $idSpotify,
        public array       $images,
        public ?string     $label,
        public string      $name,
        public ?int        $popularity,
        public string      $releaseDate,
        public string      $releaseDatePrecision,
        public int         $totalTracks,
        public string      $type,
        public string      $uri,
    )
    {
        $this->table = 'album';
    }

    public static function getDefaultInstance(): self
    {
        return new Album(
            null,
            '',
            array(),
            array(),
            null,
            null,
            new ExternalUrl(''),
            null,
            '',
            '',
            array(),
            null,
            '',
            0,
            '',
            '',
            0,
            '',
            ''
        );
    }

    /**
     * @return array|null
     */
    public function getCopyrights(): ?array
    {
        return $this->copyrights;
    }

    /**
     * @param array|null $copyrights
     * @return Album
     */
    public function setCopyrights(?array $copyrights): self
    {
        $this->copyrights = $copyrights;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getExternalIds(): ?array
    {
        return $this->externalIds;
    }

    /**
     * @param array|null $externalIds
     * @return Album
     */
    public function setExternalIds(?array $externalIds): self
    {
        $this->externalIds = $externalIds;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getGenres(): ?array
    {
        return $this->genres;
    }

    /**
     * @param array|null $genres
     * @return Album
     */
    public function setGenres(?array $genres): self
    {
        $this->genres = $genres;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return Album
     */
    public function setLabel(?string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    /**
     * @param int|null $popularity
     * @return Album
     */
    public function setPopularity(?int $popularity): self
    {
        $this->popularity = $popularity;
        return $this;
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
    public function getIdSpotify(): string
    {
        return $this->idSpotify;
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
     * @param string $idSpotify
     * @return self
     */
    public function setIdSpotify(string $idSpotify): self
    {
        $this->idSpotify = $idSpotify;
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
     * @return Track[]
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }

    /**
     * @param Track[] $tracks
     * @return Album
     */
    public function setTracks(array $tracks): self
    {
        $this->tracks = $tracks;
        return $this;
    }

    /**
     * @param array $data
     * @return Album
     */
    public function setTracksFromJson(array $data): self
    {
        $this->tracks = array_map(static function($item) {
            return Track::fromJson($item);
        }, $data);
        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['album_group'] ?? null,
            $data['album_type'],
            array_map(static function($data) {
                return Artist::fromJson($data);
            }, $data['artists']),
            $data['available_markets'],
                isset($data['copyrights']) ? array_map(static function($data) {
                    return Copyright::fromJson($data);
                }, $data['copyrights']) : null,
            $data['genres'] ?? null,
            ExternalUrl::fromJson($data['external_urls']),
            $data['genres'] ?? null,
            $data['href'],
            $data['id'],
            array_map(static function($data) {
                return Image::fromJson($data);
            }, $data['images']),
                $data['label'] ?? null,
            $data['name'],
                $data['popularity'] ?? null,
            $data['release_date'],
            $data['release_date_precision'],
            $data['total_tracks'],
            $data['type'],
            $data['uri']
        );
    }
}