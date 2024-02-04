<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CommonService
{
    /**
     * 既存のファイルを削除し、新しいファイルを指定したパスに保存します。
     *
     * @param  string|null  $oldFile 削除する既存のファイルのパス。ファイルが存在しない場合はnull。
     * @param  UploadedFile  $newFile 保存する新しいファイルのインスタンス。
     * @param  string  $path 新しいファイルを保存するパス。
     * @return string 保存した新しいファイルのパスを返します。
     */
    public function savaFile(?string $oldFile, UploadedFile $newFile, string $path): string
    {
        if ($oldFile) {
            Storage::delete($oldFile);
        }

        return Storage::putFile($path, $newFile);
    }
}
