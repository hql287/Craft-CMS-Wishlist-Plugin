<?php
namespace Craft;

class WishlistVariable
{
  // Retrieve all wishlists
  public function getWishlists()
  {
    return craft()->wishlist->getWishlists();
  }

  // Retrieve a single wishlist
  public function getWishlist($wishlistId)
  {
    return craft()->wishlist->getWishlist($wishlistId);
  }

  // Retrieve all wishlists belongs to a user
  public function getCurrentUserWishlists()
  {
    return craft()->wishlist->getCurrentUserWishlists();
  }

  // Create a new wishlist
  public function add($title)
  {
    return craft()->wishlist->add($title);
  }

  // Delete a wishlist
  public function delete($wishlistId)
  {
    return craft()->wishlist->delete($wishlistId);
  }

  // Get products from a wishlist
  public function products($wishlistId)
  {
    return craft()->wishlist->products($wishlistId);
  }
}
