<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\MillInterface;
use App\Http\Requests\Mill\MillFormRequest;
use App\Http\Requests\Mill\MillFilterRequest;


class MillController extends Controller{



    protected $mill_repo;



    public function __construct(MillInterface $mill_repo){
        $this->mill_repo = $mill_repo;
        parent::__construct();
    }



    
    public function index(MillFilterRequest $request){

        $mills = $this->mill_repo->fetch($request);
        $request->flash();
        return view('dashboard.mill.index')->with('mills', $mills);

    }

    


    public function create(){
        return view('dashboard.mill.create');
    }


   

    public function store(MillFormRequest $request){

        $mill = $this->mill_repo->store($request);
        
        $this->event->fire('mill.store');
        return redirect()->back();

    }
 



    public function edit($slug){

        $mill = $this->mill_repo->findbySlug($slug);
        return view('dashboard.mill.edit')->with('mill', $mill);

    }




    public function update(MillFormRequest $request, $slug){

        $mill = $this->mill_repo->update($request, $slug);

        $this->event->fire('mill.update', $mill);
        return redirect()->route('dashboard.mill.index');

    }

    


    public function destroy($slug){

        $mill = $this->mill_repo->destroy($slug);
        $this->event->fire('mill.destroy', $mill);
        return redirect()->back();

    }




    public function reports(){
        return view('dashboard.mill.reports');
    }


    
}
