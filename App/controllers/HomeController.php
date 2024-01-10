<?php

namespace App\Controllers;

use Framework\Database;

class HomeController 
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
  * Show the homepage and pass through the listings
  * 
  * @return void
  */
  public function index() 
  {
    $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

    loadView('home', [
      'listings' => $listings
    ]);
  }
}