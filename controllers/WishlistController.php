<?php
namespace Craft;

class WishlistController extends BaseController
{
  // Create a new wishlist
  public function actionAdd()
  {
    // set wishlistId variable from params
    $title  = craft()->request->getRequiredParam('title');
    $redirectUrl = craft()->request->getParam('redirect');

    // Create a new wishlist with above title
    craft()->wishlist->add($title);

    // Set Flash message
    craft()->userSession->setFlash('wishlistAdded', 'Wishlist Added');

    // Redirect to plugin index page
    if($redirectUrl)
    {
    $this->redirect($redirectUrl);
    }

    $this->redirect('wishlist');
  }

  // Add a product to wishlist
  public function actionAddProductToWishlist()
  {
    // set wishlistId variable from params
    $productId   = craft()->request->getRequiredParam('productId');
    $wishlistId  = craft()->request->getRequiredParam('wishlistId');
    $redirectUrl = craft()->request->getRequiredParam('redirect');

    // Create a new wishlist with above title
    craft()->wishlist->addProductToWishlist($productId, $wishlistId);

    // Set Flash message
    craft()->userSession->setFlash('addProductToWishlistSuccess', 'Product has been added to wishlist!');

    // Redirect to plugin index page
    $this->redirect($redirectUrl);
  }

  // Remove a product from a wishlist
  public function actionRemoveProductFromWishlist()
  {
    // set wishlistId variable from params
    $wishlistId  = craft()->request->getRequiredParam('wishlistId');
    $productId   = craft()->request->getRequiredParam('productId');
    $redirectUrl = craft()->request->getRequiredParam('redirect');

    // Create a new wishlist with above title
    craft()->wishlist->removeProductFromWishlist($wishlistId, $productId);

    // Set Flash message
    craft()->userSession->setFlash('removeProductFromWishlistSuccess', 'Product has been removed from wishlist!');

    // Redirect to plugin index page
    $this->redirect($redirectUrl);
  }

  // Delete a wishlist
  public function actionDelete()
  {
    // set wishlistId variable from params
    $wishlistId  = craft()->request->getRequiredParam('id');
    $redirectUrl = craft()->request->getParam('redirect');

    // delete the wishlist with that id
    craft()->wishlist->delete($wishlistId);

    // Notify user
    craft()->userSession->setNotice(Craft::t('Wishlist deleted!'));

    // Set Flash message
    craft()->userSession->setFlash('wishlistDeleted', 'Wishlist deleted!');

    // Redirect to plugin index page
    if($redirectUrl)
    {
    $this->redirect($redirectUrl);
    }

    $this->redirect('wishlist');
  }
}
