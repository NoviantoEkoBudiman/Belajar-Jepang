<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Card;

class CardsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'cards_categories_id'   =>  'required',
            'cards_question'         =>  'required',
            'cards_answer'           =>  'required'
        ],
        [
            'cards_categories_id.required'  =>  'Id Categories can\'t be null',
            'cards_question.required'        =>  'Card\'s question  can\'t be null',
            'cards_answer.required'          =>  'Card\'s answer  can\'t be null'
        ]);
        
        if($validated){    
            foreach($request->cards_question as $key=>$item){
                $card = new Card;
                $card->cards_categories_id  = $request->cards_categories_id;
                $card->cards_question       = $request->cards_question[$key];
                $card->cards_answer         = $request->cards_answer[$key];
                $card->save();
            }
    
            return redirect()
                    ->route('card.show',$request->cards_categories_id)
                    ->with('success', 'Data kartu berhasil ditambahkan');
        }else{
            return redirect()
                    ->route('card.show',$request->cards_categories_id)
                    ->withErrors('failed', 'Data kartu gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $cards  = Card::where('cards_categories_id', $category->categories_id)->get();
        return view('card.detail',compact('category','cards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cards  = Card::where('cards_id', $id)->first();
    }

    public function edit_card($id)
    {
        $card = Card::where('cards_id', $id)->first();
        return response()->json([
            "cards_id"              => $card->cards_id,
            "cards_categories_id"   => $card->cards_categories_id,
            "cards_question"        => $card->cards_question,
            "cards_answer"          => $card->cards_answer,
        ]);
    }

    public function update_card(Request $request){
        $card = Card::find($request->cards_id);
        $card->cards_question   = $request->cards_question;
        $card->cards_answer     = $request->cards_answer;
        $card->update();
        
        return redirect()
                ->route('card.show',$request->cards_categories_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        if($card){
            $delete = $card->delete();
            if($delete){
                return redirect()
                        ->back()
                        ->with('success', 'Data card berhasil dihapus');
            }else{
                return redirect()
                            ->back()
                            ->with('error', 'Data card berhasil dihapus');
            }
        }else{
            return redirect()
                        ->back()
                        ->with('error', 'Data card gagal dihapus');
        }
    }
}