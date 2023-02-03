<?php

namespace App\Tests\Entity;

use App\Entity\Recette;
use PHPUnit\Framework\TestCase;

class SerieTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
        $recette = new Recette();
        $recette->setNom('hello');
        $this->assertEquals($recette->getNom(),'hello');
    }
}
