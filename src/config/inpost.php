<?php
return [
	'use_sandbox' => (bool) env('INPOST_USE_SANDBOX', false),
    'api_key' => env('INPOST_API_KEY', ''),
    'production_url' => env('INPOST_API_URL', 'https://api-shipx-pl.easypack24.net'),
    'sandbox_url' => env('INPOST_SANDBOX_URL', 'https://sandbox-api-shipx-pl.easypack24.net'),
	'organization_id' => (int) env('INPOST_ORGANIZATION_ID', 0),

	/**
	 * Cache time
	 */
    'cache_time' => env('INPOST_CACHE_DEFAULT_TTL', 86400),
];