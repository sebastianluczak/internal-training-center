<?php
declare(strict_types=1);
namespace App\Controller;

use Certificationy\Loaders\YamlLoader as Loader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $config = Yaml::parse(file_get_contents($this->path('config.yml')));
        $yamlLoader = new Loader($config);
        $categories = $yamlLoader->categories();

        $allquestions = $yamlLoader->load(PHP_INT_MAX, []);

        return $this->render('base.html.twig', [
            'categories' => $categories,
            'allquestions' => $allquestions
        ]);
    }

    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('conference/index.html.twig');
    }

    #[Route('/symfony', name: 'training_symfony')]
    public function symfonyQuestions(): Response
    {
        $config = Yaml::parse(file_get_contents($this->path('config.yml')));
        $yamlLoader = new Loader($config);
        $categories = $yamlLoader->categories();

        $questions = $yamlLoader->load(50, []);

        return $this->render('questions/index.html.twig', [
            'categories' => $categories,
            'questions' => $questions
        ]);
    }


    /**
     * Returns configuration file path
     *
     * @return string $path      The configuration filepath
     */
    protected function path(?string $config = null): string
    {
        $defaultConfig = dirname(__DIR__)
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . 'config.yml'
        ;

        return  $defaultConfig;
    }
}