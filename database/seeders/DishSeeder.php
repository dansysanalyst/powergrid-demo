<?php

namespace Database\Seeders;

use App\Enums\CookingMethod;
use App\Enums\Diet;
use App\Enums\NutriScore;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Dish;
use App\Models\Kitchen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Lottery;

class DishSeeder extends Seeder
{
    public function run()
    {
        $kitchens   = Kitchen::all();
        $categories = Category::all();
        $chefs      = Chef::all();

        $this->dishes()->each(function ($dish) use ($kitchens, $categories, $chefs) {
            Dish::create([
                'chef_id'        => Lottery::odds(1, 3)->winner(fn () => $chefs->random()->id)->loser(fn () => null)->choose(),
                'rating'         => fake()->numberBetween(1, 5),
                'kitchen_id'     => $kitchens->random()->id,
                'category_id'    => $categories->random()->id,
                'price'          => $dish['price'] ?? fake()->randomFloat(2, 50, 280),
                'calories'       => fake()->biasedNumberBetween(40, 890, 'sqrt'),
                'produced_at'    => fake()->dateTimeBetween('-1 months', now())->format('Y-m-d'),
                'diet'           => fake()->randomElement(Diet::cases())->value,
                'nutri_score'    => fake()->randomElement(NutriScore::cases())->name,
                'cooking_method' => fake()->randomElement(CookingMethod::cases())->value,
                'in_stock'       => fake()->boolean(),
                'serving_at'     => fake()->randomElement(['restaurant', 'room service', 'pool bar']),
                'created_at'     => fake()->dateTimeBetween('-2 months', now()),
                ...$dish,
            ]);
        });

        rescue(fn () => Dish::findOrFail(40)->delete(), report: false);
    }

