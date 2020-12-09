<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NodesResouce;
use App\Models\Graph;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @EndPoint 8 -> get single graph with it's nodes and relations
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Graph $graph)
    {
        //return $graph->Nodes;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @Endpoint 5 -> add node to specific graph
     *
     * @param  \Illuminate\Http\Request  $request [node_name,graph_id]
     * @param  \App\Models\Graph  $graph
     * @return \Illuminate\Http\Response
     */
    public function store(Graph $graph,Request $request)
    {
        //

        if($node=Node::create([$request->all()])){
            $node->Graph()->associate($graph);
            return response()->json([
                'success'=> 'Node attached successfully to Graph '. $graph->graph_name
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        return new NodesResouce($node);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @EndPoint 7 -> update the graph shape (Nodes)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        //verify before updating && if the graph id is different than with separate the node from relations and the graph
        if($node->Graph->id != $request->graph_id){
            $node->Graph()->dissociate();
            $node->Relations()->detach();
        }
        
        //query for finding the new graph
        $graph=Graph::find($request->graph_id);

        //updating the node row for his updated data
        if($node->update($request->all())){
            $node->Graph()->associate($graph);
            return response()->json([
                'success'=> 'Node updated successfuly'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @EndPoint 9 -> Delete a specific node
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        $node->Relations()->detach();

        foreach($node->Graph->Nodes as $parent){
            $parent->Relations()->detach($node);
        }

        $node->Graph()->dissociate();

        if($node->delete()){
            return response()->json([
                'success'=> 'Node deleted successfuly'
            ],200);
        }
    }
}
