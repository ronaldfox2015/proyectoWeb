<?php

namespace Clicks\MongoDB\Collection;

interface CollectionInterface
{

    public function getCollection();

    public function select($where = null);

    public function delete($where);

}
