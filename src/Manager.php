<?php declare(strict_types=1);

/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 11/11/2018
 */

namespace Microparts\I18n;

use Microparts\Configuration\ConfigurationInterface;
use Psr\Http\Message\MessageInterface;

final class Manager
{
    private const HEADER_DISPLAY   = 'X-Lang-Display';
    private const HEADER_TRANSLATE = 'X-Lang-TranslateList';
    private const HEADER_FALLBACK  = 'X-Lang-Fallback';
    private const HEADER_SECOND    = 'X-Lang-Second';

    private const CONFIG_DISPLAY   = 'display';
    private const CONFIG_TRANSLATE = 'translate_list';
    private const CONFIG_FALLBACK  = 'fallback';
    private const CONFIG_SECOND    = 'second';

    /**
     * @var \Microparts\Configuration\ConfigurationInterface
     */
    private $conf;

    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @var array
     */
    private $headers;

    /**
     * Manager constructor.
     *
     * @param \Microparts\Configuration\ConfigurationInterface $conf
     */
    public function __construct(ConfigurationInterface $conf)
    {
        $this->conf = $conf;
    }

    /**
     * @param \Psr\Http\Message\MessageInterface $message
     * @return \Microparts\I18n\Manager
     */
    public function withMessage(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param array $headers
     * @return \Microparts\I18n\Manager
     */
    public function withHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Load the localization settings.
     *
     * @return \Microparts\I18n\I18nInterface
     */
    public function load(): I18nInterface
    {
        $map = [
            self::CONFIG_DISPLAY   => self::HEADER_DISPLAY,
            self::CONFIG_TRANSLATE => self::HEADER_TRANSLATE,
            self::CONFIG_FALLBACK  => self::HEADER_FALLBACK,
            self::CONFIG_SECOND    => self::HEADER_SECOND,
        ];

        $array = [];
        foreach ($map as $key => $header) {
            $array[$key] = $this->conf->get("lang.$key");
            if ($this->hasHeader($header)) {
                $array[$key] = $this->getHeader($header);
            }
        }

        $array[self::CONFIG_TRANSLATE] = (bool) ($array[self::CONFIG_TRANSLATE] === 'true');

        return new I18n(...array_values($array));
    }

    /**
     * @param string $header
     * @return bool
     */
    private function hasHeader(string $header): bool
    {
        if ($this->message instanceof MessageInterface) {
            return $this->message->hasHeader($header);
        }

        return isset($this->headers[$header]);
    }

    /**
     * @param string $header
     * @return string
     */
    private function getHeader(string $header): string
    {
        if ($this->message instanceof MessageInterface) {
            return current($this->message->getHeader($header));
        }

        $header = $this->headers[$header];

        return is_string($header) ? $header : current($header);
    }
}
