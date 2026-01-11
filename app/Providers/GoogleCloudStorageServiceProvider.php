<?php

namespace App\Providers;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter as FlysystemGoogleCloudStorageAdapter;
use League\Flysystem\GoogleCloudStorage\UniformBucketLevelAccessVisibility;
use League\Flysystem\Visibility;

class GoogleCloudStorageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Storage::extend('gcs', function ($app, array $config) {
            // Normalize/compat keys (Laravel config is usually snake_case)
            $bucketName = Arr::get($config, 'bucket');

            $clientOptions = [];

            if ($keyFilePath = Arr::get($config, 'key_file_path')) {
                $clientOptions['keyFilePath'] = $keyFilePath;
            }

            if ($projectId = Arr::get($config, 'project_id')) {
                $clientOptions['projectId'] = $projectId;
            }

            // Optional, for emulators or custom endpoints
            if ($apiEndpoint = Arr::get($config, 'storage_api_uri')) {
                $clientOptions['apiEndpoint'] = $apiEndpoint;
            }

            $client = new StorageClient($clientOptions);
            $bucket = $client->bucket($bucketName);

            $prefix = Arr::get($config, 'path_prefix', '');

            // Default visibility; with UBLA, we still keep it private and rely on IAM/bucket policy/signed URLs.
            $visibility = Arr::get($config, 'visibility', Visibility::PRIVATE);
            $defaultVisibility = in_array($visibility, [Visibility::PRIVATE, Visibility::PUBLIC], true)
                ? $visibility
                : Visibility::PRIVATE;

            // If UBLA is enabled for the bucket, we must not try to set object ACLs.
            // Allow overriding the handler, but default to the UBLA-safe handler.
            $visibilityHandlerClass = Arr::get($config, 'visibilityHandler');
            $visibilityHandler = $visibilityHandlerClass
                ? new $visibilityHandlerClass()
                : new UniformBucketLevelAccessVisibility();

            $adapter = new FlysystemGoogleCloudStorageAdapter(
                $bucket,
                $prefix,
                $visibilityHandler,
                $defaultVisibility,
            );

            $flysystemConfig = Arr::only($config, ['throw']);

            return new \Illuminate\Filesystem\FilesystemAdapter(
                new Flysystem($adapter, $flysystemConfig),
                $adapter,
                $flysystemConfig,
            );
        });
    }
}

