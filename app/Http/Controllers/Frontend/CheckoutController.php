<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout page.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = session()->get('cart', []);

        /*
        |--------------------------------------------------------------------------
        | Check Cart
        |--------------------------------------------------------------------------
        */

        if (empty($cart)) {
            return redirect()
                ->route('cart')
                ->with(
                    'error',
                    'Your cart is empty.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Cart Products
        |--------------------------------------------------------------------------
        |
        | Always get fresh product data from database.
        | Do not trust old product data stored in session.
        |
        */

        $productIds = collect($cart)
            ->pluck('id')
            ->filter()
            ->unique()
            ->values();

        $products = Product::whereIn(
            'id',
            $productIds
        )
            ->get()
            ->keyBy('id');

        /*
        |--------------------------------------------------------------------------
        | Prepare Checkout Cart
        |--------------------------------------------------------------------------
        */

        $checkoutCart = [];

        foreach ($cart as $item) {

            $productId = $item['id'] ?? null;

            /*
            | Product no longer exists
            */

            if (!$productId || !$products->has($productId)) {
                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        'One or more products in your cart are no longer available.'
                    );
            }

            $product = $products->get($productId);

            /*
            | Product is unavailable
            */

            if (!$product->is_available) {
                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        "{$product->name} is currently unavailable."
                    );
            }

            /*
            | Validate quantity
            */

            $quantity = (int) (
                $item['quantity'] ?? 0
            );

            if ($quantity < 1) {
                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        'Invalid product quantity.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Fresh Product Price
            |--------------------------------------------------------------------------
            |
            | Use discount_price if available.
            | Otherwise use regular price.
            |
            */

            $price = $product->discount_price !== null
                ? (float) $product->discount_price
                : (float) $product->price;

            $checkoutCart[$productId] = [

                'id' =>
                    $product->id,

                'name' =>
                    $product->name,

                'price' =>
                    $price,

                'quantity' =>
                    $quantity,

                'main_image' =>
                    $product->main_image,

            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = collect($checkoutCart)
            ->sum(function ($item) {

                return $item['price']
                    * $item['quantity'];
            });

        /*
        |--------------------------------------------------------------------------
        | Order Type
        |--------------------------------------------------------------------------
        */

        $orderType = $request->query(
            'order_type',
            'delivery'
        );

        /*
        | Safety check
        */

        if (!in_array(
            $orderType,
            [
                'takeaway',
                'delivery',
            ],
            true
        )) {
            $orderType = 'delivery';
        }

        /*
        |--------------------------------------------------------------------------
        | Delivery Fee
        |--------------------------------------------------------------------------
        */

        $deliveryFee = $orderType === 'takeaway'
            ? 0
            : (float) (
                Setting::where(
                    'key',
                    'delivery_fee'
                )->value('value') ?? 60
            );

        /*
        |--------------------------------------------------------------------------
        | Coupon
        |--------------------------------------------------------------------------
        |
        | Revalidate coupon from database.
        |
        */

        $couponDiscount = 0;

        $appliedCoupon =
            session()->get(
                'applied_coupon'
            );

        if ($appliedCoupon) {

            $coupon = Coupon::find(
                $appliedCoupon['id'] ?? null
            );

            /*
            | Coupon still exists and is valid
            */

            if (
                $coupon &&
                $coupon->isValid()
            ) {

                /*
                | Check minimum order
                */

                if (
                    $coupon->minimum_order <= 0
                    ||
                    $subtotal >= $coupon->minimum_order
                ) {

                    /*
                    | Recalculate discount
                    */

                    $couponDiscount =
                        (float) $coupon->calculateDiscount(
                            $subtotal
                        );

                    /*
                    | Update session with fresh discount
                    */

                    session([
                        'applied_coupon' => [

                            'id' =>
                                $coupon->id,

                            'code' =>
                                $coupon->code,

                            'discount' =>
                                $couponDiscount,

                        ],
                    ]);

                } else {

                    /*
                    | Coupon no longer qualifies
                    */

                    session()->forget(
                        'applied_coupon'
                    );
                }

            } else {

                /*
                | Coupon inactive or expired
                */

                session()->forget(
                    'applied_coupon'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Total
        |--------------------------------------------------------------------------
        */

        $total = $subtotal
            + $deliveryFee
            - $couponDiscount;

        /*
        | Prevent negative total
        */

        $total = max(
            0,
            $total
        );

        /*
        |--------------------------------------------------------------------------
        | Return Checkout Page
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.pages.checkout',
            [

                'cart' =>
                    $checkoutCart,

                'subtotal' =>
                    $subtotal,

                'orderType' =>
                    $orderType,

                'deliveryFee' =>
                    $deliveryFee,

                'couponDiscount' =>
                    $couponDiscount,

                'total' =>
                    $total,

            ]
        );
    }


    /**
     * Place order.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Customer Information
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:20',
            ],

            'customer_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'order_type' => [
                'required',
                'in:takeaway,delivery',
            ],

            'delivery_address' => [
                'nullable',
                'string',
                'max:1000',
                'required_if:order_type,delivery',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = session()->get(
            'cart',
            []
        );

        /*
        |--------------------------------------------------------------------------
        | Check Cart
        |--------------------------------------------------------------------------
        */

        if (empty($cart)) {

            return redirect()
                ->route('cart')
                ->with(
                    'error',
                    'Your cart is empty.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Fresh Products
        |--------------------------------------------------------------------------
        */

        $productIds = collect($cart)
            ->pluck('id')
            ->filter()
            ->unique()
            ->values();

        $products = Product::whereIn(
            'id',
            $productIds
        )
            ->get()
            ->keyBy('id');

        /*
        |--------------------------------------------------------------------------
        | Prepare Fresh Order Items
        |--------------------------------------------------------------------------
        */

        $orderItems = [];

        foreach ($cart as $item) {

            $productId = $item['id'] ?? null;

            /*
            | Product missing
            */

            if (
                !$productId
                ||
                !$products->has($productId)
            ) {

                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        'One or more products in your cart are no longer available.'
                    );
            }

            $product = $products->get(
                $productId
            );

            /*
            | Product unavailable
            */

            if (!$product->is_available) {

                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        "{$product->name} is currently unavailable."
                    );
            }

            /*
            | Validate Quantity
            */

            $quantity = (int) (
                $item['quantity'] ?? 0
            );

            if ($quantity < 1) {

                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        'Invalid product quantity.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Fresh Price
            |--------------------------------------------------------------------------
            */

            $price = $product->discount_price !== null
                ? (float) $product->discount_price
                : (float) $product->price;

            /*
            |--------------------------------------------------------------------------
            | Create Immutable Order Item Snapshot
            |--------------------------------------------------------------------------
            */

            $orderItems[] = [

                'product_id' =>
                    $product->id,

                'product_name' =>
                    $product->name,

                'price' =>
                    $price,

                'quantity' =>
                    $quantity,

                'total' =>
                    $price * $quantity,

            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Fresh Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = collect($orderItems)
            ->sum(function ($item) {

                return $item['total'];
            });

        /*
        |--------------------------------------------------------------------------
        | Delivery Fee
        |--------------------------------------------------------------------------
        */

        $deliveryFee = $validated['order_type'] === 'takeaway'
            ? 0
            : (float) (
                Setting::where(
                    'key',
                    'delivery_fee'
                )->value('value') ?? 60
            );

        /*
        |--------------------------------------------------------------------------
        | Revalidate Coupon
        |--------------------------------------------------------------------------
        */

        $discount = 0;

        $appliedCoupon =
            session()->get(
                'applied_coupon'
            );

        if ($appliedCoupon) {

            $coupon = Coupon::find(
                $appliedCoupon['id'] ?? null
            );

            /*
            | Check coupon validity
            */

            if (
                $coupon
                &&
                $coupon->isValid()
            ) {

                /*
                | Check minimum order
                */

                if (
                    $coupon->minimum_order <= 0
                    ||
                    $subtotal >= $coupon->minimum_order
                ) {

                    /*
                    | Recalculate discount
                    */

                    $discount =
                        (float) $coupon->calculateDiscount(
                            $subtotal
                        );

                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Final Total
        |--------------------------------------------------------------------------
        */

        $total = $subtotal
            + $deliveryFee
            - $discount;

        /*
        | Prevent negative total
        */

        $total = max(
            0,
            $total
        );

        /*
        |--------------------------------------------------------------------------
        | Create Order + Items
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(
            function () use (
                $validated,
                $orderItems,
                $subtotal,
                $deliveryFee,
                $discount,
                $total
            ) {

                /*
                |--------------------------------------------------------------------------
                | Create Order
                |--------------------------------------------------------------------------
                */

                $order = Order::create([

                    'customer_name' =>
                        $validated['customer_name'],

                    'customer_phone' =>
                        $validated['customer_phone'],

                    'customer_email' =>
                        $validated['customer_email']
                        ?? null,

                    'order_type' =>
                        $validated['order_type'],

                    'delivery_address' =>
                        $validated['delivery_address']
                        ?? null,

                    'subtotal' =>
                        $subtotal,

                    'delivery_fee' =>
                        $deliveryFee,

                    'discount' =>
                        $discount,

                    'total' =>
                        $total,

                    /*
                    | Payment is not integrated yet.
                    */

                    'payment_status' =>
                        'pending',

                    'status' =>
                        'pending',

                ]);

                /*
                |--------------------------------------------------------------------------
                | Create Order Items
                |--------------------------------------------------------------------------
                */

                foreach (
                    $orderItems
                    as $item
                ) {

                    $order->items()->create(

                        $item

                    );
                }

                return $order;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Clear Cart & Coupon
        |--------------------------------------------------------------------------
        */

        session()->forget([

            'cart',

            'applied_coupon',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect to Order Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'order.success',
                $order
            )
            ->with(
                'success',
                'Your order has been placed successfully.'
            );
    }


    /**
     * Show order success page.
     */
    public function success(Order $order)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Order Items
        |--------------------------------------------------------------------------
        */

        $order->load(
            'items'
        );

        /*
        |--------------------------------------------------------------------------
        | Show Success Page
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.pages.order-success',
            compact(
                'order'
            )
        );
    }


    /**
     * Apply coupon.
     */
    public function applyCoupon(
        Request $request
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validate Coupon Code
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'coupon_code' => [
                'required',
                'string',
                'max:50',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Get Cart
        |--------------------------------------------------------------------------
        */

        $cart = session()->get(
            'cart',
            []
        );

        /*
        |--------------------------------------------------------------------------
        | Cart Empty Check
        |--------------------------------------------------------------------------
        */

        if (empty($cart)) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'Your cart is empty.',

            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Fresh Products
        |--------------------------------------------------------------------------
        */

        $productIds = collect($cart)
            ->pluck('id')
            ->filter()
            ->unique()
            ->values();

        $products = Product::whereIn(
            'id',
            $productIds
        )
            ->get()
            ->keyBy('id');

        /*
        |--------------------------------------------------------------------------
        | Calculate Fresh Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($cart as $item) {

            $productId =
                $item['id'] ?? null;

            if (
                !$productId
                ||
                !$products->has($productId)
            ) {

                return response()->json([

                    'success' =>
                        false,

                    'message' =>
                        'One or more products are no longer available.',

                ], 422);
            }

            $product =
                $products->get(
                    $productId
                );

            /*
            | Product unavailable
            */

            if (!$product->is_available) {

                return response()->json([

                    'success' =>
                        false,

                    'message' =>
                        "{$product->name} is currently unavailable.",

                ], 422);
            }

            $quantity = (int) (
                $item['quantity'] ?? 0
            );

            if ($quantity < 1) {

                return response()->json([

                    'success' =>
                        false,

                    'message' =>
                        'Invalid product quantity.',

                ], 422);
            }

            /*
            | Fresh product price
            */

            $price = $product->discount_price !== null
                ? (float) $product->discount_price
                : (float) $product->price;

            $subtotal +=
                $price * $quantity;
        }

        /*
        |--------------------------------------------------------------------------
        | Find Coupon
        |--------------------------------------------------------------------------
        */

        $coupon = Coupon::where(
            'code',
            strtoupper(
                trim(
                    $validated['coupon_code']
                )
            )
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Coupon Not Found
        |--------------------------------------------------------------------------
        */

        if (!$coupon) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'Invalid coupon code.',

            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Check Coupon Validity
        |--------------------------------------------------------------------------
        */

        if (!$coupon->isValid()) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'This coupon is inactive or expired.',

            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Minimum Order Check
        |--------------------------------------------------------------------------
        */

        if (
            $coupon->minimum_order > 0
            &&
            $subtotal < $coupon->minimum_order
        ) {

            return response()->json([

                'success' =>
                    false,

                'message' =>
                    'Minimum order amount for this coupon is ৳'
                    . number_format(
                        $coupon->minimum_order,
                        0
                    )
                    . '.',

            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Discount
        |--------------------------------------------------------------------------
        */

        $discount =
            (float) $coupon->calculateDiscount(
                $subtotal
            );

        /*
        |--------------------------------------------------------------------------
        | Save Coupon Session
        |--------------------------------------------------------------------------
        */

        session([

            'applied_coupon' => [

                'id' =>
                    $coupon->id,

                'code' =>
                    $coupon->code,

                'discount' =>
                    $discount,

            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Calculate Total
        |--------------------------------------------------------------------------
        */

        $total = max(

            0,

            $subtotal - $discount

        );

        /*
        |--------------------------------------------------------------------------
        | Success Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' =>
                true,

            'message' =>
                'Coupon applied successfully.',

            'coupon_code' =>
                $coupon->code,

            'discount' =>
                $discount,

            'subtotal' =>
                $subtotal,

            'total' =>
                $total,

        ]);
    }
}