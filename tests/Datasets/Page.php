<?php

use App\Models\Page;

dataset('page', fn () => yield fn () => Page::factory()->create());
