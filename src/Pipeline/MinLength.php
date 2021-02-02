<?php

declare(strict_types=1);

namespace App\Pipeline;

use App\Request;
use Exception;

class MinLength
{
    /**
     * MinLength constructor.
     *
     * @param int                $min
     * @param array<int, string> $fields
     */
    public function __construct(
        private int $min,
        private array $fields
    ) { }

    public function __invoke(Request $request): Request
    {
        foreach ($this->fields as $field) {
            $value = $request->get($field);
            if (is_string($value) && $this->min > strlen($value)) {
                throw new Exception("{$field} is too short!");
            }
        }

        return $request;
    }
}
