<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;


class UploadImage
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function encode(){
        $request = $this->requestStack->getCurrentRequest();
        $im = $request->files->all()['file']->getRealPath();
        $image = fopen($im, 'rb');
        $image = stream_get_contents($image);
        return $image;
    }
    
}