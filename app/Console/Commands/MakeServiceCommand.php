<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $className = ucfirst($name) . 'Service';
        $directory = app_path('Services');
        $filePath = $directory . '/' . $className . '.php';

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($filePath)) {
            $this->error('Service already exists!');
            return;
        }

        $stub = "<?php

namespace App\Services;

class {$className}
{
    //
}
";

        File::put($filePath, $stub);
        $this->info("Service {$className} created successfully at app/Services/");
    }
}
