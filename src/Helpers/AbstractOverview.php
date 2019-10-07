<?php

namespace garagewiets\src\Helpers;

/**
 * Class Overview
 *
 * @package garagewiets\src\Helpers
 */
abstract class AbstractOverview extends AbstractController
{
    /**
     * @return mixed
     */
    abstract public function module(): String;

    /**
     * @return DatabaseTable[]
     */
    abstract public function tables(): array;

    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        $this->process();

        return new PageResponse(
            'overview.twig',
            [
                'tables' => $this->getData(),
                'module' => $this->module()
            ]
        );
    }

    /**
     * @return array
     */
    protected function getData(): array
    {
        $data = [];

        foreach ($this->tables() as $table) {
            $data[] = [
                'headers' => $table->getHeaders(),
                'rows' => $table->getContent(),
                'name' => $table->getName(),
            ];
        }
        return $data;
    }

    protected function process(): void
    {
        Authenticator::setModifiableTables($this->tables());
    }
}
