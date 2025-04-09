<?php

/*
 * A lightweight class for working with colours.
 *
 * Works in either RGB or HSV mode and also supports the complete list of web colours.
 * Does not require any dependencies.
 *
 * @package DreamLibrary
 * @author Lauri Elevant <lauri.elevant@dreamgroup.info>
 */

namespace Dream;

use InvalidArgumentException;
use LogicException;

/**
 * @property float $R
 * @property float $G
 * @property float $B
 * @property float $H
 * @property float $S
 * @property float $V
 */
final class Colour
{
    public const RGB = 'RGB';
    public const HSV = 'HSV';

    /**
     * Mapping of web names to RGB values.
     *
     * @var array
     */

    private static $_web = [
        'aliceblue'            => '#f0f8ff',
        'antiquewhite'         => '#faebd7',
        'aqua'                 => '#00ffff',
        'aquamarine'           => '#7fffd4',
        'azure'                => '#f0ffff',
        'beige'                => '#f5f5dc',
        'bisque'               => '#ffe4c4',
        'black'                => '#000000',
        'blanchedalmond'       => '#ffebcd',
        'blue'                 => '#0000ff',
        'blueviolet'           => '#8a2be2',
        'brown'                => '#a52a2a',
        'burlywood'            => '#deb887',
        'cadetblue'            => '#5f9ea0',
        'chartreuse'           => '#7fff00',
        'chocolate'            => '#d2691e',
        'coral'                => '#ff7f50',
        'cornflowerblue'       => '#6495ed',
        'cornsilk'             => '#fff8dc',
        'crimson'              => '#dc143c',
        'cyan'                 => '#00ffff',
        'darkblue'             => '#00008b',
        'darkcyan'             => '#008b8b',
        'darkgoldenrod'        => '#b8860b',
        'darkgray'             => '#a9a9a9',
        'darkgrey'             => '#a9a9a9',
        'darkgreen'            => '#006400',
        'darkkhaki'            => '#bdb76b',
        'darkmagenta'          => '#8b008b',
        'darkolivegreen'       => '#556b2f',
        'darkorange'           => '#ff8c00',
        'darkorchid'           => '#9932cc',
        'darkred'              => '#8b0000',
        'darksalmon'           => '#e9967a',
        'darkseagreen'         => '#8fbc8f',
        'darkslateblue'        => '#483d8b',
        'darkslategray'        => '#2f4f4f',
        'darkslategrey'        => '#2f4f4f',
        'darkturquoise'        => '#00ced1',
        'darkviolet'           => '#9400d3',
        'deeppink'             => '#ff1493',
        'deepskyblue'          => '#00bfff',
        'dimgray'              => '#696969',
        'dimgrey'              => '#696969',
        'dodgerblue'           => '#1e90ff',
        'firebrick'            => '#b22222',
        'floralwhite'          => '#fffaf0',
        'forestgreen'          => '#228b22',
        'fuchsia'              => '#ff00ff',
        'gainsboro'            => '#dcdcdc',
        'ghostwhite'           => '#f8f8ff',
        'gold'                 => '#ffd700',
        'goldenrod'            => '#daa520',
        'gray'                 => '#808080',
        'grey'                 => '#808080',
        'green'                => '#008000',
        'greenyellow'          => '#adff2f',
        'honeydew'             => '#f0fff0',
        'hotpink'              => '#ff69b4',
        'indianred '           => '#cd5c5c',
        'indigo '              => '#4b0082',
        'ivory'                => '#fffff0',
        'khaki'                => '#f0e68c',
        'lavender'             => '#e6e6fa',
        'lavenderblush'        => '#fff0f5',
        'lawngreen'            => '#7cfc00',
        'lemonchiffon'         => '#fffacd',
        'lightblue'            => '#add8e6',
        'lightcoral'           => '#f08080',
        'lightcyan'            => '#e0ffff',
        'lightgoldenrodyellow' => '#fafad2',
        'lightgray'            => '#d3d3d3',
        'lightgrey'            => '#d3d3d3',
        'lightgreen'           => '#90ee90',
        'lightpink'            => '#ffb6c1',
        'lightsalmon'          => '#ffa07a',
        'lightseagreen'        => '#20b2aa',
        'lightskyblue'         => '#87cefa',
        'lightslategray'       => '#778899',
        'lightslategrey'       => '#778899',
        'lightsteelblue'       => '#b0c4de',
        'lightyellow'          => '#ffffe0',
        'lime'                 => '#00ff00',
        'limegreen'            => '#32cd32',
        'linen'                => '#faf0e6',
        'magenta'              => '#ff00ff',
        'maroon'               => '#800000',
        'mediumaquamarine'     => '#66cdaa',
        'mediumblue'           => '#0000cd',
        'mediumorchid'         => '#ba55d3',
        'mediumpurple'         => '#9370d8',
        'mediumseagreen'       => '#3cb371',
        'mediumslateblue'      => '#7b68ee',
        'mediumspringgreen'    => '#00fa9a',
        'mediumturquoise'      => '#48d1cc',
        'mediumvioletred'      => '#c71585',
        'midnightblue'         => '#191970',
        'mintcream'            => '#f5fffa',
        'mistyrose'            => '#ffe4e1',
        'moccasin'             => '#ffe4b5',
        'navajowhite'          => '#ffdead',
        'navy'                 => '#000080',
        'oldlace'              => '#fdf5e6',
        'olive'                => '#808000',
        'olivedrab'            => '#6b8e23',
        'orange'               => '#ffa500',
        'orangered'            => '#ff4500',
        'orchid'               => '#da70d6',
        'palegoldenrod'        => '#eee8aa',
        'palegreen'            => '#98fb98',
        'paleturquoise'        => '#afeeee',
        'palevioletred'        => '#d87093',
        'papayawhip'           => '#ffefd5',
        'peachpuff'            => '#ffdab9',
        'peru'                 => '#cd853f',
        'pink'                 => '#ffc0cb',
        'plum'                 => '#dda0dd',
        'powderblue'           => '#b0e0e6',
        'purple'               => '#800080',
        'red'                  => '#ff0000',
        'rosybrown'            => '#bc8f8f',
        'royalblue'            => '#4169e1',
        'saddlebrown'          => '#8b4513',
        'salmon'               => '#fa8072',
        'sandybrown'           => '#f4a460',
        'seagreen'             => '#2e8b57',
        'seashell'             => '#fff5ee',
        'sienna'               => '#a0522d',
        'silver'               => '#c0c0c0',
        'skyblue'              => '#87ceeb',
        'slateblue'            => '#6a5acd',
        'slategray'            => '#708090',
        'slategrey'            => '#708090',
        'snow'                 => '#fffafa',
        'springgreen'          => '#00ff7f',
        'steelblue'            => '#4682b4',
        'tan'                  => '#d2b48c',
        'teal'                 => '#008080',
        'thistle'              => '#d8bfd8',
        'tomato'               => '#ff6347',
        'turquoise'            => '#40e0d0',
        'violet'               => '#ee82ee',
        'wheat'                => '#f5deb3',
        'white'                => '#ffffff',
        'whitesmoke'           => '#f5f5f5',
        'yellow'               => '#ffff00',
        'yellowgreen'          => '#9acd32',
    ];

