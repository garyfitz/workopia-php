<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController 
{
  protected $db;
  
  /*
  * Create database object
  * 
  * @return void
  */
  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /*
  * Show all listings
  * 
  * @return void
  */
  public function index() 
  {
    $listings = $this->db->query('SELECT * FROM listings')->fetchAll();

    loadView('listings/index', [
      'listings' => $listings
    ]);
  }

  /*
   * Show the create listing form
   * 
   * @return void
   */
  public function create() 
  {
    loadView('listings/create');
  }

  /*
  * Show the single list item
  * 
  * @return void
  */
  public function show($params) 
  {
    $id = $params['id'] ?? '';

    $params = [
      'id' => $id
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    // Check if listing exists
    If(!$listing) {
      ErrorController::notFound('Listing not found or does not exist');
      exit();
    }

    loadView('listings/show', [
      'listing' => $listing
    ]);
  }
}