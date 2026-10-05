<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigratePdfsToModules extends Command
{
    protected $signature = 'migrate:pdfs-to-modules';
    protected $description = 'Migrate old materi_pdf data to program_modules table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $programs = \App\Models\ProgramKursus::all();
        foreach ($programs as $p) {
            if ($p->materi_pdf && is_array($p->materi_pdf)) {
                $maxOrder = \App\Models\ProgramModule::where('program_id', $p->id)->max('order_index') ?? 0;
                foreach ($p->materi_pdf as $index => $pdf) {
                    $exists = \App\Models\ProgramModule::where('program_id', $p->id)
                        ->where('file_path', $pdf)
                        ->exists();
                    if (!$exists) {
                        \App\Models\ProgramModule::create([
                            'program_id' => $p->id,
                            'title' => 'Materi PDF ' . ($index + 1),
                            'type' => 'materi',
                            'file_path' => $pdf,
                            'order_index' => $maxOrder + 1
                        ]);
                        $maxOrder++;
                        $this->info("Migrated PDF for Program: {$p->title}");
                    }
                }
            }
        }

        $events = \App\Models\Event::all();
        foreach ($events as $e) {
            if ($e->materi_pdf && is_array($e->materi_pdf)) {
                $maxOrder = \App\Models\ProgramModule::where('event_id', $e->id)->max('order_index') ?? 0;
                foreach ($e->materi_pdf as $index => $pdf) {
                    $exists = \App\Models\ProgramModule::where('event_id', $e->id)
                        ->where('file_path', $pdf)
                        ->exists();
                    if (!$exists) {
                        \App\Models\ProgramModule::create([
                            'event_id' => $e->id,
                            'title' => 'Materi PDF ' . ($index + 1),
                            'type' => 'materi',
                            'file_path' => $pdf,
                            'order_index' => $maxOrder + 1
                        ]);
                        $maxOrder++;
                        $this->info("Migrated PDF for Event: {$e->title}");
                    }
                }
            }
        }
        $this->info("Migration of PDFs to Modules completed!");
    }
}
