<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Invitation;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
     * One user send many invitations. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Invitation", mappedBy="sender")
     */
    private $invit_sent;

      /**
     * One user receive many invitations. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Invitation", mappedBy="recipient")
     *
     */
    private $invit_received;


     public function __construct(){
         $this->invit_sent     = new \Doctrine\Common\Collections\ArrayCollection();
         $this->invit_received = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Collection|Invitation[]
     */
    public function getInvitSent(): Collection
    {
        return $this->invit_sent;
    }

    public function addInvitSent(Invitation $invitSent): self
    {
        if (!$this->invit_sent->contains($invitSent)) {
            $this->invit_sent[] = $invitSent;
            $invitSent->setSender($this);
        }

        return $this;
    }

    public function removeInvitSent(Invitation $invitSent): self
    {
        if ($this->invit_sent->removeElement($invitSent)) {
            // set the owning side to null (unless already changed)
            if ($invitSent->getSender() === $this) {
                $invitSent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invitation[]
     */
    public function getInvitReceived(): Collection
    {
        return $this->invit_received;
    }

    public function addInvitReceived(Invitation $invitReceived): self
    {
        if (!$this->invit_received->contains($invitReceived)) {
            $this->invit_received[] = $invitReceived;
            $invitReceived->setRecipient($this);
        }

        return $this;
    }

    public function removeInvitReceived(Invitation $invitReceived): self
    {
        if ($this->invit_received->removeElement($invitReceived)) {
            // set the owning side to null (unless already changed)
            if ($invitReceived->getRecipient() === $this) {
                $invitReceived->setRecipient(null);
            }
        }

}
}
