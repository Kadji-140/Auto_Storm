<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class GenerateDynamicIdeHelper extends Command
{
    protected $signature = 'ide-helper:dynamic';
    protected $description = 'Generate dynamic IDE helper by scanning files';

    public function handle()
    {
        $this->info('🚀 Génération dynamique des helpers...');
        
        $routes = $this->scanRoutes();
        $views = $this->scanViews();
        $configs = $this->scanConfigs();
        
        $this->generateMeta($routes, $views, $configs);
        
        $this->info('✅ Terminé !');
        $this->table(['Type', 'Nombre'], [
            ['Routes', count($routes)],
            ['Vues', count($views)],
            ['Configs', count($configs)]
        ]);
    }

    private function scanRoutes()
    {
        $this->info('📍 Scan des routes...');
        
        $routes = [];
        foreach (Route::getRoutes() as $route) {
            if ($route->getName()) {
                $routes[] = $route->getName();
            }
        }
        
        return array_unique($routes);
    }

    private function scanViews()
    {
        $this->info('👁️ Scan des vues...');
        
        $views = [];
        $viewPath = resource_path('views');
        
        $files = File::allFiles($viewPath);
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $relativePath = str_replace($viewPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $viewName = str_replace(['/', '\\', '.blade.php', '.php'], ['.', '.', '', ''], $relativePath);
                $views[] = $viewName;
            }
        }
        
        return $views;
    }

    private function scanConfigs()
    {
        $this->info('⚙️ Scan des configs...');
        
        $configs = [];
        $configPath = config_path();
        
        $files = File::allFiles($configPath);
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $configName = str_replace('.php', '', $file->getFilename());
                
                try {
                    $configData = include $file->getPathname();
                    if (is_array($configData)) {
                        $this->extractConfigKeys($configData, $configName, $configs);
                    }
                } catch (\Exception $e) {
                    // Ignorer les erreurs
                }
            }
        }
        
        return array_unique($configs);
    }

    private function extractConfigKeys($array, $prefix, &$configs)
    {
        foreach ($array as $key => $value) {
            $fullKey = $prefix . '.' . $key;
            $configs[] = $fullKey;
            
            if (is_array($value) && !empty($value)) {
                $this->extractConfigKeys($value, $fullKey, $configs);
            }
        }
    }

    private function generateMeta($routes, $views, $configs)
    {
        $this->info('📝 Génération .phpstorm.meta.php...');
        
        $content = "<?php\n\n";
        $content .= "/**\n";
        $content .= " * PhpStorm Meta - Généré dynamiquement le " . now()->format('Y-m-d H:i:s') . "\n";
        $content .= " * Routes: " . count($routes) . " | Vues: " . count($views) . " | Configs: " . count($configs) . "\n";
        $content .= " */\n\n";
        
        $content .= "namespace PHPSTORM_META {\n\n";
        
        // Routes
        if (!empty($routes)) {
            $content .= "    // === ROUTES ===\n";
            $content .= "    expectedArguments(\\route(), 0,\n";
            foreach ($routes as $index => $route) {
                $comma = $index < count($routes) - 1 ? ',' : '';
                $content .= "        '{$route}'{$comma}\n";
            }
            $content .= "    );\n\n";
            
            $content .= "    expectedArguments(\\redirect()->route(), 0,\n";
            foreach ($routes as $index => $route) {
                $comma = $index < count($routes) - 1 ? ',' : '';
                $content .= "        '{$route}'{$comma}\n";
            }
            $content .= "    );\n\n";
            
            $content .= "    expectedArguments(\\Illuminate\\Support\\Facades\\Redirect::route(), 0,\n";
            foreach ($routes as $index => $route) {
                $comma = $index < count($routes) - 1 ? ',' : '';
                $content .= "        '{$route}'{$comma}\n";
            }
            $content .= "    );\n\n";
        }
        
        // Vues
        if (!empty($views)) {
            $content .= "    // === VUES ===\n";
            $content .= "    expectedArguments(\\view(), 0,\n";
            foreach ($views as $index => $view) {
                $comma = $index < count($views) - 1 ? ',' : '';
                $content .= "        '{$view}'{$comma}\n";
            }
            $content .= "    );\n\n";
            
            $content .= "    expectedArguments(\\View::make(), 0,\n";
            foreach ($views as $index => $view) {
                $comma = $index < count($views) - 1 ? ',' : '';
                $content .= "        '{$view}'{$comma}\n";
            }
            $content .= "    );\n\n";
        }
        
        // Configurations
        if (!empty($configs)) {
            $content .= "    // === CONFIGURATIONS ===\n";
            $content .= "    expectedArguments(\\config(), 0,\n";
            foreach ($configs as $index => $config) {
                $comma = $index < count($configs) - 1 ? ',' : '';
                $content .= "        '{$config}'{$comma}\n";
            }
            $content .= "    );\n\n";
        }
        
        $content .= "}\n";
        
        file_put_contents(base_path('.phpstorm.meta.php'), $content);
        
        // Générer aussi un fichier de mapping pour navigation
        $this->generateNavigationHelper($routes, $views);
    }

    private function generateNavigationHelper($routes, $views)
    {
        $this->info('🧭 Génération helper de navigation...');
        
        $content = "<?php\n\n";
        $content .= "/**\n";
        $content .= " * Navigation Helper - Mapping des fichiers\n";
        $content .= " * Généré le " . now()->format('Y-m-d H:i:s') . "\n";
        $content .= " */\n\n";
        
        $content .= "return [\n";
        $content .= "    'routes' => [\n";
        
        // Mapper les routes avec leurs fichiers
        foreach (Route::getRoutes() as $route) {
            if ($route->getName()) {
                $action = $route->getActionName();
                $content .= "        '{$route->getName()}' => [\n";
                $content .= "            'uri' => '{$route->uri()}',\n";
                $content .= "            'methods' => ['" . implode("', '", $route->methods()) . "'],\n";
                $content .= "            'action' => '{$action}',\n";
                $content .= "            'file' => '" . $this->findRouteFile($route->getName()) . "',\n";
                $content .= "        ],\n";
            }
        }
        
        $content .= "    ],\n";
        $content .= "    'views' => [\n";
        
        // Mapper les vues avec leurs fichiers
        $viewPath = resource_path('views');
        $files = File::allFiles($viewPath);
        
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $relativePath = str_replace($viewPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $viewName = str_replace(['/', '\\', '.blade.php', '.php'], ['.', '.', '', ''], $relativePath);
                $content .= "        '{$viewName}' => '" . str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname()) . "',\n";
            }
        }
        
        $content .= "    ],\n";
        $content .= "];\n";
        
        file_put_contents(base_path('_ide_helper_navigation.php'), $content);
    }

    private function findRouteFile($routeName)
    {
        $routeFiles = ['routes/web.php', 'routes/api.php', 'routes/console.php'];
        
        foreach ($routeFiles as $file) {
            if (file_exists(base_path($file))) {
                $content = file_get_contents(base_path($file));
                if (strpos($content, "name('$routeName')") !== false || 
                    strpos($content, "name(\"$routeName\")") !== false) {
                    return $file;
                }
            }
        }
        
        return 'unknown';
    }
}