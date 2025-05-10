<?php
declare(strict_types=1);



interface Marketable
{
    public function getName(): string;
    public function getPrice(): float;
    public function getDetails(): string;

}