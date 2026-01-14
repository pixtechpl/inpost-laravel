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
    private ?Address $address;

    public function __construct(string $email, string $phone, ?string $company_name = null, ?string $first_name = null, ?string $last_name = null, ?Address $address = null)
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