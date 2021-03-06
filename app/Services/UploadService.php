<?php
declare(strict_types=1);
namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;

class UploadService
{
    public function saveFile(UploadedFile $file): string
    {
        $status = $file->storeAs('news',$file->hashName(),'public');
        if(!$status) {
            throw new Exception("File wasn't upload");
        }
        return $status;
    }
}
