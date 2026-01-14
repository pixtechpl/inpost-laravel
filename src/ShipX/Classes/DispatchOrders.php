<?php

namespace Pixtech\InPost\ShipX\Classes;

use Illuminate\Http\Client\ConnectionException;
use Pixtech\InPost\ShipX\Models\Address;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class DispatchOrders extends Api
{
    private array $shipments;
	private string $comments;
	private string $office_hours;
	private string $name;
	private string $phone;
	private string $email;
    private Address $address;

    /**
     * Set shipments.
     *
     * @param array $shipments
     */
    public function setShipments(int ...$shipments): void
    {
        $this->shipments = $shipments;
    }

    /**
     * Set comments.
     *
     * @param string $comments
     */
    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * Set address.
     *
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    /**
     * Set office hours.
     *
     * @param string $office_hours
     */
    public function setOfficeHours(string $office_hours): void
    {
        $this->office_hours = $office_hours;
    }

    /**
     * Set name.
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Set email.
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

	/**
	 * Create a new dispatch orders.
	 *
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function create(bool $returnJson = false): array|string
	{
        $this->validateDispatch();

        $route = "/v1/organizations/$this->organizationId/dispatch_orders";

        $data = [
            'shipments'     => $this->shipments,
            'comments'      => $this->comments ?? null,
            'address'       => $this->address->toArray(),
            'office_hours'  => $this->office_hours ?? null,
            'name'          => $this->name,
            'phone'         => $this->phone,
            'email'         => $this->email ?? null,
        ];

        $response = Http::withHeaders($this->requestHeaders())->post($this->apiUrl.$route, $data);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

	/**
	 * Cancellation of a dispatch orders.
	 *
	 * @param int $id
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function cancel(int $id, bool $returnJson = false): array|string
	{
        $route = "/v1/dispatch_orders/$id";

        $response = Http::withHeaders($this->requestHeaders())->delete($this->apiUrl.$route);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

	/**
	 * Get dispatch orders list.
	 *
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function list(bool $returnJson = false): array|string
	{
        $route = "/v1/organizations/$this->organizationId/dispatch_orders";

        $response = Http::withHeaders($this->requestHeaders())->get($this->apiUrl.$route);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

	/**
	 * Get dispatch orders details.
	 *
	 * @param int $id
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function get(int $id, bool $returnJson = false): array|string
	{
        $route = "/v1/dispatch_orders/$id";

        $response = Http::withHeaders($this->requestHeaders())->get($this->apiUrl.$route);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

	/**
	 * Add comment to dispatch orders.
	 *
	 * @param int $dispatch_order_id
	 * @param string $comment
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function addComment(int $dispatch_order_id, string $comment, bool $returnJson = false): array|string
	{
        $route = "/v1/organizations/$this->organizationId/dispatch_orders/$dispatch_order_id/comment";

        $data = [
            'comment' => $comment,
        ];

        $response = Http::withHeaders($this->requestHeaders())->post($this->apiUrl.$route, $data);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

	/**
	 * Update comment in dispatch orders.
	 *
	 * @param int $dispatch_order_id
	 * @param int $comment_id
	 * @param string $comment
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function updateComment(int $dispatch_order_id, int $comment_id, string $comment, bool $returnJson = false): array|string
	{
        $route = "/v1/organizations/$this->organizationId/dispatch_orders/$dispatch_order_id/comment";

        $data = [
            'id'        => $comment_id,
            'comment'   => $comment,
        ];

        $response = Http::withHeaders($this->requestHeaders())->put($this->apiUrl.$route, $data);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

	/**
	 * Remove comment from dispatch orders.
	 *
	 * @param int $dispatch_order_id
	 * @param int $comment_id
	 * @param bool $returnJson
	 * @return string|array
	 * @throws ConnectionException
	 */
	public function removeComment(int $dispatch_order_id, int $comment_id, bool $returnJson = false): array|string
	{
        $route = "/v1/organizations/$this->organizationId/dispatch_orders/$dispatch_order_id/comment";

        $data = [
            'id' => $comment_id,
        ];

        $response = Http::withHeaders($this->requestHeaders())->delete($this->apiUrl.$route, $data);

        return $returnJson ? $response->body() : json_decode($response->body(), true);
    }

    /**
     * Validate shipment.
     */
    private function validateDispatch(): void
    {
        $this->validateOrganizationId();
        $this->validateShipments();
        $this->validateAddress();
        $this->validateName();
        $this->validatePhone();
    }

    /**
     * Validate organization id.
     */
    private function validateOrganizationId(): void
    {
        if(!$this->organizationId)
            throw new InvalidArgumentException('Organization id is not set.');
    }

    /**
     * Validate shipments.
     */
    private function validateShipments(): void
    {
        if(empty($this->shipments))
            throw new InvalidArgumentException('Shipments cannot be empty.');
    }

    /**
     * Validate address.
     */
    private function validateAddress(): void
    {
        if(!isset($this->address))
            throw new InvalidArgumentException('Address is not set.');
    }

    /**
     * Validate name.
     */
    private function validateName(): void
    {
        if(!isset($this->name))
            throw new InvalidArgumentException('Name is not set.');
    }

    /**
     * Validate phone.
     */
    private function validatePhone(): void
    {
        if(!isset($this->phone))
            throw new InvalidArgumentException('Phone is not set.');
    }
}