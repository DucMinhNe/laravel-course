<?php

$orders = collect([
    ['id' => 1, 'user' => 'A', 'total' => 50,  'status' => 'paid'],
    ['id' => 2, 'user' => 'B', 'total' => 120, 'status' => 'paid'],
    ['id' => 3, 'user' => 'A', 'total' => 30,  'status' => 'refunded'],
    ['id' => 4, 'user' => 'C', 'total' => 200, 'status' => 'paid'],
]);

// Total revenue from paid orders
$revenue = $orders->where('status', 'paid')->sum('total');     // 370

// Revenue grouped by user
$byUser = $orders->where('status', 'paid')
    ->groupBy('user')
    ->map(fn ($group) => $group->sum('total'));                // ['A'=>50,'B'=>120,'C'=>200]

// Biggest order
$top = $orders->sortByDesc('total')->first();                  // id 4

// Pipeline: paid order ids, sorted
$ids = $orders->where('status', 'paid')->pluck('id')->sort()->values();

// Streaming a huge table with constant memory:
//   \App\Models\Order::cursor()->each(fn ($o) => process($o));
