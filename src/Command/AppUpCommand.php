<?php

namespace Aloe\Command;

class AppUpCommand extends \Aloe\Command
{
    public $name = "app:up";
    public $description = "Remove app from maintainance mode";
    public $help = "Set app in normal mode";

    public function handle()
    {
        $env = BaseCommand::rootpath(".env");
        $envContent = file_get_contents($env);
        $envContent = str_replace(
            'APP_DOWN=true',
            'APP_DOWN=false',
            $envContent
        );
        file_put_contents($env, $envContent);

        $index = BaseCommand::rootpath("index.php");
        $indexContent = file_get_contents($index);
        $indexContent = str_replace(
            ['(["mode" => "down"])', '["mode" => "down"]'],
            '',
            $indexContent
        );
        file_put_contents($index, $indexContent);

        $this->comment("App is now out of down mode...");
    }
}
