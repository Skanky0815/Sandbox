<?php

declare(strict_types=1);

namespace App\Pipeline;

use App\Request;

class ClearNulls
{
    public function __invoke(Request $request): Request
    {
        foreach ($request->getAll() as $key => $value) {
            if (null === $value) {
                $request->remove($key);
            }
        }

        return $request;
    }
}
