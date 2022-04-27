<?php

namespace App\Entity;

class PropertySearch1 {


/**
 * @var float|null
 */
private $maxPrice;


/**
 * @var string|null
 */
private $dates;


/**

 * @var bool
 */
private $etatPayer;





/**
 * Get the value of etatPayer
 *
 * @return  bool
 */ 
public function getEtatPayer()
{
return $this->etatPayer;
}

/**
 * Set the value of etatPayer
 *
 * @param  bool  $etatPayer
 *
 * @return  self
 */ 
public function setEtatPayer(bool $etatPayer)
{
$this->etatPayer = $etatPayer;

return $this;
}

/**
 * Get the value of maxPrice
 *
 * @return  float|null
 */ 
public function getMaxPrice()
{
return $this->maxPrice;
}

/**
 * Set the value of maxPrice
 *
 * @param  float|null  $maxPrice
 *
 * @return  self
 */ 
public function setMaxPrice($maxPrice)
{
$this->maxPrice = $maxPrice;

return $this;
}

/**
 * Get the value of dates
 *
 * @return  string|null
 */ 
public function getDates()
{
return $this->dates;
}

/**
 * Set the value of dates
 *
 * @param  string|null  $dates
 *
 * @return  self
 */ 
public function setDates($dates)
{
$this->dates = $dates;

return $this;
}
}