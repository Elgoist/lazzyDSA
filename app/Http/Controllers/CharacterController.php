<?php

namespace App\Http\Controllers;

use App\Benefice;
use App\Character;
use App\Fightingtalent;
use App\Handicap;
use App\Language;
use App\Lettering;
use App\Magictrick;
use App\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,
            [
                'name'       => 'required',
                'race'       => '|nullable',
                'profession' => '|nullable',
                
                'gender'         => 'numeric|min:0|max:2',
                'height'         => 'numeric|nullable',
                'weight'         => 'numeric|nullable',
                'age'            => 'numeric|nullable',
                'hair'           => '|nullable',
                'eyes'           => '|nullable',
                'culture'        => '|nullable',
                'place_of_birth' => '|nullable',
                'title'          => '|nullable',
                'social'         => '|nullable',
                
                'MU' => 'numeric|min:6|max:20',
                'KL' => 'numeric|min:6|max:20',
                'IN' => 'numeric|min:6|max:20',
                'CH' => 'numeric|min:6|max:20',
                'FF' => 'numeric|min:6|max:20',
                'GE' => 'numeric|min:6|max:20',
                'KO' => 'numeric|min:6|max:20',
                'KK' => 'numeric|min:6|max:20',
                
                'lep'     => 'numeric|nullable',
                'asp'     => 'numeric|nullable',
                'kap'     => 'numeric|nullable',
                'lep_max' => 'numeric|nullable',
                'asp_max' => 'numeric|nullable',
                'kap_max' => 'numeric|nullable',
                'sp'      => 'numeric|nullable',
                
                'SK' => 'numeric|nullable',
                'ZK' => 'numeric|nullable',
                'AW' => 'numeric|nullable',
                'IT' => 'numeric|nullable',
                'GW' => 'numeric|nullable',
                
                'ap_total' => 'numeric',
                'ap_spend' => 'numeric|nullable',
            ]);
        
        $character = Character::create([
            'user_id'        => Auth::user()->id,
            'name'           => request()->name,
            'race'           => request()->race,
            'profession'     => request()->profession,
            'gender'         => request()->gender,
            'height'         => request()->height,
            'weight'         => request()->weight,
            'age'            => request()->age,
            'hair'           => request()->hair,
            'eyes'           => request()->eyes,
            'culture'        => request()->culture,
            'place_of_birth' => request()->place_of_birth,
            'title'          => request()->title,
            'social'         => request()->social,
            'MU'             => request()->MU,
            'KL'             => request()->KL,
            'IN'             => request()->IN,
            'CH'             => request()->CH,
            'FF'             => request()->FF,
            'GE'             => request()->GE,
            'KO'             => request()->KO,
            'KK'             => request()->KK,
            'lep'            => request()->lep_max,
            'asp'            => request()->asp_max,
            'kap'            => request()->kap_max,
            'lep_max'        => request()->lep_max,
            'asp_max'        => request()->asp_max,
            'kap_max'        => request()->kap_max,
            'sp'             => 3,
            'SK'             => request()->SK,
            'ZK'             => request()->ZK,
            'AW'             => request()->AW,
            'IT'             => request()->IT,
            'GW'             => request()->GW,
            'ap_total'       => request()->ap_total,
            'ap_spend'       => request()->ap_spend,
        ]);
        
        $talents = Talent::all();
        foreach ($talents as $talent) {
            $character->addTalent($talent, 0);
        }
        $fightingtalents = Fightingtalent::all();
        foreach ($fightingtalents as $fightingtalent) {
            $character->addFightingtalent($fightingtalent, 6);
        }
        
        return $character->id;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Character $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
    
    public function updateEnergy(Character $character)
    {
        if (request()->has('lep') && $character->lep_max >= request()->lep) {
            $character->lep = request()->lep;
        }
        if (request()->has('asp') && $character->asp_max >= request()->asp) {
            $character->asp = request()->asp;
        }
        if (request()->has('kap') && $character->kap_max >= request()->kap) {
            $character->kap = request()->kap;
        }
        if (request()->has('sp') && request()->sp < 4) {
            $character->sp = request()->sp;
        }
        $character->save();
        
        return back();
    }
    
    public function updateTalents(Request $request, Character $character)
    {
        $updatedTalents = $request->except('_token');
        $talents = $character->talents;
        
        foreach ($talents as $t => $talent) {
            $talent->pivot->value = $updatedTalents[$t]['value'];
            $talent->pivot->save();
        }
        
        return 'ok';
    }
    
    public function updateFightingtalents(Request $request, Character $character)
    {
        $updatedFightingtalents = $request->except('_token');
        $fightingtalents = $character->fightingtalents;
        
        foreach ($fightingtalents as $t => $fightingtalent) {
            $fightingtalent->pivot->value = $updatedFightingtalents[$t]['value'];
            $fightingtalent->pivot->save();
        }
        
        return 'ok';
    }
    
    public function addLanguage(Request $request, Character $character)
    {
        $level = $request->level;
        $language = Language::find($request->id);
        $character->addLanguage($language, $level);
        
        return 'ok';
    }
    
    public function addLettering(Request $request, Character $character)
    {
        $lettering = Lettering::find($request->id);
        $character->addLettering($lettering);
        
        return 'ok';
    }
    
    public function addBenefice(Request $request, Character $character)
    {
        $benefice = Benefice::find($request->id);
        $options = ['value' => $request->level, 'type' => $request->type];
        $character->addBenefice($benefice, $options);
        
        return 'ok';
    }
    
    public function addHandicap(Request $request, Character $character)
    {
        $handicap = Handicap::find($request->id);
        $options = ['value' => $request->level, 'type' => $request->type];
        $character->addHandicap($handicap, $options);
        
        return 'ok';
    }
    
    public function addMagictrick(Request $request, Character $character)
    {
        $magictrick = Magictrick::find($request->id);
        $character->addMagictrick($magictrick);
        
        return 'ok';
    }
    
    public function removeLanguage(Request $request, Character $character)
    {
        $id = $request->id;
        $character->languages()->detach($id);
        
        return 'ok';
    }
    
    public function removeLettering(Request $request, Character $character)
    {
        $id = $request->id;
        $character->letterings()->detach($id);
        
        return 'ok';
    }
    
    public function removeBenefice(Request $request, Character $character)
    {
        $id = $request->id;
        $character->benefices()->detach($id);
        
        return 'ok';
    }
    
    public function removeHandicap(Request $request, Character $character)
    {
        $id = $request->id;
        $character->handicaps()->detach($id);
        
        return 'ok';
    }
    
    public function removeMagictrick(Request $request, Character $character)
    {
        $id = $request->id;
        $character->magictricks()->detach($id);
        
        return 'ok';
    }
}