    private $_type;

    private $_p1, $_p2, $_p3;


    /**
     * Lists all the web safe colours that this library supports
     * @return array
     */

    public static function getWebs(): array
    {
        return self::$_web;
    }



    /**
     * Validates a colour webname
     *
     * @param string $web Web colour name to be evaluated
     * @return bool
     */

    public static function isWeb(string $web): bool
    {
        $web = strtolower($web);

        return array_key_exists($web, self::$_web);
    }


    /**
     * Validates a hex-encoded RGB value
     *
     * @param string $hex Hex encoded colour name to be evaluated
     * @return bool
     */

    public static function isHex(string $hex): bool
    {
        if (preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $hex)) {
            return true;
        }

        return false;
    }


    /**
     * Provides the factory pattern for invoking a new Colour
     * instance from a hex-encoded RGB value.
     *
     * This is handy, as the class itself needs the real RGB or HSV
     * values as construction parametres and this method takes care
     * of translating them.
     *
     * @param string $hex
     * @return self
     * @throws InvalidArgumentException
     */

    public static function factoryHex(string $hex): self
    {
        if (!self::isHex($hex)) {

            if (self::isWeb($hex)) {
                $hex = self::$_web[$hex];
            } else {
                throw new InvalidArgumentException('Illegal colour: ' . $hex);
            }

        }

        $r = (float) base_convert(substr($hex, 1, 2), 16, 10);
        $g = (float) base_convert(substr($hex, 3, 2), 16, 10);
        $b = (float) base_convert(substr($hex, 5, 2), 16, 10);

        return new self($r, $g, $b, self::RGB);
    }


    /**
     * Contructor to create a new Colour instance based on
     * either HSV or RGB values (default).
     *
     * @param float $p1 The 1st colour component (R or H)
     * @param float $p2 The 2nd colour component (G or S)
     * @param float $p3 The 3rd colour component (B or V)
     * @param string $type A constant representing either RGB (default) or HSV mode
     */

    public function __construct(float $p1, float $p2, float $p3, string $type = self::RGB)
    {
        $this->_type = $type;

        $this->_p1 = $p1;
        $this->_p2 = $p2;
        $this->_p3 = $p3;
    }


    /**
     * Universal magic getter method for retrieveing any
     * colour component value (H, S, V or R, G, B).
     *
     * Just use $colour->R to get the red component.
     *
     * @param string $name One of: R,G,B,H,S,V
     * @return float
     * @throws InvalidArgumentException
     */

    public function __get(string $name): float
    {
        $name = strtoupper($name);

        switch ($name) {

            case 'H':
                $this->_flip(self::HSV);
                return $this->_p1;
            case 'S':
                $this->_flip(self::HSV);
                return $this->_p2;
            case 'V':
                $this->_flip(self::HSV);
                return $this->_p3;

            case 'R':
                $this->_flip(self::RGB);
                return $this->_p1;
            case 'G':
                $this->_flip(self::RGB);
                return $this->_p2;
            case 'B':
                $this->_flip(self::RGB);
                return $this->_p3;

        }

        throw new InvalidArgumentException('Get what?');
    }


    /**
     * Universal magic setter method for setting any
     * colour component value (H, S, V or R, G, B).
     *
     * Just use $colour->R to set the red component.
     *
     * @param string $name One of: R,G,B,H,S,V
     * @param float $value the colour component value
     * @throws InvalidArgumentException
     */

    public function __set(string $name, float $value): void
    {
        $name = strtoupper($name);

        switch ($name) {

            case 'H':
                $this->_flip(self::HSV);
                $this->_p1 = self::_bounds($value, 0, 360);
                return;
            case 'S':
                $this->_flip(self::HSV);
                $this->_p2 = self::_bounds($value, 0, 1);
                return;
            case 'V':
                $this->_flip(self::HSV);
                $this->_p3 = self::_bounds($value, 0, 1);
                return;

            case 'R':
                $this->_flip(self::RGB);
                $this->_p1 = self::_bounds($value, 0, 255);
                return;
            case 'G':
                $this->_flip(self::RGB);
                $this->_p2 = self::_bounds($value, 0, 255);
                return;
            case 'B':
                $this->_flip(self::RGB);
                $this->_p3 = self::_bounds($value, 0, 255);
                return;
        }

        throw new InvalidArgumentException('Set what?');
    }


    /**
     * This changes the internal colour representation mode
     * between RGB and HSV, so that the p1..p3 will contain
     * the corresponding values.
     *
     * @param string $to RGB or HSV
     * @return void
     * @throws LogicException
     */

    private function _flip(string $to): void
    {
        if ($this->_type == $to) {
            return;
        }

        switch ($this->_type) {

            case self::RGB:
                $this->_type = self::HSV;
                [$this->_p1, $this->_p2, $this->_p3] = self::_rgb2hsv($this->_p1, $this->_p2, $this->_p3);
                return;

            case self::HSV:
                $this->_type = self::RGB;
                [$this->_p1, $this->_p2, $this->_p3] = self::_hsv2rgb($this->_p1, $this->_p2, $this->_p3);
                return;
        }

        throw new LogicException('Flip failed');
    }


    /**
     * Formats the colour as a
     * hex-encoded RGB value.
     *
     * @return string
     */

    public function getHex(): string
    {
        $this->_flip(self::RGB);

        return '#' . sprintf("%02X%02X%02X", round($this->_p1), round($this->_p2), round($this->_p3));
    }

    /**
     * Brightness score as per:
     * http://www.nbdtech.com/Blog/archive/2008/04/27/Calculating-the-Perceived-Brightness-of-a-Color.aspx
     *
     * @return int 0...255
     */

    public function getBrightness(): int
    {
        $this->_flip(self::RGB);

        return (int)sqrt(
        0.241 * pow($this->_p1, 2) +
            0.691 * pow($this->_p2, 2) +
            0.068 * pow($this->_p3, 2)
        );

    }
    
    /**
     * Calculates the luminosity of an given RGB colour.
     * The luminosity equations are from the WCAG 2 requirements:
     * http://www.w3.org/TR/WCAG20/#relativeluminancedef
     *
     * @return float
     */

    public function getLuminosity(): float
    {
        $this->_flip(self::RGB);

        $r = $this->_p1 / 255; // R
        $g = $this->_p2 / 255; // G
        $b = $this->_p3 / 255; // B

        if ($r <= 0.03928) {
            $r = $r / 12.92;
        } else {
            $r = pow(($r + 0.055) / 1.055, 2.4);
        }

        if ($g <= 0.03928) {
            $g = $g / 12.92;
        } else {
            $g = pow(($g + 0.055) / 1.055, 2.4);
        }

        if ($b <= 0.03928) {
            $b = $b / 12.92;
        } else {
            $b = pow(($b + 0.055) / 1.055, 2.4);
        }

        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    }

    /**
     * Calculates the luminosity ratio of two colours.
     * The luminosity ratio equations are from the WCAG 2 requirements:
     * http://www.w3.org/TR/WCAG20/#contrast-ratiodef
     *
     * @param Colour $color
     * @return float
     */

    function compareLuminosity(self $color): float
    {
        $l1 = $this->getLuminosity();
        $l2 = $color->getLuminosity();

        if ($l1 > $l2) {
            $ratio = (($l1 + 0.05) / ($l2 + 0.05));
        } else {
            $ratio = (($l2 + 0.05) / ($l1 + 0.05));
        }

        return $ratio;
    }

    /**
     * Tests the colour contrast based on the specified WCAG level.
     * The ratio levels are from the WCAG 2 requirements
     * http://www.w3.org/TR/WCAG20/#visual-audio-contrast (1.4.3)
     * http://www.w3.org/TR/WCAG20/#larger-scaledef
     *
     * @param string $level
     * @param bool $large
     * @param Colour $color
     * @param float|null $ratio
     * @return bool true if acceptable, false if not
     */

    function testWcag(string $level, bool $large, self $color, ?float &$ratio = null): bool
    {
        $ratio = $this->compareLuminosity($color);

        $minimum = match ($level) {
            'AA'  => $large ? 3.0 : 4.5,
            'AAA' => $large ? 7.0 : 4.5,
            default => throw new \Exception('Unknown WCAG level'),
        };

        return $ratio > ($minimum - PHP_FLOAT_EPSILON);
    }

    /**
     * A magic alias to getHex()
     */

    public function __toString(): string
    {
        return $this->getHex();
    }


    /*
     * Conversion methods between colour
     * representation formats HSV <> RGB.
     */

    private static function _rgb2hsv(float $r, float $g, float $b): array
    {
        // RGB, as opposed to HSV are never fractional
        // So we cast them here, in order to avoid any
        // worries regarding float equality comparison

        $r = (int) $r;
        $g = (int) $g;
        $b = (int) $b;

        $v = max($r, $g, $b);
        $t = min($r, $g, $b);
        $s = ($v == 0) ? 0 : ($v - $t) / $v;

        if ($s == 0) {

            $h = 0; // -1 ?

        } else {

            $a = $v - $t;

            $cr = ($v - $r) / $a;
            $cg = ($v - $g) / $a;
            $cb = ($v - $b) / $a;

            $h  = ($r == $v)
                ? $cb - $cg
                : (
                    ($g == $v)
                   ? 2 + $cr - $cb
                   : (
                        ($b == $v)
                       ? $h = 4 + $cg - $cr
                       : 0
                   )
                );

            $h = 60 * $h;
            $h = ($h < 0) ? $h + 360 : $h;

        }

        return [$h, $s, $v / 255];
    }

    private static function _hsv2rgb(float $h, float $s, float $v): array
    {
        $h /= 360;
        $h *= 6;

        $i = floor($h);
        $f = $h - $i;

        $m = $v * (1 - $s);
        $n = $v * (1 - $s * $f);
        $k = $v * (1 - $s * (1 - $f));

        switch ($i) {
            case 0:
                [$r,$g,$b] = [$v,$k,$m];
                break;
            case 1:
                [$r,$g,$b] = [$n,$v,$m];
                break;
            case 2:
                [$r,$g,$b] = [$m,$v,$k];
                break;
            case 3:
                [$r,$g,$b] = [$m,$n,$v];
                break;
            case 4:
                [$r,$g,$b] = [$k,$m,$v];
                break;
            case 5:
            case 6: //for when $H=1 is given
                [$r,$g,$b] = [$v,$m,$n];
                break;
            default:
                throw new \Exception('CSV to RGB conversion fail');
        }

        return [$r * 255, $g * 255, $b * 255];
    }

    /**
     *    This method checks whether a value is within
     *    specified bounds and crops it if neccessary.
     */

    private static function _bounds(float $value, float $lo, float $hi): float
    {
        if ($value > $hi) {
            return $hi;
        }

        if ($value < $lo) {
            return $lo;
        }

        return $value;
    }

}
