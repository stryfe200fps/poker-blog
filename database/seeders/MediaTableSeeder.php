<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('media')->delete();

        \DB::table('media')->insert([
            0 => [
                'id' => 1,
                'model_type' => 'App\\Models\\Article',
                'model_id' => 1,
                'uuid' => 'b1fa06fc-5187-4331-ad06-36df1f5d5683',
                'collection_name' => 'article',
                'name' => 'medEC84',
                'file_name' => 'medEC84.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 166531,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"featured-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 07:32:19',
                'updated_at' => '2022-09-18 07:32:20',
            ],
            1 => [
                'id' => 2,
                'model_type' => 'App\\Models\\Article',
                'model_id' => 2,
                'uuid' => '66fcd2cc-5ede-4264-902e-b80bb3009ac1',
                'collection_name' => 'article',
                'name' => 'med31D0',
                'file_name' => 'med31D0.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 153174,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"featured-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 07:50:05',
                'updated_at' => '2022-09-18 07:50:06',
            ],
            2 => [
                'id' => 3,
                'model_type' => 'App\\Models\\Article',
                'model_id' => 3,
                'uuid' => 'c1483a61-9ea3-4ed5-a8b9-7e3006925f66',
                'collection_name' => 'article',
                'name' => 'medD5D0',
                'file_name' => 'medD5D0.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 148319,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"featured-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 07:55:09',
                'updated_at' => '2022-09-18 07:55:10',
            ],
            3 => [
                'id' => 4,
                'model_type' => 'App\\Models\\Article',
                'model_id' => 4,
                'uuid' => '3f3fe867-9746-44bb-8c2d-3493acf4ccda',
                'collection_name' => 'article',
                'name' => 'medDAAB',
                'file_name' => 'medDAAB.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 139555,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"featured-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 07:57:22',
                'updated_at' => '2022-09-18 07:57:22',
            ],
            4 => [
                'id' => 5,
                'model_type' => 'App\\Models\\Article',
                'model_id' => 5,
                'uuid' => '54c2783f-8dae-43da-9e6e-5be066b54850',
                'collection_name' => 'article',
                'name' => 'medF5FE',
                'file_name' => 'medF5FE.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 139443,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"featured-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 08:02:56',
                'updated_at' => '2022-09-18 08:02:57',
            ],
            5 => [
                'id' => 6,
                'model_type' => 'App\\Models\\Tour',
                'model_id' => 6,
                'uuid' => '97b281b3-1286-4a25-abee-3f7401ac769a',
                'collection_name' => 'poker_tours',
                'name' => 'med8DE0',
                'file_name' => 'med8DE0.tmp',
                'mime_type' => 'image/png',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 55894,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:00:23',
                'updated_at' => '2022-09-18 09:00:24',
            ],
            6 => [
                'id' => 7,
                'model_type' => 'App\\Models\\Tournament',
                'model_id' => 6,
                'uuid' => '6593e457-d731-4808-b748-1cc4bd1546ea',
                'collection_name' => 'poker_tournaments',
                'name' => 'med7047',
                'file_name' => 'med7047.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 90062,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"featured-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:07:54',
                'updated_at' => '2022-09-18 09:07:55',
            ],
            7 => [
                'id' => 8,
                'model_type' => 'App\\Models\\PokerEvent',
                'model_id' => 6,
                'uuid' => '164a1e65-6008-4357-99e0-beb814fd2f29',
                'collection_name' => 'event_banner',
                'name' => 'med5B1A',
                'file_name' => 'med5B1A.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 41362,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"banner":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:15:28',
                'updated_at' => '2022-09-18 09:15:28',
            ],
            8 => [
                'id' => 9,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 5,
                'uuid' => '88dee605-7979-4d44-9d06-8ab5d0b9ff23',
                'collection_name' => 'logo',
                'name' => 'medFE4',
                'file_name' => 'medFE4.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 517500,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:23:53',
                'updated_at' => '2022-09-18 09:23:54',
            ],
            9 => [
                'id' => 10,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 9,
                'uuid' => '74e62498-09e1-40fd-8a51-f78d24575aa1',
                'collection_name' => 'logo',
                'name' => 'med571E',
                'file_name' => 'med571E.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 155460,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:50:24',
                'updated_at' => '2022-09-18 09:50:25',
            ],
            10 => [
                'id' => 11,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 10,
                'uuid' => 'c80febef-bd5c-4f09-bea5-fc21637051a9',
                'collection_name' => 'logo',
                'name' => 'med5966',
                'file_name' => 'med5966.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 226067,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:53:41',
                'updated_at' => '2022-09-18 09:53:42',
            ],
            11 => [
                'id' => 12,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 11,
                'uuid' => '0cb9dbea-c50c-4c2d-a690-3595f4bf3436',
                'collection_name' => 'logo',
                'name' => 'med2B31',
                'file_name' => 'med2B31.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 989412,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 09:54:35',
                'updated_at' => '2022-09-18 09:54:37',
            ],
            12 => [
                'id' => 13,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 15,
                'uuid' => '9de18c3d-8399-4c4a-b52d-25508af15157',
                'collection_name' => 'logo',
                'name' => 'medC591',
                'file_name' => 'medC591.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 194354,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 10:20:21',
                'updated_at' => '2022-09-18 10:20:23',
            ],
            13 => [
                'id' => 14,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 16,
                'uuid' => '6db52154-0cfa-481c-98ca-d1a1cd8107db',
                'collection_name' => 'logo',
                'name' => 'med16DC',
                'file_name' => 'med16DC.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 199021,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 10:21:48',
                'updated_at' => '2022-09-18 10:21:49',
            ],
            14 => [
                'id' => 15,
                'model_type' => 'App\\Models\\LiveReport',
                'model_id' => 17,
                'uuid' => '189576d0-e6b5-4efe-9095-7e058c0004cd',
                'collection_name' => 'logo',
                'name' => 'med5FFB',
                'file_name' => 'med5FFB.tmp',
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => 156848,
                'manipulations' => '[]',
                'custom_properties' => '[]',
                'generated_conversions' => '{"img-logo":true,"main-image":true}',
                'responsive_images' => '[]',
                'order_column' => 1,
                'created_at' => '2022-09-18 10:23:12',
                'updated_at' => '2022-09-18 10:23:13',
            ],
        ]);
    }
}
