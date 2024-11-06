<?php

use Core\Validator;

it('validates a string', function () {
    expect(\Core\Validator::string('foobar'))->toBeTrue();
    expect(\Core\Validator::string(false))->toBeFalse();
    expect(\Core\Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum length', function () {
    expect(\Core\Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(\Core\Validator::email('foobar'))->toBeFalse();
    expect(\Core\Validator::email('foobar@example.com'))->toBeTrue();
});

it('validates that a number is greater than a given amount', function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue();
    expect(Validator::greaterThan(10, 100))->toBeFalse();
})->only();