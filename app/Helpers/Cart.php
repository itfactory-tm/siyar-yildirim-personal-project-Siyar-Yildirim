<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    private static array $cart = [
        'products' => [],
        'totalQty' => 0,
        'totalPrice' => 0
    ];

    // initialize the cart
    public static function init(): void
    {
        self::$cart = session()->get('cart') ?? self::$cart;
    }

    // add product to the cart
    public static function add(Product $product): void
    {
        $singlePrice = $product->price;
        if (array_key_exists($product->id, self::$cart['products'])) {
            self::$cart['products'][$product->id]['qty']++;
            self::$cart['products'][$product->id]['price'] += $singlePrice;
        } else {
            self::$cart['products'][$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $singlePrice,
                'qty' => 1,
                'image' => $product->image,

            ];
        }
        self::updateTotal();
    }

    public static function delete(Product $product): void
    {
        $singlePrice = $product->price;
        if (array_key_exists($product->id, self::$cart['products'])) {
            self::$cart['products'][$product->id]['qty']--;
            self::$cart['products'][$product->id]['price'] -= $singlePrice;
            if (self::$cart['products'][$product->id]['qty'] == 0) {
                unset(self::$cart['products'][$product->id]);
            }
        }
        self::updateTotal();
    }

    // empty the cart
    public static function empty(): void
    {
        session()->forget('cart');
    }

    // re-calculate the total quantity and price of products in the cart
    private static function updateTotal(): void
    {
        $totalQty = 0;
        $totalPrice = 0;
        foreach (self::$cart['products'] as $product) {
            $totalQty += $product['qty'];
            $totalPrice += $product['price'];
        }
        self::$cart['totalQty'] = $totalQty;
        self::$cart['totalPrice'] = $totalPrice;
        session()->put('cart', self::$cart);   // store the cart in the session
    }

    // get the complete cart
    public static function getCart(): array
    {
        return self::$cart;
    }

    // get all the products from the cart
    public static function getProducts(): array
    {
        return self::$cart['products'];
    }

    // get one product from the cart
    public static function getOneProduct($key = 0): array
    {
        if (array_key_exists($key, self::$cart['products'])) {
            return self::$cart['products'][$key];
        }
        return [];
    }

    // get all the product keys
    public static function getKeys(): array
    {
        return array_keys(self::$cart['products']);
    }

    // get total quantity of products in the cart
    public static function getTotalQty(): int
    {
        return self::$cart['totalQty'];
    }

    // get total price of records in the cart
    public static function getTotalPrice(): float
    {
        return self::$cart['totalPrice'];
    }
}

Cart::init();
