<?php


use Illuminate\Support\Facades\Schedule;

Schedule::command('app:source-news business')->everyFiveSeconds();
