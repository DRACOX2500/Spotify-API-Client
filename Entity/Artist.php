<?php
namespace App\Entity;

use App\Entity\ExternalUrl;
use App\Entity\Follower;
use App\Entity\Image;

class Item
{

    private ExternalUrl $external_urls;
    private Follower $followers;

    public function __construct(
        $external_urls,
        $followers,
        private array $genres,
        private string $href,
        private string $id,
        private array $images,
        private string $name,
        private int $popularity,
        private string $type,
        private string $uri,
    )
    {
        $this->external_urls = ExternalUrl::fromJson($external_urls);
        $this->followers = Follower::fromJson($followers);
    }

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
     * @return Image[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param Image[] $images
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

    public static function fromJson(\stdClass $data): self
	{
		return new self(
			ExternalUrl::fromJson($data->external_urls),
			Follower::fromJson($data->followers),
			$data->genres,
			$data->href,
			$data->id,
			array_map(static function($data) {
				return Image::fromJson($data);
			}, $data->images),
			$data->name,
			$data->popularity,
			$data->type,
			$data->uri
		);
	}
}