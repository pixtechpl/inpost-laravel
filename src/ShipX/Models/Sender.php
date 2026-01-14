<?php

namespace Pixtech\InPost\ShipX\Models;

class Sender
{
	private string $company_name;
	private string $first_name;
	private string $last_name;
	private string $phone;
	private string $email;
    private Address $address;

    public function __construct(string $company_name, string $first_name, string $last_name, string $email, string $phone, Address $address)
    {
        $this->company_name = $company_name;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    /**
     * Return array data.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'company_name' => $this->company_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address->toArray(),
        ];
    }
}