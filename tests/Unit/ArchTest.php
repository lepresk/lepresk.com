<?php

declare(strict_types=1);

arch()->preset()->php();
// Strict preset rules (without "no protected methods" — incompatible with Laravel/Filament)
arch('strict: no abstract classes')->expect('App')->classes()->not->toBeAbstract();
arch('strict: use strict types')->expect('App')->toUseStrictTypes();
arch('strict: use strict equality')->expect('App')->toUseStrictEquality();
arch('strict: classes must be final')->expect('App')->classes()->toBeFinal();
arch('strict: no sleep')->expect(['sleep', 'usleep'])->not->toBeUsed();
arch()->preset()->security();

arch('controllers')
    ->expect('App\Http\Controllers')
    ->not->toBeUsed();

//
