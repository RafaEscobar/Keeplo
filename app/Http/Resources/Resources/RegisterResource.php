<?php

namespace App\Http\Resources\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    public $token;

    public function __construct($resource, $currentToken = null)
    {
        parent:: __construct($resource);
        $this->token = $currentToken;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email
        ];
        if ($this->token) $response['token'] = $this->token;
        return $response;
    }
}
