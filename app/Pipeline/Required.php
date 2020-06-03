<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:54
 *
 * PHP version 7.2
 */

namespace Wizmo\Pipeline;

use Exception;
use Wizmo\Request;

class Required
{
    /**
     * @var array<int, string>
     */
    private array $fields;

    /**
     * Required constructor.
     *
     * @param array<int, string> $fields
     */
    public function __construct(array $fields)
    {
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
            if (false === $request->has($field)) {
                throw new Exception("{$field} is required!");
            }
        }

        return $request;
    }
}
