<?php

namespace App\Http\Controllers;

class Controller
{
    public function __construct()
    {
        date_default_timezone_set('Europe/Moscow');
    }

    public function render(string $view, array $data = []): void
    {
        // Извлекаем переменные для использования в шаблоне
        extract($data);

        // Путь к файлу шаблона
        $viewPath = ROOT_PATH . '/resources/views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            die("View not found: {$viewPath}");
        }

        // Буферизация вывода
        ob_start();
        require $viewPath;
        $content = ob_get_clean();
        echo $content;
    }
}
