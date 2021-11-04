<?php

namespace App\Http\Livewire;

use App\Actions\StationsImportAction;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportStations extends Component
{
    use WithFileUploads;

    public $file;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submit()
    {
        $validatedData = $this->validate([
            'file' => 'required',
        ]);

        $fileNameWithExtension = $this->file->getClientOriginalName();

        $this->file->storeAs('files', $fileNameWithExtension);

        $path = Storage::path("files/{$fileNameWithExtension}");

        StationsImportAction::run($path);

        session()->flash('message', 'File successfully Uploaded.');
    }

    public function render()
    {
        return view('livewire.import-stations');
    }
}
