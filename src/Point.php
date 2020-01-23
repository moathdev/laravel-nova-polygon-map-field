<?php

namespace Moathdev\PolygonMap;

use Grimzy\LaravelMysqlSpatial\Types\Point as SpatialPoint;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Point extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'point-field';

    /**
     * Hydrate the given attribute on the model based on the incomi
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = SpatialPoint::fromJson($request[$requestAttribute]);
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
            return new SpatialPoint(0, 0);
        }

        return $value;
    }
}
