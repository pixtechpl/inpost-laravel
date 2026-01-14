<?php

namespace Pixtech\InPost\ShipX\Models;

use InvalidArgumentException;

class Receiver
{
	private ?string $company_name;
	private ?string $first_name;
	private ?string $last_name;
	private string $phone;
	private string $email;
    private Address $address;

    public function __construct(?string $company_name, ?string $first_name, ?string $last_name, string $email, string $phone, ?Address $address)
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
		$this->validateReceiver();

        return [
            'company_name' => $this->company_name ?? null,
            'first_name' => $this->first_name ?? null,
            'last_name' => $this->last_name ?? null,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => isset($this->address) ? $this->address->toArray() : null,
        ];
    }

	/**
	 * Validate receiver.
	 */
	public function validateReceiver(): void
	{
		if(is_null($this->company_name) && (is_null($this->first_name) || is_null($this->last_name))) {
			throw new InvalidArgumentException('You have to set company name or first name and last name');
		}
	}
}