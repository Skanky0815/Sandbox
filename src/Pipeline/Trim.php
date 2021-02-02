<?php

declare(strict_types=1);

namespace App\Pipeline;

use App\Request;

class Trim
{
    public function __invoke(Request $request): Request
    {
        foreach ($request->getAll() as $key => $value) {
            if (is_string($value)) {
                $request->set($key, trim($value));
            }
        }

        return $request;
    }
}
