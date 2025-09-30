<?php

namespace Dock\A11yCheckerLaravel\Services\Contracts;

use Dock\A11yChecker\Enums\Device;
use Dock\A11yChecker\Enums\Language;
use Dock\A11yChecker\Enums\Sort;
use GuzzleHttp\Exception\GuzzleException;

interface A11yCheckerServiceContract
{
    /**
     * @param string $url
     * @param Language $lang
     * @param Device $device
     * @param bool $sync
     * @param bool $extraData
     * @return array
     * @throws GuzzleException
     */
    public function scan(string $url, Language $lang = Language::EN, Device $device = Device::DESKTOP, bool $sync = false, bool $extraData = false): array;

    /**
     * @param string $uuid
     * @param Language $lang
     * @param bool $extraData
     * @return array
     * @throws GuzzleException
     */
    public function audit(string $uuid, Language $lang = Language::EN, bool $extraData = false): array;

    /**
     * @param string $uuid
     * @param int $page
     * @param int $perPage
     * @param Sort $sort
     * @return array
     * @throws GuzzleException
     */
    public function history(string $uuid, int $page = 1, int $perPage = 10, Sort $sort = Sort::CREATED_AT_ASC): array;

    /**
     * @param string $key
     * @return $this
     */
    public function setApiKey(string $key): self;
}