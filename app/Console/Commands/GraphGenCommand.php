<?php

namespace App\Console\Commands;

use App\Models\Graph;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GraphGenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph:gen {--nbNodes=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate a random graph with in option numbers of nodes and a randoms number of relations';

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
        $nbNodes=$this->option('nbNodes');
        //verified if the option is negative null or positive number
        if($nbNodes < 0){
            $this->error('negative and null number are not authorized');
        }
        else{
            //factoring a graph randomly with numbers of nodes
            $graph=Graph::factory()
            ->hasNodes($nbNodes)
            ->create();

            //generating randomly numbers of relations

            foreach($graph->Nodes as $node){

            $nodes=$graph->Nodes->whereNotIn('id', $node->id);
            $node->Relations()->attach($nodes->random(rand(0,$nbNodes/2))->pluck('id')->toArray(),['rel_name'=>Str::random(10)]);
            }
            //displayin a message
            $this->info('Graph generated successfuly');
        }
        
    }
}
