<?php

declare(strict_types=1);

namespace App\Pipeline;

use App\Request;
use Exception;

class Required
{
    /**
     * Required constructor.
     *
     * @param array<int, string> $fields
     */
    public function __construct(
        private array $fields
    ) { }

    public function __invoke(Request $request): Request
    {
        foreach ($this->fields as $field) {
            if (false === $request->has($field)) {
                throw new Exception("{$field} is required!");
            }
        }

        return $request;
    }
}
