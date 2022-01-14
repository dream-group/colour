<?php

namespace Dream\Colour\Tests;

use Dream\Colour;
use PHPUnit\Framework\TestCase;

class ColourTest extends TestCase
{
    public function testWebValidation(): void
    {
        $this->assertEquals(Colour::isWeb('turquoise'), true);
        $this->assertEquals(Colour::isWeb('foobar'), false);
    }

    public function testHexValidation(): void
    {
        $this->assertEquals(Colour::isHex('#fafafa'), true);
        $this->assertEquals(Colour::isHex('#FAFAFA'), true);
        $this->assertEquals(Colour::isHex('#faFAfa'), true);
        $this->assertEquals(Colour::isHex('#fafafX'), false);
    }

    public function testHexFactory(): void
    {
        $colour = Colour::factoryHex('#aA1144');
        $this->assertEquals($colour->R, 170);
        $this->assertEquals($colour->G, 17);
        $this->assertEquals($colour->B, 68);
        $this->assertEquals($colour->getHex(), '#AA1144');
        $this->assertEquals((string)$colour, '#AA1144');
    }

    public function testRGB(): void
    {
        $colour = Colour::factoryHex('#aA1144');
        $colour->R = 30;
        $colour->G = 40;
        $colour->B = 50;
        $this->assertEquals($colour->R, 30);
        $this->assertEquals($colour->G, 40);
        $this->assertEquals($colour->B, 50);
        $this->assertEquals((string)$colour, '#1E2832');
    }

    public function testHSV(): void
    {
        $colour = Colour::factoryHex('#000000');
        $colour->H = 123;
        $colour->S = 0.5;
        $colour->V = 0.7;
        $this->assertEquals($colour->H, 123);
        $this->assertEquals($colour->S, 0.5);
        $this->assertEquals($colour->V, 0.7);
        $this->assertEquals(floor($colour->R), 89);
        $this->assertEquals(floor($colour->G), 178);
        $this->assertEquals(floor($colour->B), 93);
        $colour->H = 0;
        $colour->S = 0.2;
        $colour->V = 1;
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 0.2);
        $this->assertEquals($colour->V, 1);
        $this->assertEquals(floor($colour->R), 255);
        $this->assertEquals(floor($colour->G), 204);
        $this->assertEquals(floor($colour->B), 204);
        $colour->H = 0;
        $colour->S = 0.002;
        $colour->V = 1;
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 0.002);
        $this->assertEquals($colour->V, 1);
        $this->assertEquals(floor($colour->R), 255);
        $this->assertEquals(floor($colour->G), 255);
        $this->assertEquals(floor($colour->B), 255);
    }

    public function testTable()
    {
        $colour = Colour::factoryHex('#000000');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 0);
        $this->assertEquals($colour->V, 0);

        $colour = Colour::factoryHex('#FFFFFF');
        $this->assertEquals($colour->R, 255);
        $this->assertEquals($colour->G, 255);
        $this->assertEquals($colour->B, 255);
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 0);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#FF0000');
        $this->assertEquals($colour->R, 255);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#00FF00');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 255);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals($colour->H, 120);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#0000FF');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 255);
        $this->assertEquals($colour->H, 240);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#FFFF00');
        $this->assertEquals($colour->R, 255);
        $this->assertEquals($colour->G, 255);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals($colour->H, 60);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#00FFFF');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 255);
        $this->assertEquals($colour->B, 255);
        $this->assertEquals($colour->H, 180);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#FF00FF');
        $this->assertEquals($colour->R, 255);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 255);
        $this->assertEquals($colour->H, 300);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals($colour->V, 1);

        $colour = Colour::factoryHex('#C0C0C0');
        $this->assertEquals($colour->R, 192);
        $this->assertEquals($colour->G, 192);
        $this->assertEquals($colour->B, 192);
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 0);
        $this->assertEquals(round($colour->V, 2), 0.75);

        $colour = Colour::factoryHex('#808080');
        $this->assertEquals($colour->R, 128);
        $this->assertEquals($colour->G, 128);
        $this->assertEquals($colour->B, 128);
        $this->assertEquals($colour->H, 0);
        $this->assertEquals($colour->S, 0);
        $this->assertEquals(round($colour->V, 2), 0.50);

        $colour = Colour::factoryHex('#808000');
        $this->assertEquals($colour->R, 128);
        $this->assertEquals($colour->G, 128);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals($colour->H, 60);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals(round($colour->V, 2), 0.50);

        $colour = Colour::factoryHex('#008000');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 128);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals($colour->H, 120);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals(round($colour->V, 2), 0.50);

        $colour = Colour::factoryHex('#800080');
        $this->assertEquals($colour->R, 128);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 128);
        $this->assertEquals($colour->H, 300);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals(round($colour->V, 2), 0.50);

        $colour = Colour::factoryHex('#008080');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 128);
        $this->assertEquals($colour->B, 128);
        $this->assertEquals($colour->H, 180);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals(round($colour->V, 2), 0.50);

        $colour = Colour::factoryHex('#000080');
        $this->assertEquals($colour->R, 0);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 128);
        $this->assertEquals($colour->H, 240);
        $this->assertEquals($colour->S, 1);
        $this->assertEquals(round($colour->V, 2), 0.50);
    }

    public function testRGBBounds(): void
    {
        $colour = Colour::factoryHex('#aA1144');
        $colour->R = 1001;
        $colour->G = -123;
        $colour->B = 0;
        $this->assertEquals($colour->R, 255);
        $this->assertEquals($colour->G, 0);
        $this->assertEquals($colour->B, 0);
        $this->assertEquals((string)$colour, '#FF0000');
    }

    public function testHSVBounds(): void
    {
        $colour = Colour::factoryHex('#000000');

        $colour->H = -1;
        $this->assertEquals($colour->H, 0);
        $colour->H = 0;
        $this->assertEquals($colour->H, 0);
        $colour->H = 180;
        $this->assertEquals($colour->H, 180);
        $colour->H = 360;
        $this->assertEquals($colour->H, 360);
        $colour->H = 361;
        $this->assertEquals($colour->H, 360);

        $colour->S = -1;
        $this->assertEquals($colour->S, 0);
        $colour->S = 0;
        $this->assertEquals($colour->S, 0);
        $colour->S = 0.5;
        $this->assertEquals($colour->S, 0.5);
        $colour->S = 1;
        $this->assertEquals($colour->S, 1);
        $colour->S = 1.01;
        $this->assertEquals($colour->S, 1);

        $colour->V = -1;
        $this->assertEquals($colour->V, 0);
        $colour->V = 0;
        $this->assertEquals($colour->V, 0);
        $colour->V = 0.5;
        $this->assertEquals($colour->V, 0.5);
        $colour->V = 1;
        $this->assertEquals($colour->V, 1);
        $colour->V = 1.01;
        $this->assertEquals($colour->V, 1);
    }

    public function testBrightness(): void
    {
        $colour = Colour::factoryHex('#aabbcc');
        $this->assertEquals($colour->getBrightness(), 184);
        $colour = Colour::factoryHex('#000000');
        $this->assertEquals($colour->getBrightness(), 0);
        $colour = Colour::factoryHex('#ffffff');
        $this->assertEquals($colour->getBrightness(), 255);
    }
}
