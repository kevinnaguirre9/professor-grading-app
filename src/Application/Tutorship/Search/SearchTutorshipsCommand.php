<?php

namespace ProfessorGradingApp\Application\Tutorship\Search;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class SearchTutorshipsCommand
 *
 * @package ProfessorGradingApp\Application\Tutorship\Search
 */
final class SearchTutorshipsCommand implements Command
{
    /**
     * @param array $filters
     * @param int $page
     * @param int|null $limit
     */
    public function __construct(
        private readonly array $filters,
        private readonly int $page = 1,
        private readonly ?int $limit = null,
    ) {
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->filters;
    }

    /**
     * @return int
     */
    public function page(): int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function limit(): ?int
    {
        return $this->limit;
    }
}
