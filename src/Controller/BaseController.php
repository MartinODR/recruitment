<?php

namespace App\controller;

class BaseController{


    protected $viewsPath = __DIR__ . '/../View/';

    public function loadView($viewName, $subDir = '', $data = []): void
    {


        // Prüfen, ob Unterverzeichnis angegeben wurde und entsprechend den Pfad anpassen
        $path = $this->viewsPath . ($subDir ? '/' . $subDir . '/' : '') . $viewName . '.php';

        // Prüfe ob File existiert
        if (file_exists($path)) {
            // Variablen für die View verfügbar machen
            extract($data);

            // View-File einbinden
            require($path);
        } else {
            // Fehlermeldung, wenn die Datei nicht gefunden wird
            echo "Die View $viewName konnte nicht gefunden werden.";
        }
    }    
}

