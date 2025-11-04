<?php

namespace Dock\A11yCheckerLaravel\Services;

use Dock\A11yChecker\Client;
use Dock\A11yChecker\Enums\AuditStatus;
use Dock\A11yChecker\Enums\Device;
use Dock\A11yChecker\Enums\Language;
use Dock\A11yChecker\Enums\Sort;
use Dock\A11yCheckerLaravel\Services\Contracts\A11yCheckerServiceContract;
use GuzzleHttp\Exception\GuzzleException;

class A11yCheckerService implements A11yCheckerServiceContract
{
    public function __construct(
        protected string $baseUrl,
        protected ?string $key = null,
    ) {}

    /**
     * @param string $url
     * @param Language $lang
     * @param Device $device
     * @param bool $sync
     * @param bool $extraData
     * @return array
     * @throws GuzzleException
     */
    public function scan(string $url, Language $lang = Language::EN, Device $device = Device::DESKTOP, bool $sync = false, bool $extraData = false): array
    {
        return $this->client()->scan($url, $lang, $device, $sync, $extraData);
    }

    /**
     * @param string $uuid
     * @param Language $lang
     * @param bool $sync
     * @param bool $extraData
     * @return array
     * @throws GuzzleException
     */
    public function rescan(string $uuid, Language $lang = Language::EN, bool $sync = false, bool $extraData = false): array
    {
        return $this->client()->rescan($uuid, $lang, $sync, $extraData);
    }

    /**
     * @param string $uuid
     * @param Language $lang
     * @param bool $extraData
     * @return array
     * @throws GuzzleException
     */
    public function audit(string $uuid, Language $lang = Language::EN, bool $extraData = false): array
    {
        return $this->client()->audit($uuid, $lang, $extraData);
    }

    /**
     * @param string $search
     * @param int $page
     * @param int $perPage
     * @param Sort $sort
     * @param string|null $uniqueKey
     * @return array
     * @throws GuzzleException
     */
    public function audits(string $search, int $page = 1, int $perPage = 10, Sort $sort = Sort::LAST_AUDIT_DESC, ?string $uniqueKey = null): array
    {
        return $this->client()->audits($search, $page, $perPage, $sort, $uniqueKey ?? '');
    }

    /**
     * @param string $uuid
     * @param int $page
     * @param int $perPage
     * @param Sort $sort
     * @return array
     * @throws GuzzleException
     */
    public function history(string $uuid, int $page = 1, int $perPage = 10, Sort $sort = Sort::CREATED_AT_ASC): array
    {
        return $this->client()->history($uuid, $page, $perPage, $sort);
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function user(): array
    {
        return $this->client()->user();
    }

    /**
     * @param string $uuid
     * @return array
     * @throws GuzzleException
     */
    public function deleteAudit(string $uuid): array
    {
        return $this->client()->deleteAudit($uuid);
    }

    /**
     * @param string $uuid
     * @return array
     * @throws GuzzleException
     */
    public function deleteHistory(string $uuid): array
    {
        return $this->client()->deleteHistory($uuid);
    }

    /**
     * @param string $uuid
     * @param string $criterionId
     * @param AuditStatus $status
     * @param Device $device
     * @return array
     * @throws GuzzleException
     */
    public function updateAuditManual(string $uuid, string $criterionId, AuditStatus $status, Device $device = Device::DESKTOP): array
    {
        return $this->client()->updateAuditManual($uuid, $criterionId, $status, $device);
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setApiKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    protected function client(): Client
    {
        return new Client($this->key, $this->baseUrl);
    }
}