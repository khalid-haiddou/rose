<?php

declare(strict_types=1);

namespace App\Services\Sophia\Orders;

/**
 * Validates customer fields captured from Sophia WhatsApp messages.
 *
 * Greetings and chat fillers are rejected as delivery addresses. Comparison
 * ignores trailing punctuation, so "Bonjour." and "Bonjour!" are the same word.
 */
class SophiaOrderCustomerFieldValidator
{
    private const MIN_ADDRESS_LENGTH = 8;

    /**
     * Words that cannot be a customer name. Kept separate from address fillers:
     * a greeting must also be rejected when it is proposed as an address.
     */
    private const NAME_STOPWORDS = [
        'bonjour',
        'bonsoir',
        'salut',
        'hello',
        'hi',
        'hey',
        'coucou',
        'salam',
        'slm',
        'merci',
        'thanks',
        'ok',
        'okay',
        'oui',
        'non',
        'svp',
        'please',
        'parfait',
        'daccord',
        "d'accord",
        'client',
        'inconnu',
        'test',
        'nom',
        'name',
        'madame',
        'monsieur',
    ];

    /**
     * Whole-message chat fillers that must never be stored as a street address.
     */
    private const ADDRESS_STOPWORDS = [
        'bonjour',
        'bonsoir',
        'salut',
        'hello',
        'hi',
        'hey',
        'coucou',
        'salam',
        'slm',
        'merci',
        'thanks',
        'thank you',
        'ok',
        'okay',
        'oui',
        'non',
        'svp',
        'please',
        'parfait',
        'daccord',
        "d'accord",
        "d'acc",
        'dac',
        'bjr',
        'bsr',
        'cc',
        'stp',
        'thx',
        'ty',
        'yes',
        'no',
        'yep',
        'nope',
        'ouais',
        'bye',
        'aurevoir',
        'au revoir',
        'bienvenue',
        'welcome',
        'super',
        'cool',
        'nickel',
        'top',
        'genial',
        'bravo',
        'cv',
        'labas',
        'chokran',
        'choukran',
        'shukran',
        'rebonjour',
        'hola',
        'slt',
        'wesh',
        'mdr',
        'lol',
        'ptdr',
        'recu',
        'compris',
        'entendu',
        'bonne journee',
        'bonne soiree',
        'bon apres midi',
        'merci beaucoup',
        'thanks a lot',
        'salam alaykoum',
        'assalamu alaykum',
        'asalam alaykoum',
        'wa alaykum salam',
        'ca va',
        'cava',
        'inchallah',
        'inshallah',
        'hamdoulilah',
        'hamdulillah',
        'ok merci',
        'merci ok',
        'oui merci',
        'bonjour a tous',
        'salut a tous',
        'hello there',
        'good morning',
        'good evening',
        'good night',
        'pas de probleme',
        'pas de souci',
        'de rien',
        'avec plaisir',
        "c'est bon",
        'cest bon',
        'tout bon',
        'tres bien',
        'all good',
        'no worries',
        'مرحبا',
        'سلام',
        'شكرا',
        'السلام عليكم',
    ];

    private const POLITENESS_TOKENS = [
        'a',
        'au',
        'aux',
        'de',
        'du',
        'des',
        'le',
        'la',
        'les',
        'et',
        'vous',
        'tout',
        'tous',
        'toute',
        'toutes',
        'monde',
        'madame',
        'monsieur',
        'mme',
        'mr',
        'm',
        'sophia',
        'cher',
        'chere',
        'chers',
        'cheres',
        'equipe',
        'team',
        'mon',
        'ma',
        'mes',
        'beaucoup',
        'there',
    ];

    private const CITIES = [
        'casablanca',
        'casa',
        'rabat',
        'sale',
        'marrakech',
        'marrakesh',
        'fes',
        'fez',
        'tanger',
        'tangier',
        'agadir',
        'meknes',
        'oujda',
        'kenitra',
        'tetouan',
        'safi',
        'el jadida',
        'nador',
        'beni mellal',
        'khouribga',
        'mohammedia',
        'mohamedia',
        'settat',
        'berrechid',
        'temara',
        'skhirat',
        'inezgane',
        'laayoune',
        'dakhla',
        'essaouira',
        'ouarzazate',
        'taza',
        'errachidia',
        'guelmim',
        'khemisset',
        'larache',
        'khenifra',
        'berkane',
        'taourirt',
        'fquih ben salah',
        'tiznit',
        'sidi bennour',
        'sidi slimane',
        'youssoufia',
        'taroudant',
        'ouezzane',
        'guercif',
        'sefrou',
        'midelt',
    ];

    /** @var array<string, true> */
    private array $addressStopwords = [];

    /** @var array<string, true> */
    private array $addressStopwordsCompact = [];

    /** @var array<string, true> */
    private array $nameStopwords = [];

    /** @var array<string, true> */
    private array $politenessTokens = [];

    /** @var array<string, true> */
    private array $cities = [];

    public function __construct()
    {
        foreach (self::ADDRESS_STOPWORDS as $filler) {
            $normalized = $this->normalizeForComparison($filler);
            $this->addressStopwords[$normalized] = true;
            $this->addressStopwordsCompact[$this->compact($normalized)] = true;
        }

        foreach (self::NAME_STOPWORDS as $stopword) {
            $this->nameStopwords[$this->normalizeForComparison($stopword)] = true;
        }

        foreach (self::POLITENESS_TOKENS as $token) {
            $this->politenessTokens[$this->normalizeForComparison($token)] = true;
        }

        foreach (self::CITIES as $city) {
            $this->cities[$this->normalizeForComparison($city)] = true;
        }
    }

