<?php

declare(strict_types=1);

namespace Tests\Unit\Sophia;

use App\Services\Sophia\Orders\SophiaCustomerDataSnippetDetector;
use App\Services\Sophia\Orders\SophiaDraftCustomerDataCaptureService;
use App\Services\Sophia\Orders\SophiaOrderCustomerFieldValidator;
use App\Services\Sophia\Orders\SophiaOrderCustomerInfoParser;
use App\Services\Sophia\Orders\SophiaOrderCustomerInfoWriter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class SophiaGreetingAddressCaptureTest extends TestCase
{
    private SophiaOrderCustomerFieldValidator $validator;

    private SophiaCustomerDataSnippetDetector $detector;

    private SophiaOrderCustomerInfoParser $parser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new SophiaOrderCustomerFieldValidator;
        $this->parser = new SophiaOrderCustomerInfoParser($this->validator);
        $this->detector = new SophiaCustomerDataSnippetDetector($this->parser, $this->validator);
    }

    public function test_bonjour_with_trailing_period_is_not_a_valid_address(): void
    {
        $this->assertFalse($this->validator->isValidAddress('Bonjour.'));
    }

    public function test_bonjour_without_punctuation_is_not_a_valid_address(): void
    {
        $this->assertFalse($this->validator->isValidAddress('Bonjour'));
    }

    #[DataProvider('chatFillerAddresses')]
    public function test_chat_fillers_are_not_valid_addresses(string $address): void
    {
        $this->assertFalse($this->validator->isValidAddress($address));
    }

    public function test_real_street_and_quartier_remain_valid_addresses(): void
    {
        $this->assertTrue($this->validator->isValidAddress('Quartier Maarif, Rue 12'));
        $this->assertTrue($this->validator->isValidAddress('Hay Mohammadi, rue 5'));
        $this->assertTrue($this->validator->isValidAddress('12 Rue Allal Ben Abdellah, Quartier Gauthier'));
        $this->assertTrue($this->validator->isValidAddress('Résidence Les Palmiers, appartement 4'));
    }

    public function test_bare_city_is_not_a_valid_address(): void
    {
        $this->assertFalse($this->validator->isValidAddress('Casablanca'));
        $this->assertTrue($this->validator->isValidCity('Casablanca'));
    }

    public function test_greeting_plus_city_is_not_a_valid_address(): void
    {
        $this->assertFalse($this->validator->isValidAddress('Bonjour Casablanca'));
        $this->assertFalse($this->validator->isValidAddress('Bonjour. Casablanca'));
    }

    public function test_bonjour_is_not_detected_as_customer_data(): void
    {
        $this->assertFalse($this->detector->detectsCustomerDataSnippet('Bonjour.'));
        $this->assertFalse($this->detector->detectsCustomerDataSnippet('Bonjour'));
        $this->assertFalse($this->detector->detectsCustomerDataSnippet('Salut!'));
    }

    public function test_invalid_only_address_is_not_a_customer_data_snippet(): void
    {
        $parsed = $this->parser->parse('Bonjour.');

        $this->assertSame('Bonjour.', $parsed['address'] ?? null);
        $this->assertFalse($this->validator->isValidAddress($parsed['address']));
        $this->assertFalse($this->detector->detectsCustomerDataSnippet('Bonjour.'));
        $this->assertFalse($this->detector->detectsCustomerDataSnippet('Rue 1'));
    }

    public function test_real_address_snippets_are_still_detected(): void
    {
        $this->assertTrue($this->detector->detectsCustomerDataSnippet('12 Rue Allal Ben Abdellah, Quartier Gauthier'));
        $this->assertTrue($this->detector->detectsCustomerDataSnippet('Quartier Maarif, Rue 12, Casablanca'));
        $this->assertTrue($this->detector->detectsCustomerDataSnippet("Adresse: Hay Mohammadi, rue 5\nVille: Casablanca"));
    }

    public function test_greeting_only_messages_skip_mandatory_capture(): void
    {
        $writer = new RecordingOrderCustomerInfoWriter;
        $service = $this->captureService($writer);

        $this->assertTrue($service->shouldSkipMandatoryCapture('Bonjour.'));
        $this->assertTrue($service->shouldSkipMandatoryCapture('Bonjour'));
        $this->assertTrue($service->shouldSkipMandatoryCapture('Bonsoir!'));
        $this->assertFalse($service->shouldSkipMandatoryCapture('Quartier Maarif, Rue 12, Casablanca'));

        $service->captureMandatoryCustomerData('Bonjour.');
        $service->captureMandatoryCustomerData('Bonjour');

        $this->assertSame([], $writer->calls);
    }

    public function test_looks_like_real_address_requires_field_validator(): void
    {
        $service = $this->captureService(new RecordingOrderCustomerInfoWriter);
        $method = new ReflectionMethod($service, 'looksLikeRealAddress');

        $this->assertFalse($method->invoke($service, 'Bonjour.'));
        $this->assertFalse($method->invoke($service, 'Bonjour'));
        $this->assertTrue($method->invoke($service, 'Quartier Maarif, Rue 12'));
        $this->assertTrue($method->invoke($service, 'Hay Mohammadi, rue 5'));
    }

    public function test_real_address_is_still_saved(): void
    {
        $writer = new RecordingOrderCustomerInfoWriter;
        $service = $this->captureService($writer);

        $service->captureMandatoryCustomerData('Quartier Maarif, Rue 12, Casablanca');

        $this->assertSame([
            [
                'address' => 'Quartier Maarif, Rue 12',
                'city' => 'Casablanca',
            ],
        ], $writer->calls);
    }

    public function test_incident_greeting_then_city_does_not_store_bonjour_as_address(): void
    {
        $writer = new RecordingOrderCustomerInfoWriter;
        $service = $this->captureService($writer);

        $service->captureMandatoryCustomerData('Bonjour.');
        $service->captureMandatoryCustomerData('Casablanca');

        $this->assertSame([
            ['city' => 'Casablanca'],
        ], $writer->calls);
    }

    public function test_labeled_greeting_address_is_dropped_when_city_is_present(): void
    {
        $writer = new RecordingOrderCustomerInfoWriter;
        $service = $this->captureService($writer);

        $service->captureMandatoryCustomerData("Bonjour.\nVille: Casablanca");

        $this->assertSame([
            ['city' => 'Casablanca'],
        ], $writer->calls);
    }

    private function captureService(SophiaOrderCustomerInfoWriter $writer): SophiaDraftCustomerDataCaptureService
    {
        return new SophiaDraftCustomerDataCaptureService(
            $this->parser,
            $this->validator,
            $this->detector,
            $writer,
        );
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function chatFillerAddresses(): array
    {
        return [
            'bonjour bang' => ['Bonjour!'],
            'bonjour spaced punct' => ['  Bonjour... '],
            'bonsoir' => ['Bonsoir'],
            'salut' => ['Salut'],
            'hello' => ['Hello'],
            'hi' => ['Hi'],
            'hey' => ['Hey'],
            'coucou' => ['Coucou'],
            'salam' => ['Salam'],
            'slm' => ['Slm'],
            'merci' => ['Merci'],
            'thanks' => ['Thanks'],
            'ok' => ['Ok'],
            'okay' => ['Okay'],
            'oui' => ['Oui'],
            'non' => ['Non'],
            'svp' => ['Svp'],
            'please' => ['Please'],
            'parfait' => ['Parfait'],
            'daccord' => ['daccord'],
            'd accord punct' => ["D'accord."],
            'short street' => ['Rue 1'],
        ];
    }
}

final class RecordingOrderCustomerInfoWriter implements SophiaOrderCustomerInfoWriter
{
    /** @var list<array<string, string>> */
    public array $calls = [];

    public function setOrderCustomerInfo(array $fields): void
    {
        $this->calls[] = $fields;
    }
}
