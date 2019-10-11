<?php

class VideoField extends SelectField {

  public $extension;

  public function __construct() {
    $this->icon = 'video';
  }

  public function element() {
    $element = parent::element();
    $element->addClass('field-with-video');
    $element->data('field', 'videofield');
    return $element;
  }

  public function video() {
    return $this->page->video($this->value());
  }

  public function preview() {

    $figure = new Brick('figure');

    if($video = $this->video()) {
      $figure->attr('style', 'background-video: url(' . $video->crop(75)->url() . ')');      
      $url = $video->url('edit');
    } else {
      $figure->attr('style', 'background-video: url(' . $this->value() . ')');      
      $url = '';
    }

    return '<a href="' . $url . '" class="input-preview">' . $figure . '</a>';

  }

  public function input() {
    return $this->preview() . parent::input();
  }

  public function option($filename, $video, $selected = false) {

    if($video == '') {
      return new Brick('option', '', array(
        'value'    => '',
        'selected' => $selected
      ));
    } else {      
      return new Brick('option', $video->filename(), array(
        'value'      => $filename,
        'selected'   => $selected,
        'data-url'   => $video->url('edit'),
        'data-thumb' => $video->crop(75)->url()
      ));
    }

  }

  public function options() {

    $options = [];

    foreach($this->videos() as $video) {
      $options[$video->filename()] = $video;
    }

    return $options;

  }

  public function videos() {

    $videos = $this->page->videos();

    if(!empty($this->extension)) {

      if(!is_array($this->extension)) {
        $extensions = [$this->extension];
      } else {
        $extensions = $this->extension;
      }
      
      $videos = $videos->filter(function($video) use($extensions) {
        return in_array(strtolower($video->extension()), $extensions);
      });        
    
    }

    return $videos;

  }

}
