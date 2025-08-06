<?php

namespace App\Console\Commands;

use App\Models\Person;
use Illuminate\Console\Command;

class UpdatePersonRelationships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'persons:update-relationships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all persons with their relationship to family head';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update person relationships...');
        
        $persons = Person::all();
        $total = $persons->count();
        $updated = 0;
        
        $progressBar = $this->output->createProgressBar($total);
        $progressBar->start();
        
        foreach ($persons as $person) {
            try {
                $oldRelationship = $person->relationship_to_family_head;
                $person->updateRelationshipToFamilyHead();
                
                if ($oldRelationship !== $person->relationship_to_family_head) {
                    $updated++;
                    $this->line("\nUpdated: {$person->name_ar} - {$oldRelationship} → {$person->relationship_to_family_head}");
                }
                
                $progressBar->advance();
            } catch (\Exception $e) {
                $this->error("\nError updating person {$person->name_ar}: " . $e->getMessage());
            }
        }
        
        $progressBar->finish();
        
        $this->newLine();
        $this->info("Completed! Updated {$updated} out of {$total} persons.");
        
        return 0;
    }
}
