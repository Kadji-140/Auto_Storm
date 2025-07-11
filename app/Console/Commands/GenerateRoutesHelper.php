<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class GenerateRoutesHelper extends Command
{
    protected $signature = 'ide-helper:routes';
    protected $description = 'Generate routes helper for IDE autocompletion';

    public function handle()
    {
        $this->info('🚀 Génération du helper de routes...');
        
        $routes = $this->getRoutes();
        $content = $this->generateHelperContent($routes);
        
        file_put_contents(base_path('_ide_helper_routes.php'), $content);
        
        $this->info('✅ Helper de routes généré : _ide_helper_routes.php');
        $this->info('📊 ' . count($routes) . ' routes trouvées');
    }

    private function getRoutes(): array
    {
        $routes = [];
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $route) {
            $name = $route->getName();
            
            if ($name) {
                $routes[] = [
                    'name' => $name,
                    'uri' => $route->uri(),
                    'methods' => implode('|', $route->methods()),
                    'parameters' => $this->getRouteParameters($route->uri()),
                    'action' => $route->getActionName()
                ];
            }
        }

        return collect($routes)->sortBy('name')->toArray();
    }

    private function getRouteParameters(string $uri): array
    {
        preg_match_all('/\{([^}]+)\}/', $uri, $matches);
        return $matches[1] ?? [];
    }

    private function generateHelperContent(array $routes): string
    {
        $content = "<?php\n\n";
        $content .= "/**\n";
        $content .= " * Laravel Routes Helper for IDE\n";
        $content .= " * Generated on " . now()->format('Y-m-d H:i:s') . "\n";
        $content .= " * \n";
        $content .= " * This file provides autocompletion for Laravel routes\n";
        $content .= " * DO NOT EDIT MANUALLY - Generated automatically\n";
        $content .= " */\n\n";

        // Générer les constantes de routes
        $content .= "class RouteNames\n{\n";
        foreach ($routes as $route) {
            $constantName = strtoupper(str_replace(['.', '-'], '_', $route['name']));
            $content .= "    const {$constantName} = '{$route['name']}';\n";
        }
        $content .= "}\n\n";

        // Générer la fonction helper personnalisée
        $content .= "if (!function_exists('route_name')) {\n";
        $content .= "    /**\n";
        $content .= "     * Helper function with route autocompletion\n";
        $content .= "     * \n";
        foreach ($routes as $route) {
            $params = !empty($route['parameters']) ? 
                ', array $parameters = []' : '';
            $content .= "     * @method static string {$route['name']}({$params})\n";
        }
        $content .= "     */\n";
        $content .= "    function route_name(string \$name, array \$parameters = [], bool \$absolute = true): string\n";
        $content .= "    {\n";
        $content .= "        return route(\$name, \$parameters, \$absolute);\n";
        $content .= "    }\n";
        $content .= "}\n\n";

        // Générer les métadonnées PhpStorm
        $content .= "namespace PHPSTORM_META {\n\n";
        $content .= "    expectedArguments(\\route(), 0, \n";
        foreach ($routes as $index => $route) {
            $comma = $index < count($routes) - 1 ? ',' : '';
            $content .= "        '{$route['name']}'{$comma}\n";
        }
        $content .= "    );\n\n";
        
        $content .= "    expectedArguments(\\route_name(), 0, \n";
        foreach ($routes as $index => $route) {
            $comma = $index < count($routes) - 1 ? ',' : '';
            $content .= "        '{$route['name']}'{$comma}\n";
        }
        $content .= "    );\n\n";
        $content .= "}\n\n";

        // Ajouter la documentation des routes
        $content .= "/**\n";
        $content .= " * ROUTES DOCUMENTATION\n";
        $content .= " * ====================\n";
        $content .= " * \n";
        foreach ($routes as $route) {
            $content .= " * Route: {$route['name']}\n";
            $content .= " *   URI: {$route['uri']}\n";
            $content .= " *   Methods: {$route['methods']}\n";
            if (!empty($route['parameters'])) {
                $content .= " *   Parameters: " . implode(', ', $route['parameters']) . "\n";
            }
            $content .= " *   Action: {$route['action']}\n";
            $content .= " * \n";
        }
        $content .= " */\n";

        return $content;
    }
}
