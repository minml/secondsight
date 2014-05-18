<?php if(!defined('KIRBY')) exit ?>

# Homepage Article blueprint

title: Homepage Article
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
  text:
    label: Text
    type:  textarea
    size:  large
    buttons: true
    required: true