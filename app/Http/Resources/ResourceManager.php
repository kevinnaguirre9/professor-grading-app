<?php

namespace App\Http\Resources;

use App\Http\Resources\Serializers\HalSerializer;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use League\Fractal\Manager as Encoder;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\{Collection, Item};
use League\Fractal\Resource\ResourceInterface;
use Nyholm\Psr7\Uri;

/**
 * Class ResourceManager
 *
 * @package App\Http\Resources
 */
final class ResourceManager
{
    /**
     * @var Encoder
     */
    protected static Encoder $encoder;

    /**
     * @var array
     */
    protected static array $transformers = [];

    /**
     * Get an Encoder Instance
     *
     * @return Encoder
     */
    public static function getEncoder() : Encoder
    {
        return self::$encoder ?? self::initEncoder()
            ;
    }

    /**
     * @return Encoder
     */
    protected static function initEncoder() : Encoder
    {
        self::$encoder = new Encoder();

        self::$transformers = config('schemas');

        return self::$encoder;
    }

    /**
     * @param $resource
     * @return ResourceInterface
     */
    protected static function getItem($resource) : ResourceInterface
    {
        $transformer = self::getTransformer($resource) ?: null;
        $type = $transformer?->getType();

        return new Item($resource, $transformer, $type);
    }

    /**
     * @param $resource
     * @return ResourceInterface
     */
    protected static function getCollection($resource) : ResourceInterface
    {
        $items = $resource;

        if ($resource instanceof LengthAwarePaginator) {

            $items = $resource->getCollection();

            $resource->withPath(URL::full());

            $paginator = new IlluminatePaginatorAdapter($resource);
        }

        $transformer = isset($items[0])
            ? self::getTransformer($items[0])
            : null
        ;
        $type = $transformer?->getType();

        $collection = new Collection($items, $transformer, $type);

        isset($paginator) && $collection->setPaginator($paginator);

        return $collection;
    }

    /**
     * Get transformer for resource
     *
     * @param $resource
     * @return mixed
     */
    protected static function getTransformer($resource)
    {
        $transformer = self::$transformers[get_class($resource)];

        return new $transformer;
    }

    /**
     * Encode a resource
     *
     * @param mixed $resource
     * @return array
     */
    public static function encode($resource)
    {
        $encoder = self::getEncoder();

        self::$encoder->setSerializer(
            new HalSerializer(new Uri(URL::full()))
        );

        $resource = !is_iterable($resource)
            ? self::getItem($resource)
            : self::getCollection($resource)
        ;

//        $encoder->parseIncludes(request()->query('include'));
//        $encoder->parseExcludes(request()->query('exclude'));
//        Read more on https://fractal.thephpleague.com/transformers/

        return $encoder->createData($resource)->toArray();
    }

    /**
     * Create a Response with a json encoded content from a resource
     *
     * @param mixed $resource
     * @param integer $code The HTTP StatusType Code
     * @param string $type
     * @return Response
     */
    public static function createResponse(
        $resource,
        int $code = 200,
        string $type = 'hal+json'
    ) : Response{

        return new Response(
            json_encode(self::encode($resource), JSON_UNESCAPED_SLASHES),
            $code,
            ['Content-Type' => 'application/hal+json']
        );
    }
}
