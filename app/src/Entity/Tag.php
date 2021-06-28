<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="tags")
     */
    private $ManyToMany;

    public function __construct()
    {
        $this->ManyToMany = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getManyToMany(): Collection
    {
        return $this->ManyToMany;
    }

    public function addManyToMany(Item $manyToMany): self
    {
        if (!$this->ManyToMany->contains($manyToMany)) {
            $this->ManyToMany[] = $manyToMany;
        }

        return $this;
    }

    public function removeManyToMany(Item $manyToMany): self
    {
        $this->ManyToMany->removeElement($manyToMany);

        return $this;
    }
}
