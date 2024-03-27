<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            'title' => 'How To Keep Your Furniture Clean: Tips for a Fresh and Tidy Home',
            'content' => "Introduction:
            Maintaining clean and well-kept furniture not only enhances the aesthetics of your home but also contributes to a healthier living environment. From sofas and chairs to tables and cabinets, each piece of furniture requires specific care to preserve its beauty and functionality. In this guide, we'll explore effective strategies and practical tips to help you keep your furniture clean and looking its best for years to come.
            
            Know Your Furniture:
            Before diving into cleaning, it's essential to understand the materials and finishes of your furniture. Different surfaces such as wood, upholstery, leather, and metal may require unique cleaning methods and products to avoid damage.
            
            Regular Dusting:
            Dust and debris can accumulate on furniture surfaces, dulling their appearance over time. To prevent this buildup, make a habit of dusting your furniture regularly using a soft cloth or microfiber duster. Pay attention to intricate details and crevices where dust tends to settle.
            
            Vacuum Upholstered Surfaces:
            Upholstered furniture, such as sofas and armchairs, can harbor dust, pet dander, and allergens. Use a vacuum cleaner with a soft brush attachment to gently remove surface debris and dirt from upholstery. For deeper cleaning, consider professional upholstery cleaning services periodically.
            
            Spot Cleaning:
            Accidents happen, whether it's spills, stains, or smudges on your furniture. Promptly address stains by blotting them with a clean cloth or paper towel to absorb excess liquid. Avoid rubbing the stain, as this can spread it further. Use appropriate cleaning solutions recommended for the specific type of stain and fabric.
            
            Leather Care:
            Leather furniture adds sophistication and elegance to any space but requires special care to maintain its luster. Regularly wipe leather surfaces with a damp cloth to remove dust and dirt. Use a mild leather cleaner and conditioner to moisturize the leather and prevent it from drying out and cracking.
            
            Protect Wooden Surfaces:
            Wooden furniture can benefit from protective measures to prevent scratches and water damage. Place coasters under beverages and use felt pads or coasters under objects to avoid scratching the surface. Apply furniture polish or wax periodically to nourish the wood and restore its natural shine.
            
            Handle with Care:
            When moving or rearranging furniture, take care to lift and carry it properly to avoid scratching floors or damaging the furniture itself. Use furniture glides or sliders to move heavy pieces smoothly, especially on hardwood or tile floors.
            
            Sunlight Protection:
            Prolonged exposure to sunlight can cause fading and discoloration of furniture upholstery and wood finishes. Position furniture away from direct sunlight or use curtains, blinds, or UV-blocking window films to protect your furniture from sun damage.
            
            Conclusion:
            By following these practical tips and incorporating them into your regular cleaning routine, you can ensure that your furniture remains clean, well-maintained, and beautiful for years to come. With proper care and attention, your furniture will continue to enhance the comfort and style of your home, creating a welcoming environment for family and guests alike.",
            'blog_img' => null,
            'category_id' => 3,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
