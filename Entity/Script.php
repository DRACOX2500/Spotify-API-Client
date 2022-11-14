<?php

namespace App\Entity;

class Script
{

    /**
     * @param string|null $source
     * @param string|null $type
     * @param string|null $content
     * @param string|null $integrity
     * @param string|null $crossorigin
     */
    public function __construct(
        private ?string $source,
        private ?string $type,
        private ?string $content,
        private ?string $integrity,
        private ?string $crossorigin,
    )
    {
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return Script
     */
    public function setSource(string $source): Script
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Script
     */
    public function setType(string $type): Script
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIntegrity(): ?string
    {
        return $this->integrity;
    }

    /**
     * @param string|null $integrity
     * @return Script
     */
    public function setIntegrity(?string $integrity): Script
    {
        $this->integrity = $integrity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCrossorigin(): ?string
    {
        return $this->crossorigin;
    }

    /**
     * @param string|null $crossorigin
     * @return Script
     */
    public function setCrossorigin(?string $crossorigin): Script
    {
        $this->crossorigin = $crossorigin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Script
     */
    public function setContent(?string $content): Script
    {
        $this->content = $content;
        return $this;
    }


}