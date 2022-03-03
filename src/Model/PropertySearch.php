<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $specifications;

    /**
     * @var float|null
     */
    private $lat;

    /**
     * @var float|null
     */
    private $lng;

    /**
     * @var integer|null
     */
    private $distance;

    public function __construct()
    {
        $this->specifications = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     */
    public function setMaxPrice(int $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     */
    public function setMinSurface(int $minSurface): void
    {
        $this->minSurface = $minSurface;
    }

    /**
     * @return ArrayCollection
     */
    public function getSpecifications(): ArrayCollection
    {
        return $this->specifications;
    }

    /**
     * @param ArrayCollection $specifications
     */
    public function setSpecifications(ArrayCollection $specifications): void
    {
        $this->specifications = $specifications;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     */
    public function setLat(?float $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     */
    public function setLng(?float $lng): void
    {
        $this->lng = $lng;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     */
    public function setDistance(?int $distance): void
    {
        $this->distance = $distance;
    }


}