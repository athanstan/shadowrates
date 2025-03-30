<?php

namespace App\Livewire;

use App\Livewire\Contracts\ActionContract;
use Livewire\Component;


abstract class ActionComponent extends Component implements ActionContract
{
    abstract public function authorizeAction(): void;
}
