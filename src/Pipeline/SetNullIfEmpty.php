<?php

declare(strict_types=1);

namespace App\Pipeline;

use App\Request;

class SetNullIfEmpty
{
    public function __invoke(Request $request): Request
    {
        foreach ($request->getAll() as $key => $value) {
            if (is_string($value) && 0 === strlen($value)) {
                $request->set($key, null);
            }
        }

        return $request;
    }
}
