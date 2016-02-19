<?php

namespace Devio\Propertier\Relations;

use Illuminate\Database\Eloquent\Collection;

class HasMany extends \Illuminate\Database\Eloquent\Relations\HasMany
{
    /**
     * Match the eagerly loaded results to their many parents.
     *
     * @param array $models
     * @param Collection $results
     * @param string $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);

        foreach ($models as $model) {
            $key = $model->getAttribute($this->localKey);

            if (isset($dictionary[$key])) {
                $model->allocate(collect($dictionary[$key]));
            }
        }

        return $models;
    }
}