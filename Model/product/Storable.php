<?php
declare(strict_types=1);




interface Storable
{
    public function getLocation(): string;
    public function getStock(): int;
    public function getWidth(): float;
}