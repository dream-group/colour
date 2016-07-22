# Colour
Tiny class to represent a colour entity and perform basic transformations.

[![Build Status](https://travis-ci.org/dream-group/colour.svg?branch=master)](https://travis-ci.org/dream-group/colour)

## Usage

The class is meant to represent the abstract 'colour' entity. So that it is a good fit to return this object from some accessor like `getColour()` etc. With this in mind, the object, when cast to a string, will yield a hex string value:

```php
(string) new Colour(255, 255, 255, Colour::RGB); // '#FFFFFF'
```

It is possible to construct the object either directly from the constructor, specifying RGB or HSV values:

```php
use Dream\Colour;
$colour = new Colour(255, 255, 255, Colour::RGB);
$colour = new Colour(129, 0.5, 1.0, Colour::HSV);
```

Note the the HSV values for S and V are represented by a fraction from 0 ... 1.0.

A more sensible way to instantiate the object is to factory from the hex value:

```php
use Dream\Colour;
$colour = Colour::factoryHex('#aA1144');
```

The following accessors are available: R, G, B and H, S, V as show below:
```php
$colour = Colour::factoryHex('#0000FF');
$colour->R = 123;
$colour->G = 255;
echo $colour->R; // 123
echo $colour->G; // 255
echo $colour->B; // 255 (not modified from origianl hex value)
```

Note that you can get and set RGV and HSV values even in a mixed fashion. So that you may set R to some value, adjust S and then read the B value. Conversions between the RGB and HSV colour systems are handled internally. Any values that exceed the bounds (e.g 256 for R will be set as the highest possible value 255).

As an additonal benefit, it is also possible to calcualte the brightness score for a colour. This can especially aid situations where WCAG 2.0 is relevant.
