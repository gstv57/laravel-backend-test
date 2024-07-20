<?php

namespace App\Repository;

use App\Contracts\ClienteContract;
use App\Models\Cliente;

class ClienteRepository implements ClienteContract
{
    public function all()
    {
        return Cliente::all();
    }
}
