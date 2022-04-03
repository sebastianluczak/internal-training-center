<?php

namespace App\Twig;

use Certificationy\Loaders\YamlLoader as Loader;
use Certificationy\Set;
use Symfony\Component\Yaml\Yaml;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class QuestionsExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_questions_count_for_topic', [$this, 'getQuestionsCountForTopic']),
        ];
    }

    public function getQuestionsCountForTopic($value)
    {

        return 12;
    }
}
