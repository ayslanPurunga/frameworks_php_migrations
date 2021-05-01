<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AulaController extends Controller
{

    public function __construct(){
        if (!Session::has('aulas')) {
            Session::put('aulas', []);
        }
    }


    public function index()
    {
        return view(
            'aula.index',
            [ 
                'materias' => Session::get('aulas')
            ]    
            
        );
    }

    public function create() {
        return view(
            'aula.create',
            [
                'dias' => $this->getDias()
            ],
            [
                'horarios' => $this->getHorarios()
            ]
        );
    }

    public function store(Request $request)
    {
        $aula = new Aula();
        $aula->id = count(Session::get('aulas'))+1;
        $aula->descricao = $request->descricao;
        $aula->dia = $request->dia;
        $aula->horario = $request->horario;
        Session::push('aulas', $aula);
        return redirect('aulas');
    }

    protected function getDias() {
        return [
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
        ];
    }
    
    protected function getHorarios() {
        return [
            '19:00',
            '19:15',
            '19:30',
        ];
    }

    public function edit($id)
    {
        $aula = $this->findAula($id);
        
        if($aula === null)
            return abort(404);

        return view(
            'aula.edit',
            [
                'dias' => $this->getDias(),
                'horarios' => $this->getHorarios(),
                'aula' => $aula
            ]
        );
    }

    private function findAula($id)
    {
        $index = $this->indexOfAula($id);
        if($this->indexOfAula($id) === -1) {
            return null;
        }

        return Session::get('aulas') [$index];
    }

    private function indexOfAula($id)
    {
        return array_reduce(Session::get('aulas'), function($atual, $item) use ($id){
            return ($item->id == $id) ? array_search($item, Session::get('aulas')) : $atual;
        }, -1);
    }

    public function update ($id, Request $request) {
        $aula = $this->findAula($id);
        $aula->descrica = $request->descricao;
        $aula->dia = $request->dia;
        $aula->horario = $request->horario;
        $this->updateAula($aula);
        return redirect('aulas');
    }  

    private function updateAula($aula)
    {
        $aulas = Session::get('aulas');
        $index = $this->indexOfAula($aula->id);
        $aulas[$index] = $aula;
        Session::put('aulas', $aulas);
    }

    public function destroy($id)
    {
        $aulas = Session::get('aulas');
        $index = $this->indexOfAula($id);
        unset($index[$index]);
        Session::put('aulas', $aulas);
        return redirect('aulas');
    } 
}
