<?php

/*****************************************************************************
 Card Generator
 Purpose: Main program; creates a new card, test case is $selectedCard = 3;
 Filename: index.php
*****************************************************************************/

require_once("card.php");
require_once("config.php");

// Test script with holidaycard3.png                  
$selectedCard = 3;

// Create new cardClass object
$card = new cardClass($selectedCard);


// Variables passed from a form a user fills out
$card->message = "Test";
$card->card_from = "From: Test User";
$card->card_to = "To: Test Receipient";
$card->generateFile();

?>