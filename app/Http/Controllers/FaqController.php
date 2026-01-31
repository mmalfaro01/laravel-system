<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Static FAQ data
        $faqs = [
            [
                'question' => 'What are your operating hours?',
                'answer' => 'We are open daily from 10:00 AM to 10:00 PM, including weekends and holidays!'
            ],
            [
                'question' => 'Do you offer delivery services?',
                'answer' => 'Yes! We offer delivery within Siquijor town and nearby areas. You can order online through our website and choose delivery during checkout.'
            ],
            [
                'question' => 'Can I customize my burger?',
                'answer' => 'Absolutely! You can customize your burger with extra toppings, remove ingredients, or adjust spice levels. Just let us know your preferences when ordering.'
            ],
            [
                'question' => 'Do you have vegetarian options?',
                'answer' => 'Yes! We offer the Island Veggie Burger made with a plant-based patty, fresh vegetables, and our special tropical aioli.'
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept cash, GCash, credit/debit cards, and PayPal for online orders. Cash on delivery is also available.'
            ],
            [
                'question' => 'Do you cater for events or parties?',
                'answer' => 'Yes! We offer catering services for parties, events, and gatherings. Please contact us at +63 912 345 6789 at least 2 days in advance to discuss your requirements.'
            ],
            [
                'question' => 'Are your ingredients locally sourced?',
                'answer' => 'Yes! We pride ourselves on using fresh, locally-sourced ingredients whenever possible, including produce from Siquijor farms and seafood from local fishermen.'
            ],
            [
                'question' => 'How long does delivery take?',
                'answer' => 'Delivery within Siquijor town typically takes 25-45 minutes depending on your location and order volume. You can also schedule delivery for a specific time.'
            ],
            [
                'question' => 'Do you have parking available?',
                'answer' => 'Yes! We have free parking spaces available for dine-in customers right in front of our restaurant.'
            ],
            [
                'question' => 'Can I place orders in advance?',
                'answer' => 'Yes! You can place orders in advance through our website or by calling us. We recommend ordering at least 1 hour ahead for large orders.'
            ]
        ];

        return view('faq.index', compact('faqs'));
    }
}
