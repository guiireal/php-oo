<?php

declare(strict_types=1);

class Preferences
{
    private array|false $properties;
    private static Preferences $instance;

    private function __construct() {
        $this->properties = parse_ini_file('application.ini');
    }

    public static function getInstance(): Preferences
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getProperty(string $key): string
    {
        return $this->properties[$key];
    }

    public function setProperty(string $key, string $value): void
    {
        $this->properties[$key] = $value;
    }

    public function save(): void
    {
        $string = '';

        foreach ($this->properties as $key => $value) {
            $string .= "{$key}={$value}\n";
        }

        file_put_contents('application.ini', $string);
    }
}