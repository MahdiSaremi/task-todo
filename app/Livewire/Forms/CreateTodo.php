<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class CreateTodo extends Form
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'string', 'max:2048'])]
    public string $description = '';

    #[Validate(['required', 'date'])]
    public ?Carbon $date = null;

    #[Validate(['required', 'integer', 'exists:users,id'])]
    public ?int $userId = null;

    #[Validate(['required', 'file', 'max:1024'])]
    public $attachment = null;

    public function __construct(Component $component, $propertyName)
    {
        parent::__construct($component, $propertyName);
    }
}
