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
     * @param int $squareSide Сторона квадрата (итоговая ширина и высота изображения)
     * @return string Результат выполнения Storage::url()
     */
    public static function upload(UploadedFile $file, string $directory, int $squareSide = 750): string {
        $stored = $file->store($directory, 'public');
        $absolute_path = Storage::disk('public')->path($stored);

        $image = Image::make($file)
            ->heighten($squareSide)
            ->resizeCanvas($squareSide, $squareSide, 'center', false, 'ffffff');

        $image->save($absolute_path, 100, $file->extension());
        $image->destroy();

        return Storage::url($stored);
    }

}
