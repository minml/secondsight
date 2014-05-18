<?php if(!defined('KIRBY')) exit ?>

# notes blueprint

title: Notes
pages:
  template: note
  sort: flip
files: true
fields:
  title: 
    label: Link title
    type:  text
  subtitle: 
    label: Page Title ( If there are no article )
    type:  text
  text: 
    label: Page content ( If there are no article )
    type:  textarea
    size:  medium
    buttons: true