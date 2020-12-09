<?php

namespace App\Console\Commands;

use App\Models\Graph;
use Illuminate\Console\Command;

class GraphStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:stats {--gid=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command display graphs stats by graph id';

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
        $id=$this->option('gid');
        $graph=Graph::find($id);

        //counting number of relations in the graph
        $nodes=$graph->Nodes;
        $nbRel=0;
        foreach($nodes as $node){
            $nbRel+=$node->Relations->count();
        }
        
        //display an array of arrays
        $row[]=[$graph->id,$graph->graph_name,$graph->graph_descrip, $graph->Nodes->count(),$nbRel];

        $this->table(['id','name','description','Nodes count','Relations count'], $row);
    }
}
