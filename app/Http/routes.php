<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/artno', function () {
    $artno = request('q');

    $items = App\Item::where('artno', 'LIKE', "%$artno%")->get();

    return $items->map(function ($item) {
        return [
            'id' => $item->artno,
            'text' => $item->artno,
        ];
    });
});

Route::get('/api/artno/{artno}', function ($artno) {
    return App\Item::where('artno', $artno)->first([
        'id',
        'artno',
        'price',
        'description',
    ]);
});
