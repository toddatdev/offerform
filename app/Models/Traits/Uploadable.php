<?php


namespace App\Models\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait Uploadable
{

    public function upload($file, $column, $visibility = 'public')
    {
        $this->removeUpload($column, $visibility);
        if ($file) {
            $this->{$column} = $file->store(get_class_name($this), $visibility);
        }
        return $this;
    }

    public function removeUpload($column, $visibility = 'public') {
        $path = storage_path(($visibility === 'public' ? "app/public" : "app") . $this->{$column});

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
