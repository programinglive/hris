<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetDeleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-deleted {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $model = $this->argument('model');
        $model = app('App\Models\\' . ucfirst($model) );

        $models = $model->withTrashed()->get();
        
        foreach($models as $data) {
            if($data->deleted_at){
                $data->code = $data->code . '-deleted-';
                $data->save();
                $this->info($data->code . ' deleted');
            }
        }

    }
}