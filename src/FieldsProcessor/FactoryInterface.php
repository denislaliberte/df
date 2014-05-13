<?php

namespace FieldsProcessor;

use DrupalAdapter\Entity;

interface FactoryInterface
{
  public function get_fields_processor(Entity $entity);
}
