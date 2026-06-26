<?php

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

/** @var TestCase $this */
describe('Setting Model', function () {
    describe('Get Setting', function () {
        it('retrieves a setting value by key', function () {
            Setting::set('test_key', 'test_value');

            $value = Setting::get('test_key');

            expect($value)->toBe('test_value');
        });

        it('returns default value when setting does not exist', function () {
            $value = Setting::get('nonexistent_key', 'default_value');

            expect($value)->toBe('default_value');
        });

        it('returns null when setting does not exist and no default provided', function () {
            $value = Setting::get('nonexistent_key');

            expect($value)->toBeNull();
        });
    });

    describe('Set Setting', function () {
        it('creates a new setting', function () {
            Setting::set('new_setting', 'new_value');

            $this->assertDatabaseHas('settings', [
                'key' => 'new_setting',
                'value' => 'new_value',
            ]);
        });

        it('updates existing setting', function () {
            Setting::set('unique_update_setting_key', 'old_value');
            Setting::set('unique_update_setting_key', 'new_value');

            $this->assertDatabaseHas('settings', [
                'key' => 'unique_update_setting_key',
                'value' => 'new_value',
            ]);
            $countTotal = Setting::where('key', 'unique_update_setting_key')->count();
            expect($countTotal)->toBe(1);
        });

        it('allows storing numeric values', function () {
            Setting::set('numeric_setting', '123');

            $value = Setting::get('numeric_setting');

            expect($value)->toBe('123');
        });

        it('allows storing empty string', function () {
            Setting::set('empty_setting', '');

            $value = Setting::get('empty_setting');

            expect($value)->toBe('');
        });

        it('allows storing boolean-like strings', function () {
            Setting::set('bool_setting', '1');

            $value = Setting::get('bool_setting');

            expect($value)->toBe('1');
        });
    });

    describe('Registration Open Status', function () {
        it('returns true when registration_open is 1', function () {
            Setting::set('registration_open', '1');

            expect(Setting::isRegistrationOpen())->toBeTrue();
        });

        it('returns false when registration_open is 0', function () {
            Setting::set('registration_open', '0');

            expect(Setting::isRegistrationOpen())->toBeFalse();
        });

        it('returns true by default when setting not set', function () {
            expect(Setting::isRegistrationOpen())->toBeTrue();
        });

        it('returns false for any non-1 value', function () {
            Setting::set('registration_open', 'false');

            expect(Setting::isRegistrationOpen())->toBeFalse();
        });
    });

    describe('Model Configuration', function () {
        it('uses key as primary key', function () {
            $setting = new Setting();

            expect($setting->getKeyName())->toBe('key');
        });

        it('has correct fillable attributes', function () {
            $setting = new Setting();
            $fillable = $setting->getFillable();

            expect($fillable)->toContain('key', 'value');
        });

        it('table name is settings', function () {
            $setting = new Setting();

            expect($setting->getTable())->toBe('settings');
        });

        it('primary key is not incrementing', function () {
            $setting = new Setting();

            expect($setting->getIncrementing())->toBeFalse();
        });

        it('primary key type is string', function () {
            $setting = new Setting();

            expect($setting->getKeyType())->toBe('string');
        });
    });

    describe('Multiple Settings', function () {
        it('can store and retrieve multiple settings', function () {
            Setting::set('setting1', 'value1');
            Setting::set('setting2', 'value2');
            Setting::set('setting3', 'value3');

            expect(Setting::get('setting1'))->toBe('value1');
            expect(Setting::get('setting2'))->toBe('value2');
            expect(Setting::get('setting3'))->toBe('value3');
        });

        it('updates one setting without affecting others', function () {
            Setting::set('setting_a', 'valueA');
            Setting::set('setting_b', 'valueB');

            Setting::set('setting_a', 'updatedA');

            expect(Setting::get('setting_a'))->toBe('updatedA');
            expect(Setting::get('setting_b'))->toBe('valueB');
        });
    });
});
