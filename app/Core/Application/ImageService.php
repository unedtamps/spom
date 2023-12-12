<?php

namespace App\Core\Application;

use Error;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class ImageService
{
    private UploadedFile $file;
    private string $folderName;
    private int $size_limit;
    private array $type;
    private array $available_mime_type;

    private function generate_file_name(): string
    {
        return Str::orderedUuid();
    }

    private function check_size(int $size)
    {
        if ($size >  $this->size_limit) {
            throw new Error("File Too Big!");
        }
    }

    public function __construct(UploadedFile $file, string $folderName, int $size_limit = 512000)
    {
        $this->file = $file;
        $this->folderName = $folderName;
        $this->size_limit = $size_limit;
        $this->type = ['jpg', 'png', 'jpeg'];
        $this->available_mime_type = [
            "image/jpg",
            "image/jpeg",
            "image/png",
        ];
    }

    public function upload()
    {
        try {
            $this->check_size($this->file->getSize());
            $file_name = $this->generate_file_name();
            error_log($file_name);
            $file_extension = $this->file->getClientOriginalExtension();
            $mime_type = $this->file->getMimeType();
            if (!in_array($mime_type, $this->available_mime_type) || !in_array($file_extension, $this->type)) {
                throw new Error("Invalid Type Or Extension");
            }

            Storage::putFileAs($this->folderName, $this->file, $file_name . '.' . $file_extension);
        } catch (\Throwable $th) {
            error_log($th);
            throw $th;
        }
    }
}
