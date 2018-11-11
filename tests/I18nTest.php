<?php

use Microparts\Configuration\Configuration;
use Microparts\I18n\Manager;

class I18nTest extends \PHPUnit\Framework\TestCase
{
    public function testI18nWithDefaultValues()
    {
        $conf = (new Configuration(__DIR__ . '/configuration', 'test'))->load();
        $manager = new Manager($conf);
        $i18n = $manager->load();

        $this->assertSame('ru', $i18n->getDisplayLang());
        $this->assertSame(false, $i18n->isTranslateList());
        $this->assertSame('en', $i18n->getFallbackLang());
        $this->assertSame('en', $i18n->getSecondLang());
    }

    public function testI18nWithOverrideValues()
    {
        $conf = (new Configuration(__DIR__ . '/configuration', 'test'))->load();
        $manager = new Manager($conf);

        $stub = new MessageStub();
        $stub->withHeader('X-Lang-Display', 'fr');
        $stub->withHeader('X-Lang-TranslateList', 'true');
        $stub->withHeader('X-Lang-Fallback', 'ru');
        $stub->withHeader('X-Lang-Second', 'jp');

        $i18n = $manager->withMessage($stub)->load();

        $this->assertSame('fr', $i18n->getDisplayLang());
        $this->assertSame(true, $i18n->isTranslateList());
        $this->assertSame('ru', $i18n->getFallbackLang());
        $this->assertSame('jp', $i18n->getSecondLang());

        // other way 1
        $i18n = $manager->withHeaders([
            'X-Lang-Display' => 'fr',
            'X-Lang-TranslateList' => 'true',
            'X-Lang-Fallback' => 'ru',
            'X-Lang-Second' => 'jp',
        ])->load();

        $this->assertSame('fr', $i18n->getDisplayLang());
        $this->assertSame(true, $i18n->isTranslateList());
        $this->assertSame('ru', $i18n->getFallbackLang());
        $this->assertSame('jp', $i18n->getSecondLang());

        // other way 2
        $i18n = $manager->withHeaders([
            'X-Lang-Display' => ['fr'],
            'X-Lang-TranslateList' => ['true'],
            'X-Lang-Fallback' => ['ru'],
            'X-Lang-Second' => ['jp'],
        ])->load();

        $this->assertSame('fr', $i18n->getDisplayLang());
        $this->assertSame(true, $i18n->isTranslateList());
        $this->assertSame('ru', $i18n->getFallbackLang());
        $this->assertSame('jp', $i18n->getSecondLang());
    }
}
