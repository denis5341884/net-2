<?
function jaguar_demotivator($image_file, $header, $text = null){
    $dem = new Jaguar_Dem();
    return $dem->make($image_file, $header, $text);
}
class Jaguar_Dem{
    //шрифт заголовка
    public $header_font;
    //размер текста заголовка
    public $header_size = 32.5;
    //шрифт демотиватора
    public $text_font;
    //размер текста демотиватора
    public $text_size   = 24.0;
    public $image_margin = 10;
    //отступы между строками
    public $spacing = 10;
    //отступы вокруг картинки
    public $border_pad = 10;

    function loadImageByType($filename,$type){
        switch($type)
        {
            case IMAGETYPE_GIF:
                return @imagecreatefromgif($filename);
            case IMAGETYPE_JPEG:
                return @imagecreatefromjpeg($filename);
            case IMAGETYPE_PNG:
                return @imagecreatefrompng($filename);
            default:
                return false;
        }
    }

    //создание дема
    function make($image_file, $header, $text = null){
        if(!$this->text_font)   $this->text_font   = $_SERVER['DOCUMENT_ROOT'].'/cms/arial.ttf';
        if(!$this->header_font) $this->header_font = $_SERVER['DOCUMENT_ROOT'].'/cms/arial.ttf';

        if(!getimagesize( $image_file )){
            return false;
        }
        list($w, $h, $type) = getimagesize( $image_file );
        $img = $this->loadImageByType($image_file, $type);
        if(!$img){
            return false;
        }

        $ha1 = imagettfbbox($this->header_size, 0, $this->header_font, $header );
        //print_r( $ha1);exit;
        $ha2 = imagettfbbox($this->text_size, 0, $this->text_font, $text );

        $wt1 = $ha1[2]-$ha1[0];
        $ht1 = $ha1[1]-$ha1[7];
        $wt2 = $ha2[2]-$ha2[0];
        $ht2 = $ha2[1]-$ha2[7];

        $fw = $w + 8 + $this->image_margin * 2 + $this->border_pad * 2;
        $fh = $h + 8 + $this->image_margin * 2 + $this->border_pad * 2 + $ht1 + $ht2 + $this->spacing * 3;
        $dem = imagecreatetruecolor($fw, $fh);

        $white = imagecolorallocate( $dem, 255, 255, 255 );
        $black = imagecolorallocate( $dem,   0,   0,   0 );
        imagefill( $dem, 0, 0, $black );

        imagecopy( $dem, $img, $this->image_margin + $this->border_pad + 4, $this->image_margin + $this->border_pad + 4, 0, 0, $w, $h );

        imagerectangle( $dem, $this->image_margin + $this->border_pad + 4 - 3, $this->image_margin + $this->border_pad + 4 - 3,
        $this->image_margin + $this->border_pad + $w + 4 + 2, $this->image_margin + $this->border_pad + $h + 4 + 2, $white );
        imagerectangle( $dem, $this->image_margin + $this->border_pad + 4 - 4, $this->image_margin + $this->border_pad + 4 - 4,
        $this->image_margin + $this->border_pad + $w + 4 + 3, $this->image_margin + $this->border_pad + $h + 4 + 3, $white );

        imagettftext( $dem, $this->header_size, 0,
        ($fw - $wt1) / 2, $this->image_margin + $this->border_pad*2 + 8 + $h + $ht1 + $this->spacing,
        $white, $this->header_font, $header );

        imagettftext( $dem, $this->text_size, 0,
        ($fw - $wt2) / 2, $this->image_margin + $this->border_pad*2 + 8 + $h + $ht1 + $ht2 + $this->spacing*2,
        $white, $this->text_font, $text );
        return $dem;
    }

}
?>