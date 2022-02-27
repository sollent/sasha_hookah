<?php

namespace App\Model;

class Order
{
    public int $count;

    public ?bool $insiderCity = null;

    public ?int $countAdditionalMixes = null;

    public string $phoneNumber;

    public string $address;

    public string $date;

    public string $time;
}