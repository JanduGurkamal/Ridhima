<?php

namespace Database\Seeders;

use App\Models\ContactSubmission;
use Illuminate\Database\Seeder;

class ContactSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $submissions = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'subject' => 'Inquiry about "Sunset Over Mountains"',
                'message' => 'Hello! I\'m very interested in purchasing "Sunset Over Mountains". Could you please provide more information about the artwork and availability? Thank you!',
                'status' => 'new',
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'mchen@email.com',
                'subject' => 'Commission Request',
                'message' => 'I would like to commission a portrait painting. Could we discuss the details and timeline? I\'m looking for something similar to "Portrait of Silence" in style.',
                'status' => 'read',
            ],
            [
                'name' => 'Emily Rodriguez',
                'email' => 'emily.r@email.com',
                'subject' => 'Gallery Representation Inquiry',
                'message' => 'I represent a gallery in Miami and would be interested in featuring your work. Would you be available for a conversation about potential collaboration?',
                'status' => 'replied',
                'admin_notes' => 'Sent gallery information and portfolio. Follow up scheduled.',
            ],
            [
                'name' => 'David Thompson',
                'email' => 'dthompson@email.com',
                'subject' => 'Workshop Inquiry',
                'message' => 'Do you offer any workshops or classes? I\'m an aspiring artist and would love to learn your techniques, especially your approach to color and light.',
                'status' => 'read',
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.a@email.com',
                'subject' => 'Exhibition Opening',
                'message' => 'I attended your recent exhibition and was blown away by your work! "Abstract Harmony" is particularly stunning. Do you have any upcoming shows?',
                'status' => 'replied',
                'admin_notes' => 'Thanked for attending. Shared information about upcoming exhibition.',
            ],
            [
                'name' => 'Robert Kim',
                'email' => 'rkim@email.com',
                'subject' => 'Artwork Availability',
                'message' => 'Is "Urban Reflections" still available? I saw it on your website and it would be perfect for my office space. Please let me know pricing and shipping options.',
                'status' => 'new',
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'j.martinez@email.com',
                'subject' => 'Press Inquiry',
                'message' => 'I\'m a writer for Art Today magazine and would like to feature your work in an upcoming article about contemporary landscape painting. Could we schedule an interview?',
                'status' => 'read',
            ],
            [
                'name' => 'James Wilson',
                'email' => 'jwilson@email.com',
                'subject' => 'Thank You',
                'message' => 'I just wanted to thank you for the beautiful painting I purchased. It brings me so much joy every day. Your work is truly inspiring!',
                'status' => 'archived',
                'admin_notes' => 'Thank you note from satisfied customer.',
            ],
        ];

        foreach ($submissions as $submission) {
            ContactSubmission::create($submission);
        }
    }
}

