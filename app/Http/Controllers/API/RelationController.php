<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @EndPoint 6 -> Add relation to specific graph
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parent=Node::find($request->parent_node);
        $child=Node::find($request->child_node);

        if($parent->Relations()->attach($child,['rel_name'=>$request->rel_name])){
                return response()->json([
                    'success'=> 'Node '.$parent->id. ' related successfully to Node '. $child->id . ' with relation named: '. $request->rel_name
                ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function show(Relation $relation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @EndPoint 7 - update graph shape (Relations)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relation $relation)
    {
        $parent=Node::find($relation->parent_node);
        $child=Node::find($relation->child_node);

        /*if($child->id != $request->child_node || $parent->id != $request->parent_node){
            $child->Relations()->detach($parent);
        }*/
        if($relation->update($request->all())){

                return response()->json([
                    'success'=> 'Relation named: '. $relation->rel_name . ' updated between Node '.$relation->parent_node. ' and Node '. $relation->child_node
                ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @EndPoint 7 -> update the graph shape
     *
     * @param  \App\Models\Relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relation $relation)
    {
        //$relation->Nodes()->detach();

        if($relation->delete()){
            return response()->json([
                'success'=> 'Relation named: '. $relation->rel_name . ' deleted successfuly' 
            ],200);
        }
    }
}
