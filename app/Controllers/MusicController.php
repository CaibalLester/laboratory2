<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MusicController extends BaseController
{
    private $music;

    public function __construct()
    {
        $this->music = new \App\Models\MusicModel();
    }

    public function music($music)
    {
        echo $music;
    }

    public function CaibalLester()
    {
        $data['music'] = $this->music->findAll();
        return view('musics', $data);
    }

   
    public function save()
    {
        
        $data = [
            'name' => $this->request->getVar('name'),
            'audio' => $this->request->getVar('audio'),
        ];
            
                    $this->music->insert($data);
                   
                return redirect()->to('/music');
    }

    public function edit($id)
    {
        $data = [
        'music' => $this->music->findAll(),
        'pro' => $this->music->where('id', $id)->first(),
        ];
        return view('musics', $data);
    }

    public function index()
    {
        //
    }
}
