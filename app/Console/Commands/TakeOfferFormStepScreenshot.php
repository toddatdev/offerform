<?php

namespace App\Console\Commands;

use App\Models\OfferForms\OfferForm;
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class TakeOfferFormStepScreenshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offerform:step-screenshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take offerform step screenshot.';

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
        foreach (OfferForm::whereNull('parent_id')->with('steps')->get() as $offerForm) {
            foreach ($offerForm->steps as $step) {
                try {
                    $link = $step->getLinkToTakeScreenshot();
                    if ($link) {
                        $step->image = "offer-forms/step-{$step->id}.png";
                        $step->save();

                        Browsershot::url($link)
                            ->noSandbox()
                            ->save(storage_path("app/public/offer-forms/step-{$step->id}.png"));
                    }
                } catch (\Exception $e) {
                    \Log::error('Link To Take Screenshot: ' . $e->getMessage());
                }
            }
        }
        return true;
    }
}
