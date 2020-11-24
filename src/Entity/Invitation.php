<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use DateTime;


/**
 * @ORM\Entity(repositoryClass=InvitationRepository::class)
 */
class Invitation
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
    private $subject;
     /**
     * an invitation is sent by one user
     * @ORM\ManyToOne(targetEntity="User", inversedBy="invit_sent")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $sender;
    /**
     *  @ORM\ManyToOne(targetEntity="User", inversedBy="invit_received")
     *  @ORM\JoinColumn(name="recipient_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $recipient;

    /**
    *@ORM\Column(type="boolean")
    */
    private $accepted=false;
  /**
    *@ORM\Column(type="datetime")
    */
    private $date_sending;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    public function setRecipient(?User $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getDateSending(): ?\DateTimeInterface
    {
        return $this->date_sending;
    }

    public function setDateSending(\DateTimeInterface $date_sending): self
    {
        $this->date_sending = $date_sending;

        return $this;
    }
}
