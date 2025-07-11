<?php

/**
 * Script de navigation pour routes et vues
 * Usage: php navigate_helper.php route products.index
 * Usage: php navigate_helper.php view products.create
 */

require_once 'vendor/autoload.php';

class NavigationHelper
{
    private $mapping;

    public function __construct()
    {
        // Charger le mapping généré
        if (file_exists('_ide_helper_navigation.php')) {
            $this->mapping = include '_ide_helper_navigation.php';
        } else {
            echo "❌ Fichier de navigation non trouvé. Exécutez d'abord: php artisan ide-helper:dynamic\n";
            exit(1);
        }
    }

    public function findRoute($routeName)
    {
        if (isset($this->mapping['routes'][$routeName])) {
            $route = $this->mapping['routes'][$routeName];
            
            echo "🎯 Route trouvée: {$routeName}\n";
            echo "📍 URI: {$route['uri']}\n";
            echo "🔧 Méthodes: " . implode(', ', $route['methods']) . "\n";
            echo "⚡ Action: {$route['action']}\n";
            echo "📁 Fichier: {$route['file']}\n";
            
            // Ouvrir le fichier dans l'éditeur (optionnel)
            if (isset($GLOBALS['argv'][3]) && $GLOBALS['argv'][3] === '--open') {
                $this->openInEditor($route['file']);
            }
        } else {
            echo "❌ Route '{$routeName}' non trouvée\n";
            $this->suggestSimilar('routes', $routeName);
        }
    }

    public function findView($viewName)
    {
        if (isset($this->mapping['views'][$viewName])) {
            $viewFile = $this->mapping['views'][$viewName];
            
            echo "👁️ Vue trouvée: {$viewName}\n";
            echo "📁 Fichier: {$viewFile}\n";
            echo "🔗 Chemin complet: " . base_path($viewFile) . "\n";
            
            // Vérifier si le fichier existe
            if (file_exists(base_path($viewFile))) {
                echo "✅ Fichier existe\n";
                
                // Afficher les premières lignes
                $content = file_get_contents(base_path($viewFile));
                $lines = explode("\n", $content);
                echo "📄 Aperçu (5 premières lignes):\n";
                for ($i = 0; $i < min(5, count($lines)); $i++) {
                    echo "  " . ($i + 1) . ": " . trim($lines[$i]) . "\n";
                }
            } else {
                echo "❌ Fichier n'existe pas\n";
            }
            
            // Ouvrir le fichier dans l'éditeur (optionnel)
            if (isset($GLOBALS['argv'][3]) && $GLOBALS['argv'][3] === '--open') {
                $this->openInEditor($viewFile);
            }
        } else {
            echo "❌ Vue '{$viewName}' non trouvée\n";
            $this->suggestSimilar('views', $viewName);
        }
    }

    public function listAll($type)
    {
        if ($type === 'routes') {
            echo "📍 Routes disponibles:\n";
            foreach ($this->mapping['routes'] as $name => $info) {
                echo "  - {$name} → {$info['uri']}\n";
            }
        } elseif ($type === 'views') {
            echo "👁️ Vues disponibles:\n";
            foreach ($this->mapping['views'] as $name => $file) {
                echo "  - {$name} → {$file}\n";
            }
        }
    }

    private function suggestSimilar($type, $search)
    {
        echo "💡 Suggestions similaires:\n";
        
        $items = array_keys($this->mapping[$type]);
        $suggestions = [];
        
        foreach ($items as $item) {
            $similarity = 0;
            similar_text($search, $item, $similarity);
            if ($similarity > 50) {
                $suggestions[] = ['name' => $item, 'similarity' => $similarity];
            }
        }
        
        // Trier par similarité
        usort($suggestions, function($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });
        
        foreach (array_slice($suggestions, 0, 5) as $suggestion) {
            echo "  - {$suggestion['name']} (similarité: {$suggestion['similarity']}%)\n";
        }
    }

    private function openInEditor($file)
    {
        $fullPath = base_path($file);
        
        // Essayer différents éditeurs
        $editors = [
            'code' => 'code "' . $fullPath . '"',  // VS Code
            'phpstorm' => 'phpstorm "' . $fullPath . '"',  // PhpStorm
            'subl' => 'subl "' . $fullPath . '"',  // Sublime Text
            'notepad++' => 'notepad++ "' . $fullPath . '"'  // Notepad++
        ];
        
        foreach ($editors as $editor => $command) {