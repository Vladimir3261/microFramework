<?php

/**
 * Description of watermark
 *
 * @author vladimir
 */
class watermark {
    /*
     * Allowed types jpg png 
     */
    public $stamp = null;
    public $image = null;
    public $text = null;
    public $right = 0;
    public $bottom = 0;
    public $text_top = 0;
    public $text_left = 0;
    public $color = '#000000';
    public $font = '/arial.ttf';
    public $opacity = 0;
    public $font_size = 50;
    
    public function run() {
        $this->font = __DIR__.$this->font;
        if($this->image && $this->stamp){
            $this->createImage();
        }
        if($this->text){
            $this->textWatermark();
        }
    }
    
    
    function createImage(){
        // Image MIME type
        if(mime_content_type($this->image) == 'image/png'){
            $im = imagecreatefrompng($this->image);
        }elseif(mime_content_type($this->image) == 'image/jpeg'){
            $im = imagecreatefromjpeg($this->image);
        }
        // Stamp MIME type
        if(mime_content_type($this->stamp) == 'image/png'){
            $stamp = imagecreatefrompng($this->stamp);
        }elseif(mime_content_type($this->image) == 'image/jpeg'){
            $stamp = imagecreatefromjpeg($this->stamp);
        }
        
        // SET fields for stamp and get stamp width and height
        $marge_right = (imagesx($im)/100)*$this->right;
        $marge_bottom = (imagesy($im)/100)*$this->bottom;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
        // Copy stamp in the image
        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        imagejpeg($im, $this->image);        
    }
    public function textWatermark(){
 
      include('TtfText.php');
      // Берем сохраненную картинку
      $ttfImg = new ttfTextOnImage($this->image);
      // Пишем шрифтом cursive размером 100 пунктов белым цветом с 0%-ой прозрачностью 
      $ttfImg->setFont($this->font, $this->font_size, $this->color, $this->opacity);      
      $ttfImg->writeText($this->text_left, $this->text_top, $this->text);

      // Шрифтом Constantin размером 15 пунктов оранжевым цветом с 90%-ой прозрачностью 
      //$ttfImg->setFont('../public/files/cursive.ttf', 15, "#ff8200", 90);      

      // Хотим написать много, поэтому сначала отформатируем наш текст
      //$message = $ttfImg->textFormat(400, 500, $this->text);

      // Пишем (чуть-чуть наклоним)
      //$ttfImg->writeText(40, 100, $message, 5);

      // и вывод в файл
      $ttfImg->output($this->image);
    }
}
/*
 * 1. Позиционирование картиники в процентах* 2. Добавление текста 3. Интеграция
 */