<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component {
    protected $prop = [];

    public function __construct($name,$id,$type="text",$label=null,$value=null) {
        $this->prop["id"]         = $id;
        $this->prop["name"]       = $name;
        $this->prop["type"]       = $type;
        $this->prop["label"]      = $label;
        $this->prop["value"]      = $value;
    }

    public function render()
    {
        return view('components.input', $this->prop);
    }
}