    public function isValidAddress(?string $address): bool
    {
        if ($address === null) {
            return false;
        }

        $normalized = $this->normalizeForComparison($address);
        if ($normalized === '' || ! preg_match('/\p{L}/u', $normalized)) {
            return false;
        }

        if ($this->isGreetingOnly($address)) {
            return false;
        }

        if (mb_strlen($normalized) < self::MIN_ADDRESS_LENGTH) {
            return false;
        }

        if ($this->isKnownCity($normalized)) {
            return false;
        }

        if ($this->isFillerFollowedOnlyByCity($normalized)) {
            return false;
        }

        return true;
    }

    public function isValidCity(?string $city): bool
    {
        if ($city === null) {
            return false;
        }

        $normalized = $this->normalizeForComparison($city);
        if ($normalized === '' || mb_strlen($normalized) < 3) {
            return false;
        }

        if ($this->isGreetingOnly($city)) {
            return false;
        }

        return (bool) preg_match('/^\p{L}+(?:[ \'’-]\p{L}+)*$/u', $normalized);
    }

    public function isValidName(?string $name): bool
    {
        if ($name === null) {
            return false;
        }

        $normalized = $this->normalizeForComparison($name);
        if ($normalized === '' || mb_strlen($normalized) < 2 || ! preg_match('/\p{L}/u', $normalized)) {
            return false;
        }

        if ($this->isGreetingOnly($name) || isset($this->nameStopwords[$normalized])) {
            return false;
        }

        return true;
    }

    public function isValidPhone(?string $phone): bool
    {
        if ($phone === null) {
            return false;
        }

        $digits = preg_replace('/\D+/', '', $phone) ?? '';

        return strlen($digits) >= 9 && strlen($digits) <= 15;
    }

    public function passes(string $field, ?string $value): bool
    {
        return match ($field) {
            'address' => $this->isValidAddress($value),
            'city' => $this->isValidCity($value),
            'name' => $this->isValidName($value),
            'phone' => $this->isValidPhone($value),
            default => false,
        };
    }

    public function isKnownCity(string $value): bool
    {
        $normalized = $this->normalizeForComparison($value);

        return $normalized !== '' && isset($this->cities[$normalized]);
    }

    public function isGreetingOnly(?string $value): bool
    {
        if ($value === null) {
            return false;
        }

        $normalized = $this->normalizeForComparison($value);
        if ($normalized === '') {
            return false;
        }

        if (isset($this->addressStopwords[$normalized])) {
            return true;
        }

        if (isset($this->addressStopwordsCompact[$this->compact($normalized)])) {
            return true;
        }

        $tokens = $this->tokens($normalized);
        if ($tokens === []) {
            return false;
        }

        $sawFiller = false;
        foreach ($tokens as $token) {
            if ($this->isFillerToken($token)) {
                $sawFiller = true;

                continue;
            }

            if (! isset($this->politenessTokens[$token])) {
                return false;
            }
        }

        return $sawFiller;
    }

    /**
     * Drop trailing punctuation so "Bonjour." and "Bonjour!" compare as "Bonjour".
     */
    private function stripTrailingPunctuation(string $value): string
    {
        $value = str_replace(['’', '‘', 'ʼ', '`'], "'", trim($value));

        do {
            $previous = $value;
            $value = trim($value);
            $value = preg_replace('/[\p{P}\p{S}]+$/u', '', $value) ?? $value;
        } while ($value !== $previous);

        return $value;
    }

    public function normalizeForComparison(string $value): string
    {
        $value = mb_strtolower($this->stripTrailingPunctuation($value));
        $value = strtr($value, [
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', 'ã' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'î' => 'i', 'ï' => 'i', 'ì' => 'i',
            'ô' => 'o', 'ö' => 'o', 'ò' => 'o', 'ó' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
            'ç' => 'c', 'ñ' => 'n',
        ]);
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

        return trim($value);
    }

    private function isFillerFollowedOnlyByCity(string $normalized): bool
    {
        $tokens = $this->tokens($normalized);
        if (count($tokens) < 2) {
            return false;
        }

        $index = 0;
        $sawFiller = false;
        while ($index < count($tokens) && ($this->isFillerToken($tokens[$index]) || isset($this->politenessTokens[$tokens[$index]]))) {
            if ($this->isFillerToken($tokens[$index])) {
                $sawFiller = true;
            }
            $index++;
        }

        if (! $sawFiller || $index >= count($tokens)) {
            return false;
        }

        return $this->isKnownCity(implode(' ', array_slice($tokens, $index)));
    }

    private function isFillerToken(string $token): bool
    {
        return isset($this->addressStopwords[$token])
            || isset($this->addressStopwordsCompact[$this->compact($token)]);
    }

    /**
     * @return list<string>
     */
    private function tokens(string $normalized): array
    {
        $parts = preg_split('/\s+/u', $normalized) ?: [];
        $tokens = [];

        foreach ($parts as $part) {
            $token = trim($part, ".,!?;:…\"'«»()[]");
            if ($token !== '') {
                $tokens[] = $token;
            }
        }

        return $tokens;
    }

    private function compact(string $normalized): string
    {
        return str_replace(["'", ' ', '-'], '', $normalized);
    }
}
