<?php
namespace App\Entity;

class Track extends Model
{

    /**
     * @param Artist[] $artists
     * @param string[] $availableMarkets
     * @param int $discNumber
     * @param int $durationMs
     * @param ExternalUrl $externalUrls
     * @param string $href
     * @param string $idSpotify
     * @param string $name
     * @param string|null $previewUrl
     * @param int $trackNumber
     * @param string $type
     * @param string $uri
     */
    public function __construct(
        public array       $artists,
        public array       $availableMarkets,
        public int         $discNumber,
        public int         $durationMs,
        public ExternalUrl $externalUrls,
        public string      $href,
        public string      $idSpotify,
        public string      $name,
        public ?string     $previewUrl,
        public int         $trackNumber,
        public string      $type,
        public string      $uri,
    )
    {
        $this->table = 'track';
    }

    public static function getDefaultInstance(): self
    {
        return new Track(
            array(),
            array(),
            0,
            0,
            new ExternalUrl(''),
            '',
            '',
            '',
            null,
            0,
            '',
            '',
            ''
        );
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
     * @return int
     */
    public function getDiscNumber(): int
    {
        return $this->discNumber;
    }

    /**
     * @return int
     */
    public function getDurationMs(): int
    {
        return $this->durationMs;
    }

    /**
     * @return bool
     */
    public function getExplicit(): bool
    {
        return $this->explicit;
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
     * @return bool
     */
    public function getIsLocal(): bool
    {
        return $this->isLocal;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPreviewUrl(): mixed
    {
        return $this->previewUrl;
    }

    /**
     * @return int
     */
    public function getTrackNumber(): int
    {
        return $this->trackNumber;
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
     * @param int $discNumber
     * @return self
     */
    public function setDiscNumber(int $discNumber): self
    {
        $this->discNumber = $discNumber;
        return $this;
    }

    /**
     * @param int $durationMs
     * @return self
     */
    public function setDurationMs(int $durationMs): self
    {
        $this->durationMs = $durationMs;
        return $this;
    }

    /**
     * @param bool $explicit
     * @return self
     */
    public function setExplicit(bool $explicit): self
    {
        $this->explicit = $explicit;
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
     * @param bool $isLocal
     * @return self
     */
    public function setIsLocal(bool $isLocal): self
    {
        $this->isLocal = $isLocal;
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
     * @param mixed $previewUrl
     * @return self
     */
    public function setPreviewUrl(mixed $previewUrl): self
    {
        $this->previewUrl = $previewUrl;
        return $this;
    }

    /**
     * @param int $trackNumber
     * @return self
     */
    public function setTrackNumber(int $trackNumber): self
    {
        $this->trackNumber = $trackNumber;
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
            array_map(static function($data) {
                return Artist::fromJson($data);
            }, $data['artists']),
            $data['available_markets'],
            $data['disc_number'],
            $data['duration_ms'],
            ExternalUrl::fromJson($data['external_urls']),
            $data['href'],
            $data['id'],
            $data['name'],
            $data['preview_url'] ?? null,
            $data['track_number'],
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
        return new self(
            array_map(static function($data) {
                return Artist::fromDB($data);
            }, json_decode($object->artists)),
            json_decode($object->availableMarkets, true),
            $object->discNumber,
            $object->durationMs,
            ExternalUrl::fromDB(json_decode($object->externalUrls)),
            $object->href,
            $object->idSpotify,
            $object->name,
            $object->previewUrl ?? null,
            $object->trackNumber,
            $object->type,
            $object->uri
        );
    }
}
