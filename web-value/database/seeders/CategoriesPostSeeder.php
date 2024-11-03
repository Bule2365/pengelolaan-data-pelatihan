<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_posts')->insert([
            ['category_name' => 'IT & Technology'],
            ['category_name' => 'Business Management'],
            ['category_name' => 'Digital Marketing'],
            ['category_name' => 'Soft Skills'],
            ['category_name' => 'Specialized Skills'],
            ['category_name' => 'Data Science'],
            ['category_name' => 'Cybersecurity'],
            ['category_name' => 'Project Management'],
            ['category_name' => 'Finance & Accounting'],
            ['category_name' => 'Human Resources'],
            ['category_name' => 'Creative Arts & Design'],
            ['category_name' => 'Health & Wellness'],
            ['category_name' => 'Customer Service'],
            ['category_name' => 'Entrepreneurship'],
            ['category_name' => 'Legal & Compliance'],
            ['category_name' => 'Education & Training'],
            ['category_name' => 'Engineering'],
            ['category_name' => 'Manufacturing'],
            ['category_name' => 'Supply Chain & Logistics'],
            ['category_name' => 'Real Estate'],
            ['category_name' => 'Retail Management'],
            ['category_name' => 'Hospitality & Tourism'],
            ['category_name' => 'Sales & Business Development'],
            ['category_name' => 'Consulting'],
            ['category_name' => 'E-commerce'],
            ['category_name' => 'Public Relations'],
            ['category_name' => 'Banking & Financial Services'],
            ['category_name' => 'Administrative Support'],
            ['category_name' => 'Business Development'],
            ['category_name' => 'Legal Services'],
            ['category_name' => 'Technology Management'],
            ['category_name' => 'Product Management'],
            ['category_name' => 'Real Estate Management'],
            ['category_name' => 'Investment & Wealth Management'],
            ['category_name' => 'Supply Chain Management'],
            ['category_name' => 'Media & Communications'],
            ['category_name' => 'Digital Transformation'],
            ['category_name' => 'Entrepreneurship & Startups'],
            ['category_name' => 'Leadership & Strategy'],
            ['category_name' => 'Innovation Management'],
            ['category_name' => 'Customer Experience Management'],
            ['category_name' => 'Change Management'],
            ['category_name' => 'Training & Development'],
            ['category_name' => 'Talent Management'],
            ['category_name' => 'Retail Operations'],
            ['category_name' => 'Business Intelligence'],
            ['category_name' => 'Corporate Governance'],
            ['category_name' => 'Strategic Planning'],
            ['category_name' => 'Operations Management'],
            ['category_name' => 'Personal Development'],
            ['category_name' => 'Sustainability & CSR']
        ]);
    }
}
