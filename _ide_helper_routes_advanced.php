<?php

/**
 * Routes Helper for PhpStorm Advanced Recognition
 */

if (!function_exists('route_helper')) {
    function route_helper(string $name, array $parameters = []): string {
        switch ($name) {
            case 'sanctum.csrf-cookie': return route('sanctum.csrf-cookie', $parameters);
            case 'ignition.healthCheck': return route('ignition.healthCheck', $parameters);
            case 'ignition.executeSolution': return route('ignition.executeSolution', $parameters);
            case 'ignition.updateConfig': return route('ignition.updateConfig', $parameters);
            case 'products.index': return route('products.index', $parameters);
            case 'products.create': return route('products.create', $parameters);
            case 'products.store': return route('products.store', $parameters);
            case 'products.show': return route('products.show', $parameters);
            case 'products.edit': return route('products.edit', $parameters);
            case 'products.update': return route('products.update', $parameters);
            case 'products.destroy': return route('products.destroy', $parameters);
            default: return route($name, $parameters);
        }
    }
}
