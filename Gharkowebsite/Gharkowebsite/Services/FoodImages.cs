namespace Gharkowebsite.Services;

/// <summary>
/// Dish photos under wwwroot/images/site. All momo varieties share momo.png; all chowmein varieties share chowmein.png.
/// </summary>
public static class FoodImages
{
    private const string B = "/images/site/";

    public const string Momo = B + "momo.png";
    public const string MomoFried = B + "momo.png";
    public const string MomoSoup = B + "momo.png";
    public const string Chowmein = B + "chowmein.png";

    /// <summary>Alias — same photo as Chowmein for every noodle/chowmein card.</summary>
    public const string Noodles = Chowmein;

    public const string Curry = B + "whole-chicken-chips-rice.jpg";
    public const string Tandoori = B + "whole-chicken-meal.jpg";
    public const string RiceMeal = B + "whole-chicken-chips-rice.jpg";
    public const string Biryani = B + "whole-chicken-chips-rice.jpg";
    public const string Paneer = B + "mediterranean-salad.jpg";
    public const string Burger = B + "aussie-beef-burger.jpg";
    public const string Pie = B + "chicken-pizza.jpg";
    public const string PieVegetarian = B + "vegetarian-pizza.jpg";
    public const string Naan = B + "vegetarian-pizza.jpg";
    public const string Samosa = B + "large-fries.jpg";
    public const string DalRice = B + "whole-chicken-chips-rice.jpg";
    public const string Restaurant = B + "hero.jpg";

    public const string BurgerPeri = B + "peri-peri-chilli-burger.jpg";

    /// <summary>Drinks — smoothies stock photos; Thai Redbull + soft drinks use supplied PNGs.</summary>
    private const string D = "/images/site/drinks/";
    public const string DrinkMangoSmoothie = D + "mango-smoothie.jpg";
    public const string DrinkVanillaSmoothie = D + "vanilla-smoothie.jpg";
    public const string DrinkChocolateSmoothie = D + "chocolate-smoothie.jpg";
    public const string DrinkCan = D + "soft-drinks.png";
    public const string DrinkWater = D + "bottled-water.jpg";
    public const string DrinkThaiRedbull = D + "krating-daeng.png";
}
