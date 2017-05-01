<?php
namespace Craft;

class WishlistService extends BaseApplicationComponent
{
  // Get all wishlists
  public function getWishlists()
  {
    $wishlists = WishlistRecord::model()->findAll();
    return $wishlists;
  }

  // Get a single wishlist
  public function getWishlist($wishlistId)
  {
    // Find wishlist via id
    $wishlist = WishlistRecord::model()->findByAttributes(array('id' => $wishlistId));

    // If that record is not found
    if(!$wishlist)
    {
      // Set Flash message
      craft()->userSession->setFlash('noWishlistWithGivenIdFound', 'No wishlist with that Id!');

      // Redirect to plugin index page
      craft()->request->redirect('/users/wishlists');
    }

    if($this->_isOwner($wishlistId))
    {
      return $wishlist;
    }
    else
    {
      // Set Flash message
      craft()->userSession->setFlash('noPermissionToViewWishlist', 'You do not have permission to view that wishlist content!');

      // Redirect to plugin index page
      craft()->request->redirect('/users/wishlists');
    }
  }

  // Get all wishlists of the current user
  public function getCurrentUserWishlists()
  {
    // get current user id
    $currentUser   = craft()->userSession->getUser();
    $currentUserId = $currentUser->id;

    // get all wishlist from the DB
    $wishlists = WishlistRecord::model()->findAllByAttributes(array('userId' => $currentUserId));

    return $wishlists;
  }

  // Get all wishlists of a user
  public function getUserWishlists($userId)
  {
    // get all wishlist from the DB
    $wishlists = WishlistRecord::model()->findAllByAttributes(array('userId' => $userId));

    return $wishlists;
  }

  // Create a new wishlist
  public function add($title)
  {
    // get current user id
    $currentUser   = craft()->userSession->getUser();
    $currentUserId = $currentUser->id;

    // populate new record
    $wishlistRecord         = new WishlistRecord();
    $wishlistRecord->title  = $title;
    $wishlistRecord->userId = $currentUserId;

    // save the record
    $wishlistRecord->save();
  }

  // Delete a wishlist
  public function delete($wishlistId)
  {
    // get record from db
    $wishlistRecord = WishlistRecord::model()->findByAttributes(array('id' => $wishlistId));

    if($wishlistRecord)
    {
      // delete record from DB
      $wishlistRecord->delete();
    }
  }

  // Get all products in a wishlist
  public function products($wishlistId)
  {

    //Find all wishlist records
    $wishlistRecords = Wishlist_ProductRecord::model()->findAllByAttributes(array('wishlistId' => $wishlistId));

    $productIds = array();

    // Loop through the records of entryCount to collect all entryId
    foreach ($wishlistRecords as $wishlistRecord) {
      // add each of them to the empty array above
      $productIds[] = $wishlistRecord->productId;
    }

    // set critria for craft to search for entries
    $criteria             = craft()->elements->getCriteria('Commerce_Product');
    $criteria->id         = $productIds;
    $criteria->fixedOrder = true;

    // return the entries
    return $criteria;
  }

  // Add a product to a wishlist
  public function addProductToWishlist($productId, $wishlistId)
  {
    $wishlistProductRecord = Wishlist_ProductRecord::model()->findByAttributes(array('productId' => $productId, 'wishlistId' => $wishlistId));
    if(!$wishlistProductRecord)
    {
      $wishlistProductRecord = new Wishlist_ProductRecord();
      $wishlistProductRecord->productId  = $productId;
      $wishlistProductRecord->wishlistId = $wishlistId;
      $wishlistProductRecord->save();
    }
  }

  // Remove a product from a wishlist
  public function removeProductFromWishlist($wishlistId, $productId)
  {
    $wishlistProductRecord = Wishlist_ProductRecord::model()->findByAttributes(array('wishlistId' => $wishlistId, 'productId' => $productId));
    if($wishlistProductRecord)
    {
      // delete record from DB
      $wishlistProductRecord->delete();
    }
  }

  // Check if the current user is the owner of the requested wishlist
  protected function _isOwner($wishlistId)
  {
    // get current user id
    $currentUser   = craft()->userSession->getUser();
    $currentUserId = $currentUser->id;

    // get all wishlist from the DB
    $wishlistRecord = WishlistRecord::model()->findByAttributes(array('id' => $wishlistId));

    // Check if 2 ids are equal
    if ($currentUserId == $wishlistRecord->userId){
      return true;
    }
    return false;
  }
}
