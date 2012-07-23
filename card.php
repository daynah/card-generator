<?php

/*****************************************************************************
 Card Generator
 Class Name: cardClass
 Purpose: This class adds personalized message onto a blank card image.
 Filename: card.php
*****************************************************************************/

Class cardClass {
	
	// List of available card templates
	var $cardFiles;
	
	// Selected template
	var $selectedCard;
	
	// Message for th card
	var $message;
	
	// From field
	var $card_from;
	
	// To field
	var $card_to;
	
	// Font name
	var $fontname;
	
	// Font size
	var $fontsize;
	
	// Font color
	var $fontcolor;
	
	// Filename (if user wants to save a copy of it)
	var $filename;
	
	// Constructor
	function __construct($selectedCard) {	
	
		// Set the selected card ID if its not defined
	    if(!is_numeric($selectedCard))
	    	$this->selectedCard = 1;
	    else
			$this->selectedCard = $selectedCard;
			
		$this->cardFiles    = CardConfig::$cardImages;	  
		$this->fontname     = CardConfig::$fontname;
		$this->fontsize     = CardConfig::$fontsize;
                                                                                                                                                                                                                                                                                                                                                                                                                                    
	}
	
	// Create an image file
	function createFile()
	{
		$image = $this->cardFiles[$this->selectedCard];
		return imagecreatefrompng($image);
	}
	
	// Overlay the text onto the image file
	function generateFile()
	{
		// Create image
		$myImage = $this->createFile($this->selectedCard);

		// Set font color (black)
		$this->fontcolor = imagecolorallocate($myImage, 0,0,0);

		// Format message on the card
		$myMessage = wordwrap(stripslashes($this->message), 30);

		// Set the font smaller if the number of letters in the message exceeds 300
		if(strlen($myMessage) > 300)
		{
        	$msgFontSize = 8;
        	$myMessage = wordwrap($myMessage, 45); 
        }
        
        // If message is greater than 150 (but less than 130), set font to be size 9
        else if(strlen($myMessage) > 150)
        {
       		$msgFontSize = 9;
       		$myMessage = wordwrap($myMessage, 50); 
       	}

       	// If message is greater than 108 characters (but less than 150), set font to be size 11
       	else if(strlen($myMessage) > 108)
       	{
        	$msgFontSize = 11;
        	$myMessage = wordwrap($myMessage, 45); 
        }

        // Short messages get bigger font size
        else
        {
	        $msgFontSize = 12;
        }
		
		// Add text to the image
		// Info for To, From
		ImageTTFText ($myImage, 15, 0, 80, 62, $this->fontcolor, $this->fontname, $this->card_to);
		ImageTTFText ($myImage, 15, 0, 110, 112, $this->fontcolor, $this->fontname, $this->card_from);

		// Info for message
		ImageTTFText ($myImage, $msgFontSize, 0, 45, 140, $this->fontcolor, $this->fontname, $myMessage);

		// Output image (PNG file)
		header("Content-type: image/png");
		imagepng($myImage,$myImageOutput);

		// Destroy image (free up memory)
		imagedestroy($myImage);

	}
}

?>
