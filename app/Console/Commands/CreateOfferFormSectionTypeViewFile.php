<?php

namespace App\Console\Commands;

use App\Models\OfferForms\OfferFormSection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateOfferFormSectionTypeViewFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offerform:step-section';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create offer form section type view files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $typesConfig = OfferFormSection::TYPES_CONFIG;

        foreach ($typesConfig as $key => $typeConfig) {
            $dirPath = resource_path('views/dash/offer-forms/steps/sections/' . $key);

            if (!File::exists($dirPath)) {
                File::makeDirectory(resource_path('views/dash/offer-forms/steps/sections/' . $key));
            }

            foreach ($typeConfig as $cKey => $config) {
                $filePath = "$dirPath/$cKey.blade.php";
                if (!File::exists($filePath)) {
                    File::put($filePath, $config['text']);
                }
            }

        }

        return 1;
    }
}
