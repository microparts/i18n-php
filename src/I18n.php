<?php declare(strict_types=1);

namespace Microparts\I18n;


final class I18n implements I18nInterface
{
    /**
     * @var null|string
     */
    private $display;

    /**
     * @var bool
     */
    private $translateList;

    /**
     * @var null|string
     */
    private $fallback;

    /**
     * @var null|string
     */
    private $second;

    /**
     * I18n constructor.
     *
     * @param null|string $display
     * @param bool $translateList
     * @param null|string $fallback
     * @param null|string $second
     */
    public function __construct(?string $display, bool $translateList, ?string $fallback, ?string $second)
    {
        $this->display       = $display;
        $this->translateList = $translateList;
        $this->fallback      = $fallback;
        $this->second        = $second;
    }

    /**
     * @return null|string
     */
    public function getDisplayLang(): ?string
    {
        return $this->display;
    }

    /**
     * @return bool
     */
    public function isTranslateList(): bool
    {
        return $this->translateList;
    }

    /**
     * @return null|string
     */
    public function getFallbackLang(): ?string
    {
        return $this->fallback;
    }

    /**
     * @return null|string
     */
    public function getSecondLang(): ?string
    {
        return $this->second;
    }
}
