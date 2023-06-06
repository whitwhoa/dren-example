<?php


namespace App\Model\Entities;


use Dren\Entity;
use Dren\App;



class KeyVal extends Entity
{

    protected $hasDbCon = true; // If not specified, will default to true. Set to false if this model does not require database connectivity.
    protected $dbName = 'drencrom_test'; // If not specified, will connect to the first database within configuration file
    protected $table = 'key_vals'; // Required


    /*
     *  Entity provides basic SELECT, INSERT, UPDATE, and DELETE functionality for a single
     *  instantiated instance (See Docs). ANY additional functionality ie more complex queries
     *  related to the defined $table property can be (and are intended to be) implemented within
     *  these classes. In short: ALL DATABASE INTERACTION IS TO BE IMPLEMENTED WITHIN AN ENTITY CLASS!
     *
     *  We are not trying to be a full-featured ORM here, just provide a super basic way to work with
     *  single instances of records (creating, finding, updating). The responsibility of more complicated
     *  database interaction falls back to the developer (so you need a healthy understanding of SQL),
     *  which for small projects that need to perform towards the upper limit of what php is capable of,
     *  turns out to be perfect.
     *
     */

}