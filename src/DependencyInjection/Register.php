<?php declare(strict_types=1);


namespace App\DependencyInjection;


interface Register
{
    public function bind(string $id, object|callable $binding): void;
}