<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_prices')->insert([
            // Trainer 1
            [
                'training_title' => 'Web Developer',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 1,
            ],
            [
                'training_title' => 'Digital Marketing',
                'price' => 2000000,
                'type_training_id' => 2,
                'trainer_id' => 1,
            ],
            [
                'training_title' => 'Cloud Computing',
                'price' => 10000000,
                'type_training_id' => 2,
                'trainer_id' => 1,
            ],
            [
                'training_title' => 'Customer Experience',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 1,
            ],
            // Trainer 2
            [
                'training_title' => 'Frontend Developer',
                'price' => 4500000,
                'type_training_id' => 2,
                'trainer_id' => 2,
            ],
            [
                'training_title' => 'Data Science',
                'price' => 15000000,
                'type_training_id' => 2,
                'trainer_id' => 2,
            ],
            [
                'training_title' => 'Business Intelligence',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 2,
            ],
            [
                'training_title' => 'Agile Methodology',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 2,
            ],
            // Trainer 3
            [
                'training_title' => 'Data Analys',
                'price' => 8000000,
                'type_training_id' => 2,
                'trainer_id' => 3,
            ],
            [
                'training_title' => 'Big Data Analys',
                'price' => 50000000,
                'type_training_id' => 2,
                'trainer_id' => 3,
            ],
            [
                'training_title' => 'Digital Transformation',
                'price' => 16000000,
                'type_training_id' => 2,
                'trainer_id' => 3,
            ],
            [
                'training_title' => 'Data Visualization',
                'price' => 6500000,
                'type_training_id' => 2,
                'trainer_id' => 3,
            ],
            // Trainer 4
            [
                'training_title' => 'Backend Developer',
                'price' => 8000000,
                'type_training_id' => 2,
                'trainer_id' => 4,
            ],
            [
                'training_title' => 'Ethical Hacking',
                'price' => 11000000,
                'type_training_id' => 2,
                'trainer_id' => 4,
            ],
            [
                'training_title' => 'Advanced Python Programming',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 4,
            ],
            [
                'training_title' => 'Blockchain Basics',
                'price' => 9000000,
                'type_training_id' => 2,
                'trainer_id' => 4,
            ],
            // Trainer 5
            [
                'training_title' => 'Machine Learning',
                'price' => 12000000,
                'type_training_id' => 2,
                'trainer_id' => 5,
            ],
            [
                'training_title' => 'Sales Techniques',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 5,
            ],
            [
                'training_title' => 'Leadership Skills',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 5,
            ],
            [
                'training_title' => 'CRM Systems',
                'price' => 7200000,
                'type_training_id' => 2,
                'trainer_id' => 5,
            ],
            // Trainer 6
            [
                'training_title' => 'Data Science',
                'price' => 15000000,
                'type_training_id' => 2,
                'trainer_id' => 6,
            ],
            [
                'training_title' => 'Content Creation',
                'price' => 6500000,
                'type_training_id' => 2,
                'trainer_id' => 6,
            ],
            [
                'training_title' => 'Human Resources',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 6,
            ],
            [
                'training_title' => 'Digital Marketing Strategy',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 6,
            ],
            // Trainer 7
            [
                'training_title' => 'Cloud Computing',
                'price' => 10000000,
                'type_training_id' => 2,
                'trainer_id' => 7,
            ],
            [
                'training_title' => 'Network Administration',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 7,
            ],
            [
                'training_title' => 'Advanced SQL Databases',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 7,
            ],
            [
                'training_title' => 'Salesforce Training',
                'price' => 9500000,
                'type_training_id' => 2,
                'trainer_id' => 7,
            ],
            // Trainer 8
            [
                'training_title' => 'Cyber Security',
                'price' => 9000000,
                'type_training_id' => 2,
                'trainer_id' => 8,
            ],
            [
                'training_title' => 'Public Speaking',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 8,
            ],
            [
                'training_title' => 'Creative Writing',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 8,
            ],
            [
                'training_title' => 'Social Media Management',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 8,
            ],
            // Trainer 9
            [
                'training_title' => 'Business Intelligence',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 9,
            ],
            [
                'training_title' => 'Project Management',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 9,
            ],
            [
                'training_title' => 'SEO Optimization',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 9,
            ],
            [
                'training_title' => 'Marketing Strategy',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 9,
            ],
            // Trainer 10
            [
                'training_title' => 'UI/UX Design',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 10,
            ],
            [
                'training_title' => 'Photography Basics',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 10,
            ],
            [
                'training_title' => 'Event Planning',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 10,
            ],
            [
                'training_title' => 'Customer Experience',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 10,
            ],
            // Trainer 11
            [
                'training_title' => 'Project Management',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 11,
            ],
            [
                'training_title' => 'Negotiation Skills',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 11,
            ],
            [
                'training_title' => 'Change Management',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 11,
            ],
            [
                'training_title' => 'Financial Management',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 11,
            ],
            // Trainer 12
            [
                'training_title' => 'Ethical Hacking',
                'price' => 11000000,
                'type_training_id' => 2,
                'trainer_id' => 12,
            ],
            [
                'training_title' => 'SaaS Solutions',
                'price' => 8000000,
                'type_training_id' => 2,
                'trainer_id' => 12,
            ],
            [
                'training_title' => 'Advanced Python Programming',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 12,
            ],
            [
                'training_title' => 'Cloud Computing',
                'price' => 10000000,
                'type_training_id' => 2,
                'trainer_id' => 12,
            ],
            // Trainer 13
            [
                'training_title' => 'ITIL Foundation',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 13,
            ],
            [
                'training_title' => 'Artificial Intelligence',
                'price' => 14000000,
                'type_training_id' => 2,
                'trainer_id' => 13,
            ],
            [
                'training_title' => 'Leadership Skills',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 13,
            ],
            [
                'training_title' => 'Photography Basics',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 13,
            ],
            // Trainer 14
            [
                'training_title' => 'DevOps',
                'price' => 13000000,
                'type_training_id' => 2,
                'trainer_id' => 14,
            ],
            [
                'training_title' => 'Data Visualization',
                'price' => 6500000,
                'type_training_id' => 2,
                'trainer_id' => 14,
            ],
            [
                'training_title' => 'Product Management',
                'price' => 9000000,
                'type_training_id' => 2,
                'trainer_id' => 14,
            ],
            [
                'training_title' => 'Sales Techniques',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 14,
            ],
            // Trainer 15
            [
                'training_title' => 'Blockchain Basics',
                'price' => 9000000,
                'type_training_id' => 2,
                'trainer_id' => 15,
            ],
            [
                'training_title' => 'Negotiation Skills',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 15,
            ],
            [
                'training_title' => 'Creative Writing',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 15,
            ],
            [
                'training_title' => 'Customer Experience',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 15,
            ],
            // Trainer 16
            [
                'training_title' => 'Mobile App Development',
                'price' => 8500000,
                'type_training_id' => 2,
                'trainer_id' => 16,
            ],
            [
                'training_title' => 'Data Science',
                'price' => 15000000,
                'type_training_id' => 2,
                'trainer_id' => 16,
            ],
            [
                'training_title' => 'Cloud Computing',
                'price' => 10000000,
                'type_training_id' => 2,
                'trainer_id' => 16,
            ],
            [
                'training_title' => 'SEO Optimization',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 16,
            ],
            // Trainer 17
            [
                'training_title' => 'Artificial Intelligence',
                'price' => 14000000,
                'type_training_id' => 2,
                'trainer_id' => 17,
            ],
            [
                'training_title' => 'Digital Marketing',
                'price' => 2000000,
                'type_training_id' => 2,
                'trainer_id' => 17,
            ],
            [
                'training_title' => 'Machine Learning',
                'price' => 12000000,
                'type_training_id' => 2,
                'trainer_id' => 17,
            ],
            [
                'training_title' => 'Change Management',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 17,
            ],
            // Trainer 18
            [
                'training_title' => 'Digital Transformation',
                'price' => 16000000,
                'type_training_id' => 2,
                'trainer_id' => 18,
            ],
            [
                'training_title' => 'Business Intelligence',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 18,
            ],
            [
                'training_title' => 'UI/UX Design',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 18,
            ],
            [
                'training_title' => 'Data Visualization',
                'price' => 6500000,
                'type_training_id' => 2,
                'trainer_id' => 18,
            ],
            // Trainer 19
            [
                'training_title' => 'SQL Databases',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 19,
            ],
            [
                'training_title' => 'Network Administration',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 19,
            ],
            [
                'training_title' => 'Creative Writing',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 19,
            ],
            [
                'training_title' => 'CRM Systems',
                'price' => 7200000,
                'type_training_id' => 2,
                'trainer_id' => 19,
            ],
            // Trainer 20
            [
                'training_title' => 'Salesforce Training',
                'price' => 9500000,
                'type_training_id' => 2,
                'trainer_id' => 20,
            ],
            [
                'training_title' => 'Event Planning',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 20,
            ],
            [
                'training_title' => 'Customer Experience',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 20,
            ],
            [
                'training_title' => 'Data Science',
                'price' => 15000000,
                'type_training_id' => 2,
                'trainer_id' => 20,
            ],
            // Trainer 21
            [
                'training_title' => 'Agile Methodology',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 21,
            ],
            [
                'training_title' => 'Leadership Skills',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 21,
            ],
            [
                'training_title' => 'Public Speaking',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 21,
            ],
            [
                'training_title' => 'Creative Writing',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 21,
            ],
            // Trainer 22
            [
                'training_title' => 'Advanced Python Programming',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 22,
            ],
            [
                'training_title' => 'Data Visualization',
                'price' => 6500000,
                'type_training_id' => 2,
                'trainer_id' => 22,
            ],
            [
                'training_title' => 'Digital Marketing Strategy',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 22,
            ],
            [
                'training_title' => 'Photography Basics',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 22,
            ],
            // Trainer 23
            [
                'training_title' => 'SaaS Solutions',
                'price' => 8000000,
                'type_training_id' => 2,
                'trainer_id' => 23,
            ],
            [
                'training_title' => 'Customer Experience',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 23,
            ],
            [
                'training_title' => 'Sales Techniques',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 23,
            ],
            [
                'training_title' => 'Cloud Computing',
                'price' => 10000000,
                'type_training_id' => 2,
                'trainer_id' => 23,
            ],
            // Trainer 24
            [
                'training_title' => 'Business Intelligence',
                'price' => 7500000,
                'type_training_id' => 2,
                'trainer_id' => 24,
            ],
            [
                'training_title' => 'Leadership Skills',
                'price' => 5500000,
                'type_training_id' => 2,
                'trainer_id' => 24,
            ],
            [
                'training_title' => 'Public Speaking',
                'price' => 5000000,
                'type_training_id' => 2,
                'trainer_id' => 24,
            ],
            [
                'training_title' => 'Data Science',
                'price' => 15000000,
                'type_training_id' => 2,
                'trainer_id' => 24,
            ],
            // Trainer 25
            [
                'training_title' => 'SEO Optimization',
                'price' => 7000000,
                'type_training_id' => 2,
                'trainer_id' => 25,
            ],
            [
                'training_title' => 'Blockchain Basics',
                'price' => 9000000,
                'type_training_id' => 2,
                'trainer_id' => 25,
            ],
            [
                'training_title' => 'Sales Techniques',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 25,
            ],
            [
                'training_title' => 'Advanced SQL Databases',
                'price' => 6000000,
                'type_training_id' => 2,
                'trainer_id' => 25,
            ],
        ]);
    }
}
