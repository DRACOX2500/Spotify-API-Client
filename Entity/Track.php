<?php
namespace App\Entity;

class Track
{

    /**
     * @param Artist[] $artists
     * @param string[] $availableMarkets
     * @param int $discNumber
     * @param int $durationMs
     * @param bool $explicit
     * @param ExternalUrl $externalUrls
     * @param string $href
     * @param string $id
     * @param bool $isLocal
     * @param string $name
     * @param |null $previewUrl
     * @param int $trackNumber
     * @param string $type
     * @param string $uri
     */
    public function __construct(
        private array $artists,
        private array $availableMarkets,
        private int $discNumber,
        private int $durationMs,
        private bool $explicit,
        private ExternalUrl $externalUrls,
        private string $href,
        private string $id,
        private bool $isLocal,
        private string $name,
        private $previewUrl,
        private int $trackNumber,
        private string $type,
        private string $uri,
    )
    {
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
    public function getId(): string
    {
        return $this->id;
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
     * @param string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
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
            $data['explicit'],
            ExternalUrl::fromJson($data['external_urls']),
            $data['href'],
            $data['id'],
            $data['is_local'],
            $data['name'],
            $data['preview_url'] ?? null,
            $data['track_number'],
            $data['type'],
            $data['uri']
        );
    }
}
