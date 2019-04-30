<?php declare(strict_types=1);

namespace Microparts\I18n;

interface I18nInterface
{
    /**
     * @return null|string
     */
    public function getDisplayLang(): ?string;

    /**
     * @return bool
     */
    public function isTranslateList(): bool;

    /**
     * @return null|string
     */
    public function getFallbackLang(): ?string;

    /**
     * @return null|string
     */
    public function getSecondLang(): ?string;
}
