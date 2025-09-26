<?php

use Core\Validator;

it('validates a string', function () {



    expect(Validator::string("foobar"))->tobeTrue();
    expect(Validator::string(false))->tobeFalse();
    expect(Validator::string(""))->toBeFalse();

});


it('validates a string with a minimum length', function () {
    $result = Validator::string("foobar");


    expect(Validator::string("foobar",20))->toBeFalse();
});

it("validates an email address", function () {
    expect(Validator::email("foobar"))->toBeFalse();
    expect(Validator::email("foobar@example.com"))->toBeTrue();
});

it("validates that a number is greater than a given amount", function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue();
    expect(Validator::greaterThan(0, 10))->toBeFalse();

})->only();