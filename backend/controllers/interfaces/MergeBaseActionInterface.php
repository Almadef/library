<?php

namespace backend\controllers\interfaces;

/**
 * Interface MergeBaseActionInterface
 * @package backend\controllers\interfaces
 */
interface MergeBaseActionInterface
{
    /**
     * @return mixed
     */
    public function getSearchModel();

    /**
     * @return mixed
     */
    public function getModelClass();

    /**
     * @return mixed
     */
    public function getCacheTags();

    /**
     * @param $id
     * @return mixed
     */
    public function findModel($id);
}
