<?php

namespace Distill\Tests\Method\Command;

use Distill\Method;
use Distill\Format;
use Distill\Tests\Method\AbstractMethodTest;

class x7zipTest extends AbstractMethodTest
{

    public function setUp()
    {
        $this->method = new Method\Command\x7zip();

        if (false === $this->method->isSupported()) {
            $this->markTestSkipped('The 7zip command is not installed');
        }

        parent::setUp();
    }

    public function testExtractCorrect7zFile()
    {
        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $response = $this->extract('file_ok.7z', $target, new Format\Simple\x7z());

        $this->assertTrue($response);
        $this->assertUncompressed($target, 'file_ok.7z');
        $this->clearTemporaryPath();
    }

    public function testExtractFake7zFile()
    {
        $this->setExpectedException('Distill\\Exception\\IO\\Input\\FileCorruptedException');

        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $this->extract('file_fake.7z', $target, new Format\Simple\x7z());

        $this->clearTemporaryPath();
    }

    public function testExtractNo7zFile()
    {
        $this->setExpectedException('Distill\\Exception\\Method\\FormatNotSupportedInMethodException');

        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $response = $this->extract('file_ok.phar', $target, new Format\Simple\Phar());

        $this->assertFalse($response);
        $this->clearTemporaryPath();
    }

    public function testExtractCorruptZipFile()
    {
        $this->setExpectedException('Distill\\Exception\\IO\\Input\\FileCorruptedException');

        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $this->extract('file_corrupt.zip', $target, new Format\Simple\Zip());
    }

    public function testExtractCorrectJarFile()
    {
        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $response = $this->extract('file_ok.jar', $target, new Format\Simple\Jar());

        $this->assertTrue($response);
        $this->assertUncompressed($target, 'file_ok.jar');
        $this->clearTemporaryPath();
    }

    public function testExtractCorrectRarFile()
    {
        if (!$this->method->isFormatSupported(new Format\Simple\Rar())) {
            $this->markTestSkipped('rar supported is not enabled for the x7 command method.');
        }

        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $response = $this->extract('file_ok.rar', $target, new Format\Simple\Rar());

        $this->assertTrue($response);
        $this->assertUncompressed($target, 'file_ok.rar');
        $this->clearTemporaryPath();
    }

    public function testExtractCorrectDmgFile()
    {
        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $response = $this->extract('file_ok.dmg', $target, new Format\Simple\Dmg());

        $this->assertTrue($response);
        //$this->assertUncompressed($target, 'file_ok.dmg');
        $this->clearTemporaryPath();
    }

    public function testExtractCorrectIsoFile()
    {
        $target = $this->getTemporaryPath();
        $this->clearTemporaryPath();

        $response = $this->extract('file_ok.iso', $target, new Format\Simple\Iso());

        $this->assertTrue($response);
        //$this->assertUncompressed($target, 'file_ok.dmg');
        $this->clearTemporaryPath();
    }
}
