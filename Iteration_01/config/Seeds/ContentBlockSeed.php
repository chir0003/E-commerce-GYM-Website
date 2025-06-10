<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class ContentBlockSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [

            [
                'parent' => 'home',
                'label' => 'Hero Title',
                'description' => 'The main title text in the hero section of the homepage.',
                'slug' => 'hero-title',
                'type' => 'text',
                'value' => 'FUELING YOUR FITNESS JOURNEY',
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Subtitle',
                'description' => 'The subtitle text under the main hero title.',
                'slug' => 'hero-subtitle',
                'type' => 'text',
                'value' => 'Explore top-tier gym equipment & professional services built for performance and durability.',
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Button 1 Text',
                'description' => 'The text for the first hero button.',
                'slug' => 'hero-button-1-text',
                'type' => 'text',
                'value' => 'Shop Now',
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Button 2 Text',
                'description' => 'The text for the second hero button.',
                'slug' => 'hero-button-2-text',
                'type' => 'text',
                'value' => 'Book Now',
            ],

            [
                'parent' => 'home',
                'slug' => 'hero-image-1',
                'label' => 'Hero Image 1',
                'description' => 'First image for homepage carousel.',
                'type' => 'image',

            ],
            [
                'parent' => 'home',
                'slug' => 'hero-image-2',
                'label' => 'Hero Image 2',
                'description' => 'Second image for homepage carousel.',
                'type' => 'image',
                'value' => '/img/home_equipmentrepair.jpg'  // Store the image URL here
            ],
            [
                'parent' => 'home',
                'slug' => 'hero-image-3',
                'label' => 'Hero Image 3',
                'description' => 'Third image for homepage carousel.',
                'type' => 'image',
                'value' => '/img/d0ndaq2m8cgmyaadlmip.jpg'  // Store the image URL here
            ],

// Address Content Block
            [
                'parent' => 'footer',
                'label' => 'Store Address',
                'description' => 'The physical address of the store shown in the footer.',
                'slug' => 'store-address',
                'type' => 'text',
                'value' => '740/742 Burwood Hwy, Ferntree Gully VIC 3156',
            ],

// Phone Content Block
            [
            'parent' => 'footer',
            'label' => 'Phone Number',
            'description' => 'The contact phone number for the store.',
            'slug' => 'phone-number',
            'type' => 'text',
            'value' => '0412 345 678',
        ],

// Email Content Block
                    [
                    'parent' => 'footer',
                'label' => 'Email Address',
                'description' => 'The contact email for the store.',
                'slug' => 'email-address',
                'type' => 'text',
                'value' => 'paul.powerproshop@gmail.com',
            ],

        // Working Hours Content Block
        [
            'parent' => 'footer',
            'label' => 'Working Hours',
            'description' => 'The working hours of the store shown in the footer.',
            'slug' => 'working-hours',
            'type' => 'text',
            'value' => 'Monday - Friday, 9am - 5pm',
        ]

        ];

        $table = $this->table('content_blocks');
        $table->insert($data)->save();
    }
}
