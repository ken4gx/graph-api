<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GraphsResouce;
use App\Http\Resources\GraphResouce;
use App\Models\Graph;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @EndPoint4 -> get all graphs (only meta data)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GraphsResouce::collection(Graph::all()) ;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @EndPoint 1 -> create an Empty Graph
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Graph::create($request->all())){
            return response()->json([
                'success'=>'graph saved successfuly'
            ],200);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @EndPoint 8 -> get single graph with it's nodes and relations
     *
     * @param  \App\Models\Graph  $graph
     * @return \Illuminate\Http\Response
     */
    public function show(Graph $graph)
    {
        return new GraphResouce($graph);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graph  $graph
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graph $graph)
    {
        if($graph->update($request->all())){
            return response()->json([
                'success'=>'graph updated successfuly'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Graph  $graph
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graph $graph)
    {
        if($graph->delete()){
            return response()->json([
                'success'=>'graph deleted successfuly'
            ],200);
        }
    }
}
