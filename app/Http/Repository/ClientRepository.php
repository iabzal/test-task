<?php

declare(strict_types = 1);

namespace App\Http\Repository;

use App\Http\Interface\ClientInterface;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientRepository implements ClientInterface
{
    /**
     *
     * @param Request $request
     * @return bool
     */
    public function registerClient(Request $request): bool
    {
        $request->validate([
            'fullName' => 'required|string',
            'email' => 'required|string|unique:clients',
            'login' => 'unique:clients',
            'password' => 'confirmed',
        ]);

        Client::create([
            'full_name' => $request->fullName,
            'email' => $request->email,
            'login' => $request->login,
            'password' => bcrypt($request->password),
        ]);

        return true;
    }
}
