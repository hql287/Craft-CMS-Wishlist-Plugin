<?php
namespace Craft;

/**
 * Entry Count Model
 */
class Wishlist_ProductModel extends BaseModel
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
      'productId'   => AttributeType::Number,
      'wishlistId'  => AttributeType::Number,
      'dateCreated' => AttributeType::DateTime,
      'dateUpdated' => AttributeType::DateTime,
    );
  }
}
