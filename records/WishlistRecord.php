<?php
namespace Craft;

/**
 * Entry Count Record
 */

class WishlistRecord extends BaseRecord
{
  /**
   * Get Table Name
   *
   * @return string
   */
  public function getTableName()
  {
    return 'wishlist';
  }

  /**
   * Define table columns
   *
   * @return array
   */
  public function defineAttributes()
  {
    return array(
      'title' => array(AttributeType::String, 'default' => '')
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
      'user' => array(static::BELONGS_TO, 'UserRecord', 'required' => true, 'onDelete'=> static::CASCADE)
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
      array('columns' => array('userId'))
    );
  }

}
