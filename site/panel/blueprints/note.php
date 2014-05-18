<?php if(!defined('KIRBY')) exit ?>

# notes blueprint

title: Note
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
  date:
    label: Date
    type: date
    required: true
  sale: 
    label: Sale Item
    type: radio
    options:
      forsale:  For Sale
      nosale: Not For Sale
    default: nosale
  price:
    label: Price
    type:  text
  vat:
    label: VAT
    type:  text
  text:
    label: Text
    type:  textarea
    size:  large
    buttons: true
    required: true
  tags:
  	label: Tags
  	type: text