<?php
interface Facturable
{
    public function getType();
    public function getTotalPrice();
    public function getAllDates();
}