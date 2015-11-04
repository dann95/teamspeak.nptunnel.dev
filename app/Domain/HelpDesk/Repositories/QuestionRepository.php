<?php

namespace NpTS\Domain\HelpDesk\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\HelpDesk\Models\Question;
use NpTS\Domain\HelpDesk\Repositories\Contracts\QuestionRepositoryContract;


class QuestionRepository extends Repository implements QuestionRepositoryContract
{
    protected $model;
    public function __construct(Question $question)
    {
        $this->model = $question;
    }
}