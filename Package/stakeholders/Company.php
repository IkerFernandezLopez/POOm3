<?php
class Comp
{
    protected string $companyType, $CompanyName;

    public function __construct($companyType, $CompanyName)
    {
        $this->companyType = $companyType;
        $this->CompanyName = $CompanyName;
    }

    public function getCompanyType(): string
    {
        return $this->companyType;
    }

    public function setCompanyType(string $companyType): void
    {
        $this->companyType = $companyType;
    }

    public function getCompanyName(): string
    {
        return $this->CompanyName;
    }

    public function setCompanyName(string $CompanyName): void
    {
        $this->CompanyName = $CompanyName;
    }
}