    /**
     * Dishes dataset
     *
     * @credit https://github.com/lk-geimfari/mimesis/blob/master/mimesis/data/en/food.json
     */
    public function dishes(): Collection
    {
        return collect([
            ['name' => 'Arkansas Possum Pie'],
            ['name' => 'Albacore Tuna Melt'],
            ['name' => 'борщ', 'category_id' => 7, 'chef_id' => 2, 'price' => 100.19],
            ['name' => 'Bacalhau com natas'],
            ['name' => 'Baba Ghanoush'],
            ['name' => 'Bacon Cheeseburger'],
            ['name' => 'Baked potato'],
            ['name' => 'Baklava'],
            ['name' => 'Bangers and mash'],
            ['name' => 'Black Pudding'],
            ['name' => 'Blue cheese dressing'],
            ['name' => 'Boulliabaise'],
            ['name' => 'Bread'],
            ['name' => 'Breaded shrimp'],
            ['name' => 'Breakfast burrito'],
            ['name' => 'Brisket'],
            ['name' => 'Brunswick stew'],
            ['name' => 'Bruschetta'],
            ['name' => 'Buffalo Wings'],
            ['name' => 'Buffalo burger'],
            ['name' => 'Buffalo wing'],
            ['name' => 'Calamari'],
            ['name' => 'Carne pizzaiola'],
            ['name' => 'Caviar'],
            ['name' => 'Ceviche'],
            ['name' => 'Cheesecake'],
            ['name' => 'Chicken Biryani'],
            ['name' => 'Chicken Tikka Masala'],
            ['name' => 'Chicken and waffles'],
            ['name' => 'Chicken bog'],
            ['name' => 'Chicken fingers'],
            ['name' => 'Chile Relleno'],
            ['name' => 'Chili con carne'],
            ['name' => 'Chili dog'],
            ['name' => 'Chimichanga'],
            ['name' => 'Chinese food'],
            ['name' => 'Chips and dip'],
            ['name' => 'Choco pie'],
            ['name' => 'Chocolate Brownie'],
            ['name' => '-- Soft Deleted --'],
            ['name' => 'Chocolate cheesecake'],
            ['name' => 'Chowder'],
            ['name' => 'Churrasco'],
            ['name' => 'Cinnamon Roll'],
            ['name' => 'Coleslaw'],
            ['name' => 'Coq Au Vin'],
            ['name' => 'Cordon bleu'],
            ['name' => 'Currywurst'],
            ['name' => 'Eggo'],
            ['name' => 'Eggs Benedict'],
            ['name' => 'Eggs Neptune'],
            ['name' => 'Empanada'],
            ['name' => 'Energy bar'],
            ['name' => 'Escargot'],
            ['name' => 'Fajitas'],
            ['name' => 'Falafel'],
            ['name' => 'Fattoush Salad'],
            ['name' => 'Fish Tacos'],
            ['name' => 'Fish and Chips!'],
            ['name' => 'Flan'],
            ['name' => 'Fortune cookie'],
            ['name' => 'Francesinha', 'category_id' => 1, 'chef_id' => 2, 'price' => 100.15, 'in_stock' => true],
            ['name' => 'French Onion Soup'],
            ['name' => 'Fries'],
            ['name' => 'Frito Pie'],
            ['name' => 'Fry sauce'],
            ['name' => 'Funnel Cake'],
            ['name' => 'Garden salad'],
            ['name' => 'Garlic bread'],
            ['name' => 'Gazpacho'],
            ['name' => 'Goulash'],
            ['name' => 'Greek salad'],
            ['name' => 'Grilled Snake'],
            ['name' => 'γύρος'],
            ['name' => 'Gumbo'],
            ['name' => 'Gyoza'],
            ['name' => 'Huevos Rancheros'],
            ['name' => 'Hummus'],
            ['name' => 'Ice Cream'],
            ['name' => 'Key Lime Pie'],
            ['name' => 'Kimchi'],
            ['name' => 'Kobe Beef'],
            ['name' => 'Kung Pao Chicken'],
            ['name' => 'Laksa'],
            ['name' => 'Lasagna'],
            ['name' => 'Liver and onions'],
            ['name' => 'Lobster Newberg'],
            ['name' => 'Lobster roll'],
            ['name' => 'London broil'],
            ['name' => 'Lorna Doone'],
            ['name' => 'Low Country Boil'],
            ['name' => 'Macaroni and Cheese'],
            ['name' => 'Macaroni and cheese'],
            ['name' => 'Macaroni salad'],
            ['name' => 'Maine Lobster'],
            ['name' => 'Mango and Sticky Rice'],
            ['name' => 'Maple Bacon Doughnut'],
            ['name' => 'Maple bacon donut', 'chef_id' => 3],
            ['name' => 'Maraca pie'],
            ['name' => 'Margherita Pizza'],
            ['name' => 'Mashed potato'],
            ['name' => 'Mashed pumpkin'],
            ['name' => 'Massaman Curry'],
            ['name' => 'Matzo Ball Soup'],
            ['name' => 'Meat Feast Pizza'],
            ['name' => 'Meatcake'],
            ['name' => 'Meatloaf'],
            ['name' => 'Milkshake'],
            ['name' => 'Mini pizzas'],
            ['name' => 'Mozzarella sticks'],
            ['name' => 'Muffuletta'],
            ['name' => 'Mulligan stew'],
            ['name' => 'Naan'],
            ['name' => 'New York-Style Pizza', 'chef_id' => 2],
            ['name' => 'Onion Rings'],
            ['name' => 'Oreo'],
            ['name' => 'Osso Buco'],
            ['name' => 'Paella'],
            ['name' => 'Pancakes'],
            ['name' => 'Parma Ham'],
            ['name' => 'Pasta salad'],
            ['name' => 'Pastel de Nata', 'category_id' => 6, 'chef_id' => 3, 'price' => 100.10, 'in_stock' => true],
            ['name' => 'Pastrami'],
            ['name' => 'Pastrami on Rye'],
            ['name' => 'Patty'],
            ['name' => 'Peixada da chef Nábia', 'category_id' => 1, 'chef_id' => 4, 'price' => 100.11, 'in_stock' => true],
            ['name' => 'Peanut butter'],
            ['name' => 'Pemmican'],
            ['name' => 'Pepperoni'],
            ['name' => 'Pepperoni Pizza'],
            ['name' => 'Phaal'],
            ['name' => 'Philly Cheese Steak', 'chef_id' => 3],
            ['name' => 'Polenta'],
            ['name' => 'Potato Wedges'],
            ['name' => 'Potato salad'],
            ['name' => 'Potato skins'],
            ['name' => 'Potato wedges'],
            ['name' => 'Poutine'],
            ['name' => 'Quesadilla', 'chef_id' => 4],
            ['name' => 'Ratatouille'],
            ['name' => 'Ribs'],
            ['name' => 'Risotto'],
            ['name' => 'Roasted Bone Marrow'],
            ['name' => 'Roasted Chickpeas'],
            ['name' => 'Samosa'],
            ['name' => 'Schnitzel'],
            ['name' => 'Scrapple'],
            ['name' => 'Sloppy joe'],
            ['name' => 'Souvlaki'],
            ['name' => 'Spaghetti Bolognese'],
            ['name' => 'Spaghetti and Meatballs'],
            ['name' => 'Spanish rice'],
            ['name' => 'Spring Rolls'],
            ['name' => 'Squab'],
            ['name' => 'St. Paul Sandwich', 'chef_id' => 3],
            ['name' => 'Steak Tartare'],
            ['name' => 'Steak sandwich'],
            ['name' => 'Steak sauce'],
            ['name' => 'Steamed clams'],
            ['name' => 'Stroganoff'],
            ['name' => 'Stuffed ham'],
            ['name' => 'Stuffed peppers'],
            ['name' => 'Stuffed zucchini'],
            ['name' => 'Succotash'],
            ['name' => 'Suckling Pig'],
            ['name' => 'Supreme pizza', 'chef_id' => 1],
            ['name' => 'Surf and turf'],
            ['name' => 'Sushi'],
            ['name' => 'Sueli\'s Sushi Boat'],
            ['name' => 'Sweet Potato Fries'],
            ['name' => 'Sweetbreads'],
            ['name' => 'Swiss steak'],
            ['name' => 'Tagine'],
            ['name' => 'Tamales'],
            ['name' => 'Tetrazzini'],
            ['name' => 'Texas Toast'],
            ['name' => 'Thousand Island dressing'],
            ['name' => 'Tin Roof Ice Cream'],
            ['name' => 'Toaster Strudel'],
            ['name' => 'Tomato compote'],
            ['name' => 'Tres Leches Cake'],
            ['name' => 'Tuna Pizza'],
            ['name' => 'Tuna casserole'],
            ['name' => 'Turducken'],
            ['name' => 'Turkish Delight'],
            ['name' => 'Vitão\'s Chocolate pie', 'chef_id' => 3],
            ['name' => 'Veggie Pizza'],
            ['name' => 'Venison'],
            ['name' => 'Vichyssoise'],
            ['name' => 'Waffle'],
            ['name' => 'Wasabi Peas'],
            ['name' => 'White chocolate cookie'],
            ['name' => 'Yeung Chow fried rice'],
        ]);
    }
}
