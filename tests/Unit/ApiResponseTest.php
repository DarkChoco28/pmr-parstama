<?php

/** @noinspection PhpUndefinedMethodInspection */

use App\Http\Responses\ApiResponse;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('ApiResponse Helper', function () {
    describe('Success Response', function () {
        it('returns success response with data', function () {
            $response = ApiResponse::success(['key' => 'value'], 'Test message', 200);

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeTrue();
            expect($data['message'])->toBe('Test message');
            expect($data['data'])->toBe(['key' => 'value']);
            expect($data['meta'])->toBe([]);
            expect($response->status())->toBe(200);
        });

        it('returns success response with default values', function () {
            $response = ApiResponse::success();

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeTrue();
            expect($data['message'])->toBe('Success');
            expect($data['data'])->toBeNull();
            expect($data['meta'])->toBe([]);
            expect($response->status())->toBe(200);
        });

        it('includes custom meta data', function () {
            $response = ApiResponse::success(
                ['user' => 'John'],
                'User retrieved',
                200,
                ['timestamp' => 'now']
            );

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeTrue();
            expect($data['data'])->toBe(['user' => 'John']);
            expect($data['meta'])->toHaveKey('timestamp');
        });
    });

    describe('Error Response', function () {
        it('returns error response with message', function () {
            $response = ApiResponse::error('Something went wrong', 500);

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['message'])->toBe('Something went wrong');
            expect($data['errors'])->toBeNull();
            expect($response->status())->toBe(500);
        });

        it('returns error response with errors array', function () {
            $errors = ['email' => 'Email is required'];
            $response = ApiResponse::error('Validation failed', 422, $errors);

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['message'])->toBe('Validation failed');
            expect($data['errors'])->toBe($errors);
            expect($response->status())->toBe(422);
        });

        it('includes meta data in error response', function () {
            $response = ApiResponse::error(
                'Error occurred',
                400,
                null,
                ['error_code' => 'ERR_001']
            );

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['meta'])->toHaveKey('error_code', 'ERR_001');
        });
    });

    describe('Paginated Response', function () {
        it('returns paginated response with correct structure', function () {
            Registration::factory()->count(30)->create();
            $paginator = Registration::paginate(15);

            $response = ApiResponse::paginated($paginator, 'Registrations retrieved');

            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeTrue();
            expect($data['message'])->toBe('Registrations retrieved');
            expect($data['meta']['total'])->toBe(30);
            expect($data['meta']['per_page'])->toBe(15);
            expect($data['meta']['current_page'])->toBe(1);
            expect($data['meta']['total_pages'])->toBe(2);
            expect($data['meta']['count'])->toBe(15);
        });

        it('includes has_more flag correctly', function () {
            Registration::factory()->count(20)->create();
            $paginator = Registration::paginate(15);

            $response = ApiResponse::paginated($paginator);

            $data = json_decode($response->content(), true);
            expect($data['meta']['has_more'])->toBeTrue();
        });

        it('has_more is false on last page', function () {
            Registration::factory()->count(15)->create();
            $paginator = Registration::paginate(15, page: 1);

            $response = ApiResponse::paginated($paginator);

            $data = json_decode($response->content(), true);
            expect($data['meta']['has_more'])->toBeFalse();
        });
    });

    describe('Status-Specific Responses', function () {
        it('created response returns 201', function () {
            $response = ApiResponse::created(['id' => 1], 'Resource created');

            expect($response->status())->toBe(201);
            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeTrue();
            expect($data['message'])->toBe('Resource created');
            expect($data['data'])->toBe(['id' => 1]);
        });

        it('not found response returns 404', function () {
            $response = ApiResponse::notFound('User not found');

            expect($response->status())->toBe(404);
            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['message'])->toBe('User not found');
        });

        it('unauthorized response returns 401', function () {
            $response = ApiResponse::unauthorized();

            expect($response->status())->toBe(401);
            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['message'])->toBe('Unauthorized');
        });

        it('forbidden response returns 403', function () {
            $response = ApiResponse::forbidden('Access denied');

            expect($response->status())->toBe(403);
            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['message'])->toBe('Access denied');
        });

        it('validation error response returns 422', function () {
            $errors = ['email' => ['Email is required']];
            $response = ApiResponse::validationError($errors);

            expect($response->status())->toBe(422);
            $data = json_decode($response->content(), true);
            expect($data['success'])->toBeFalse();
            expect($data['message'])->toBe('Validation failed');
            expect($data['errors'])->toBe($errors);
        });

        it('no content response returns 204', function () {
            $response = ApiResponse::noContent();

            expect($response->status())->toBe(204);
            // 204 responses typically have empty content
            expect(in_array($response->content(), ['null', '{}', '']))->toBeTrue();
        });
    });

    describe('Response Structure Consistency', function () {
        it('all success responses have same structure', function () {
            $response1 = ApiResponse::success(['data' => 'test']);
            $response2 = ApiResponse::created(['id' => 1]);

            $json1 = json_decode($response1->content(), true);
            $json2 = json_decode($response2->content(), true);

            expect($json1)->toHaveKeys(['success', 'message', 'data', 'meta']);
            expect($json2)->toHaveKeys(['success', 'message', 'data', 'meta']);
        });

        it('all error responses have same structure', function () {
            $response1 = ApiResponse::error('Error');
            $response2 = ApiResponse::notFound();
            $response3 = ApiResponse::validationError([]);

            $json1 = json_decode($response1->content(), true);
            $json2 = json_decode($response2->content(), true);
            $json3 = json_decode($response3->content(), true);

            expect($json1)->toHaveKeys(['success', 'message', 'errors', 'meta']);
            expect($json2)->toHaveKeys(['success', 'message', 'errors', 'meta']);
            expect($json3)->toHaveKeys(['success', 'message', 'errors', 'meta']);
        });

        it('success is always boolean', function () {
            $responses = [
                ApiResponse::success(),
                ApiResponse::created([]),
                ApiResponse::error('Error'),
                ApiResponse::notFound(),
            ];

            foreach ($responses as $response) {
                $json = json_decode($response->content(), true);
                expect($json['success'])->toBeIn([true, false]);
            }
        });

        it('message is always string', function () {
            $responses = [
                ApiResponse::success(null, 'Test message'),
                ApiResponse::error('Error message'),
                ApiResponse::unauthorized('Auth required'),
            ];

            foreach ($responses as $response) {
                $json = json_decode($response->content(), true);
                expect($json['message'])->toBeString();
            }
        });
    });
});
