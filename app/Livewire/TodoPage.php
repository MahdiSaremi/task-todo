<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateTodo;
use App\Models\Note;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class TodoPage extends Component
{
    use WithFileUploads;

    public CreateTodo $form;

    public int $status = 0;

    #[Computed]
    public function users()
    {
        return User::all();
    }

    #[Computed]
    public function notes()
    {
        return Note::latest()
//            ->when($this->status)
//            ->where($this->status == 1)
            ->get();
    }

    public function create()
    {
        $this->form->validate();

        $fileName = time() . '_' . $this->form->attachment->getClientOriginalName();
        $path = $this->form->attachment->storeAs('files', $fileName);

        Note::create([
            'title' => $this->form->title,
            'description' => $this->form->description,
            'date' => $this->form->date,
            'user_id' => $this->form->userId,
            'file' => $path,
        ]);

        $this->form->reset();
        $this->js('document.querySelector("#my_modal_1 form[method=dialog]").submit()');
    }

    public function edit()
    {
        $this->form->title = 'تست';
        $this->js('my_modal_1.showModal()');
    }

    public function render()
    {
        return view('livewire.todo-page');
    }
}
