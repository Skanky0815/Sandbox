<?php declare(strict_types=1);


namespace App\DependencyInjection;

interface Provider
{
    public function handle(Register $container): void;
}