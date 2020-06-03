<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:43
 *
 * PHP version 7.2
 */

namespace Wizmo\Pipeline;

use Exception;
use Wizmo\Request;

class MinLength
{
    private int $min;

    /**
     * @var array<int, string>
     */
    private array $fields;

    /**
     * MinLength constructor.
     *
     * @param int                $min
     * @param array<int, string> $fields
     */
    public function __construct(int $min, array $fields)
    {
        $this->min = $min;
        $this->fields = $fields;
    }

    /**
     * @param Request $request
     *
     * @return Request
     * @throws Exception
     */
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
