<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistsRepository")
 * @ApiResource(
 *     collectionOperations = {
 *          "get"={
 *              "method"="GET",
 *              "path"="/artists",
 *          },
 *     },
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "path"="/artist/{id}"
 *          },
 *     }
 * )
 */
class Artists
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $artistsName;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateAdd;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $thumb;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistsName(): ?string
    {
        return $this->artistsName;
    }

    public function setArtistsName(string $artistsName): self
    {
        $this->artistsName = $artistsName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(?\DateTimeInterface $dateAdd): self
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    public function setThumb(?string $thumb): self
    {
        $this->thumb = $thumb;

        return $this;
    }
}
