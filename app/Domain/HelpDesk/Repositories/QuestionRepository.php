<?php

namespace NpTS\Domain\HelpDesk\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\HelpDesk\Models\Question;
use NpTS\Domain\HelpDesk\Repositories\Contracts\QuestionRepositoryContract;

use NpTS\Domain\Client\Models\User;
use NpTS\Domain\HelpDesk\Events\UserCreatedAQuestion;


class QuestionRepository extends Repository implements QuestionRepositoryContract
{
    protected $model;

    public function __construct(Question $question)
    {
        $this->model = $question;
    }

    public function userCreateQuestion(User $user , array $options)
    {
        $question = $user->questions()->create($options);
        event(new UserCreatedAQuestion($question));
        return $question;
    }
}