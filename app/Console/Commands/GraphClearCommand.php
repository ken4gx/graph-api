<?php

namespace App\Console\Commands;

use App\Models\Graph;
use Illuminate\Console\Command;

class GraphClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete all empty graphs';

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
        //message for informing the action
        $this->info('cleaning...');

        //fetch the table's Graphs for empty graphs (without nodes) to delete and displaying the name of the deleted graph
        Graph::whereDoesntHave('Nodes')->get()
        ->each(function ($graph){
            $graph->delete();
            $this->warn("Deleted graph's name: ".$graph->graph_name);
        });
    }
}
