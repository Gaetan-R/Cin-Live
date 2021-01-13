<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
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
    private $Schedule;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, inversedBy="sessions")
     */
    private $film;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, mappedBy="session")
     */
    private $groupsss;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="session")
     */
    private $users;


    public function __construct()
    {
        $this->film = new ArrayCollection();
        $this->groupsss = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?string
    {
        return $this->Schedule;
    }

    public function setSchedule(string $Schedule): self
    {
        $this->Schedule = $Schedule;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film[] = $film;
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        $this->film->removeElement($film);

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroupsss(): Collection
    {
        return $this->groupsss;
    }

    public function addGroupsss(Group $groupsss): self
    {
        if (!$this->groupsss->contains($groupsss)) {
            $this->groupsss[] = $groupsss;
            $groupsss->addSession($this);
        }

        return $this;
    }

    public function removeGroupsss(Group $groupsss): self
    {
        if ($this->groupsss->removeElement($groupsss)) {
            $groupsss->removeSession($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addSession($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeSession($this);
        }

        return $this;
    }

}
