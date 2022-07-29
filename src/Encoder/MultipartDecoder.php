<?php

namespace App\Encoder;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

final class MultipartDecoder implements DecoderInterface
{
    public const FORMAT = 'multipart';

    public function __construct(private RequestStack $requestStack) {}

    /**
     * {@inheritdoc}
     */
    public function decode(string $data, string $format, array $context = []): ?array
    {   
        dd($data);
        $request = $this->requestStack->getCurrentRequest();
        // dd($request);
        // dd($request->request->all());
        $request->request->set("prix",intval($request->request->all()["prix"]));

        if (!$request) {
            return null;
        }
        return array_map(static function ($element) {
            // Multipart form values will be encoded in JSON.
            $decoded = json_decode($element, true);
            // dd($element);
            return \is_array($decoded) ? $decoded : $element;
          
        },
         $request->request->all()) + $request->files->all();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDecoding(string $format): bool
    {
        return self::FORMAT === $format;
    }
}