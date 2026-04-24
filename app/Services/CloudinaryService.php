<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key'    => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
                'url' => [
                    'secure' => true,
                ],
            ])
        );
    }

    // Upload image
    public function upload(string $filePath, array $options = []): array
    {
        $result = $this->cloudinary->uploadApi()->upload($filePath, $options);

        return [
            'public_id'  => $result['public_id'],
            'secure_url' => $result['secure_url'],
            'format'     => $result['format'],
            'width'      => $result['width'],
            'height'     => $result['height'],
        ];
    }

    // Delete by public_id
    public function delete(string $publicId): bool
    {
        $result = $this->cloudinary->uploadApi()->destroy($publicId);
        return $result['result'] === 'ok';
    }
}