<?php
namespace Craft;

/**
 * Entry Count Model
 */
class WishlistModel extends BaseModel
{

  /**
  * Define Model Attributes
  *
  * @return array
  */
  public function defineAttributes()
  {
    return array(
      'id'          => AttributeType::Number,
      'userId'      => AttributeType::Number,
      'title'       => AttributeType::String,
      'dateCreated' => AttributeType::DateTime,
      'dateUpdated' => AttributeType::DateTime,
    );
  }
}
