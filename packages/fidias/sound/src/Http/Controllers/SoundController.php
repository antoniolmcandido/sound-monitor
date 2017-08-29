<?php

namespace Fidias\Sound\Http\Controllers;

use App\Http\Controllers\AbstractMonitorController;
use Illuminate\Http\Request;
use App\Monitor;

class SoundController extends AbstractMonitorController
{
    protected $rules = [
        'description' => 'required|max:255',
        'min' => 'required|numeric',
        'max' => 'required|numeric',
    ];

    public function create()
    {
        $title = 'Criar Novo Monitor de Ruidos Sonoros';
        $model = null;
        return view('sound::save', [
            'title' => $title,
            'model' => $model,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $result = $request->toArray();
        $result['type'] = 'sound';
        $monitor = $this->_save($result);
        flash('Monitor de Ruidos Sonoros criado com Sucesso!')->success()->important();
        return redirect("/monitor/{$monitor->id}");
    }

    public function edit($id)
    {
        $monitor = $this->_getMonitor($id);
        $title = 'Editar Monitor de Ruídos Sonoros';

        return view('sound::save', [
            'title' => $title,
            'model' => $this->transformJson($monitor),
        ]);
    }

    /**
     * Create dynamic monitor based on the JSON data.
     * @param  Monitor $monitor
     * @return Monitor
     */
    protected function transformJson(Monitor $monitor)
    {
        $obj = new Monitor();
        $obj->id = $monitor->id;
        $obj->description = $monitor->data['description'];
        $obj->min = $monitor->data['min'];
        $obj->max = $monitor->data['max'];
        return $obj;
    }
}
