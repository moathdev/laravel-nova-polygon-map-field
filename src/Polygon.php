<?php

namespace Moathdev\PolygonMap;

use Grimzy\LaravelMysqlSpatial\Types\LineString as SpatialLineString;
use Grimzy\LaravelMysqlSpatial\Types\Point as SpatialPoint;
use Grimzy\LaravelMysqlSpatial\Types\Polygon as SpatialPolygon;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Polygon extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'polygon-field';

    /**
     * Hydrate the given attribute on the model based on the incomi
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(
        NovaRequest $request,
        $requestAttribute,
        $model,
        $attribute
    ) {
        if ($request->exists($requestAttribute)) {
            $value = $request[$requestAttribute];

            $model->{$attribute} = SpatialPolygon::fromJson($value);
        }
    }

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param  mixed  $resource
     * @param  string  $attribute
     * @return mixed
     */
    protected function resolveAttribute($resource, $attribute)
    {
        $value = parent::resolveAttribute($resource, $attribute);

        if (!$value) {
            // Default area in Riyadh
            return new SpatialPolygon([
                new SpatialLineString([
                    new SpatialPoint(24.7267943, 46.8128664),
                    new SpatialPoint(24.7267943, 46.9128664),
                    new SpatialPoint(24.8267943, 46.8128664),
                    new SpatialPoint(24.7267943, 46.8128664),
                ]),
            ]);
        }

        return $value;
    }
}
