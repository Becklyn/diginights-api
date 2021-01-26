<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi\TicketSale;

use Becklyn\DiginightsApi\Event\AgeRestriction;

class CreateTicketSaleRequest
{
    private int $overallContingent;
    private AgeRestriction $ageFrom;
    private bool $isActive;
    private string $company;
    private string $street;
    private string $zip;
    private string $city;
    private string $contactName;
    private string $contactPhone;
    private string $contactEmail;
    private string $vatNo;
    private string $iban;
    private string $bic;
    private \DateTimeImmutable $salesStart;
    private \DateTimeImmutable $salesEnd;

    public function __construct(
        int $overallContingent,
        AgeRestriction $ageFrom,
        bool $isActive,
        string $company,
        string $street,
        string $zip,
        string $city,
        string $contactName,
        string $contactPhone,
        string $contactEmail,
        string $vatNo,
        string $iban,
        string $bic,
        \DateTimeImmutable $salesStart,
        \DateTimeImmutable $salesEnd
    ) {
        $this->overallContingent = $overallContingent;
        $this->ageFrom = $ageFrom;
        $this->isActive = $isActive;
        $this->company = $company;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->contactName = $contactName;
        $this->contactPhone = $contactPhone;
        $this->contactEmail = $contactEmail;
        $this->vatNo = $vatNo;
        $this->iban = $iban;
        $this->bic = $bic;
        $this->salesStart = $salesStart;
        $this->salesEnd = $salesEnd;
    }

    public function overallContingent() : int
    {
        return $this->overallContingent;
    }

    public function ageFrom() : AgeRestriction
    {
        return $this->ageFrom;
    }

    public function isActive() : bool
    {
        return $this->isActive;
    }

    public function company() : string
    {
        return $this->company;
    }

    public function street() : string
    {
        return $this->street;
    }

    public function zip() : string
    {
        return $this->zip;
    }

    public function city() : string
    {
        return $this->city;
    }

    public function contactName() : string
    {
        return $this->contactName;
    }

    public function contactPhone() : string
    {
        return $this->contactPhone;
    }

    public function contactEmail() : string
    {
        return $this->contactEmail;
    }

    public function vatNo() : string
    {
        return $this->vatNo;
    }

    public function iban() : string
    {
        return $this->iban;
    }

    public function bic() : string
    {
        return $this->bic;
    }

    public function salesStart() : \DateTimeImmutable
    {
        return $this->salesStart;
    }

    public function salesEnd() : \DateTimeImmutable
    {
        return $this->salesEnd;
    }
}
