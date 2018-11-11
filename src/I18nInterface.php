<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 11/11/2018
 */

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
