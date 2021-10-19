<?php
// src/Entity/Category.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="categories")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Article $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addCategory($this);
        }

        return $this;
    }

    public function removeCategory(Article $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeCategory($this);
        }

        return $this;
    }
}