<?php

namespace Pixtech\InPost\ShipX\Classes;

use Pixtech\InPost\ShipX\Traits\functions;

class Api
{
    use functions;

	protected string $apiKey;
	protected string $apiUrl;
	protected string $organizationId;

    public function __construct() {
		$this->apiKey = config('inpost.api_key');
		$this->apiUrl = config('inpost.use_sandbox') ? config('inpost.sandbox_url') : config('inpost.production_url');
		$this->organizationId = config('inpost.organization_id');
    }
}