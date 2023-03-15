<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageSaver {

    /**
     * Сохранение файлов в хранилище
     *
     * @param UploadedFile $file Файл из формы
     * @param string $directory Директория, куда будет сохранен файл. Например, 'products'
     * @param bool $makeSquare Если true, то изображение будет преобразовано в квадрат со стороной max($width, $height)
     * @param int $width Ширина
     * @param int $height Высота
     * @return string Результат выполнения Storage::url()
     */
    public static function upload(UploadedFile $file, string $directory, bool $makeSquare = true, int $width = 750, int $height = 750): string {
        $stored = $file->store($directory, 'public');
        $absolute_path = Storage::disk('public')->path($stored);

        $image = Image::make($file);

        if($makeSquare) {
            $image->heighten(max($width, $height))
                 ->resizeCanvas(max($width, $height), max($width, $height), bgcolor: 'ffffff');
        } else {
            $image->resizeCanvas($width, $height, bgcolor: 'ffffff');
        }

        $image->save($absolute_path, 100, $file->extension());
        $image->destroy();

        return Storage::url($stored);
    }

}
