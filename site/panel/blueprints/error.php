<?php if(!defined('KIRBY')) exit ?>

# error blueprint

title: Error
pages: true
files: true
fields:
  title: 
    label: Title
    type:  text
  text: 
    label: Text
    type:  textarea
    size:  smal
    buttons: true
    required: true