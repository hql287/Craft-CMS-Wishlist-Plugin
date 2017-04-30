<?php
namespace Craft;

/**
 * Entry Count Record
 */

class Wishlist_ProductRecord extends BaseRecord
{
  /**
   * Get Table Name
   *
   * @return string
   */
  public function getTableName()
  {
    return 'wishlist_product';
  }

  /**
   * Define table columns
   *
   * @return array
   */
  public function defineAttributes()
  {
    return array(
      'productId' => array(AttributeType::Number),
      'wishlistId' => array(AttributeType::Number)
    );
  }

  /**
   * Define relationships with other tables
   *
   * @return array
   */
  public function defineRelations()
  {
    return array(
      'product'  => array(static::BELONGS_TO, 'Commerce_ProductRecord', 'required' => true, 'onDelete'=> static::CASCADE),
      'wishlist' => array(static::BELONGS_TO, 'WishlistRecord', 'required' => true, 'onDelete'=> static::CASCADE)
    );
  }

  /**
   * Define Table Indexes
   *
   * @return array
   */
  public function defineIndexes()
  {
    return array(
      array('columns' => array('wishlistId'))
    );
  }

}
