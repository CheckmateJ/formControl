<?php

namespace App\Entity;

use App\Repository\FormPanelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormPanelRepository::class)]
class FormPanel
{
    const type = ['Private person', 'Company'];
    const contactHours = ['8.00 - 12.00', '12.00 - 16.00'];
    const topic = ['Cooperation', 'Problem with product', 'Contact with accountant'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $nip = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $pesel = null;

    #[ORM\Column( type: Types::BIGINT)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255,  unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 400)]
    private ?string $streetAddress = null;

    #[ORM\Column(length: 10)]
    private ?string $localNumber = null;

    #[ORM\Column(length: 6)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 400)]
    private ?string $correspondenceAddress = null;

    #[ORM\Column(length: 10)]
    private ?string $correspondenceLocalNumber = null;

    #[ORM\Column(length: 6)]
    private ?string $correspondenceZipCode = null;

    #[ORM\Column(length: 50)]
    private ?string $contactHours = null;

    #[ORM\Column(length: 400)]
    private ?string $topic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdfFileName = null;

    #[ORM\Column(length: 255)]
    private ?string $ipAddress = null;

    #[ORM\Column(length: 500)]
    private ?string $browserName = null;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(?string $nip): self
    {
        $this->nip = $nip;

        return $this;
    }

    public function getPesel(): ?string
    {
        return $this->pesel;
    }

    public function setPesel(?string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getLocalNumber(): ?string
    {
        return $this->localNumber;
    }

    public function setLocalNumber(string $localNumber): self
    {
        $this->localNumber = $localNumber;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCorrespondenceAddress(): ?string
    {
        return $this->correspondenceAddress;
    }

    public function setCorrespondenceAddress(string $correspondenceAddress): self
    {
        $this->correspondenceAddress = $correspondenceAddress;

        return $this;
    }

    public function getCorrespondenceLocalNumber(): ?string
    {
        return $this->correspondenceLocalNumber;
    }

    public function setCorrespondenceLocalNumber(string $correspondenceLocalNumber): self
    {
        $this->correspondenceLocalNumber = $correspondenceLocalNumber;

        return $this;
    }

    public function getCorrespondenceZipCode(): ?string
    {
        return $this->correspondenceZipCode;
    }

    public function setCorrespondenceZipCode(string $correspondenceZipCode): self
    {
        $this->correspondenceZipCode = $correspondenceZipCode;

        return $this;
    }

    public function getContactHours(): ?string
    {
        return $this->contactHours;
    }

    public function setContactHours(string $contactHours): self
    {
        $this->contactHours = $contactHours;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getPdfFileName(): ?string
    {
        return $this->pdfFileName;
    }

    public function setPdfFileName(?string $pdfFileName): self
    {
        $this->pdfFileName = $pdfFileName;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getBrowserName(): ?string
    {
        return $this->browserName;
    }

    public function setBrowserName(string $browserName): self
    {
        $this->browserName = $browserName;

        return $this;
    }
}
