<?php
namespace BishBashBoshBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('BishBashBoshBundle:default:index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/species/", name="listSpecies")
     * @Route("/specie/", name="listSpeciesEmpty")
     */
    public function listSpeciesAction(Request $request)
    {
        return $this->render('BishBashBoshBundle::species.html.twig',
            [
                'species' => $this->getSpecies(),
            ]
        );
    }

    private function getSpecies()
    {
        $species = [];
        $dir = new \DirectoryIterator(realpath(dirname(__FILE__) . '/../Model/Animals/'));
        foreach ($dir as $fileinfo) {
            if (strpos($fileinfo->getFilename(), 'AbstractAnimal') !== false) {
                continue;
            }

            if ($fileinfo->isDot()) {
                continue;
            }

            $species[] = str_replace('.'.$fileinfo->getExtension(), '', $fileinfo->getFilename());
        }

        return $species;
    }

    private function isValidSpecie($specie)
    {
        $specie = $this->cleanSpecie($specie);
        return (!empty($specie['specie']) && file_exists($specie['path']) && is_readable($specie['path']));
    }

    private function cleanSpecie($specie)
    {
        $specie = preg_replace('/[^a-z]/', '', strtolower($specie));
        $classPath = realpath($this->container->getParameter('kernel.root_dir') . '/..') . '/src/BishBashBoshBundle/Model/Animals/' . ucfirst($specie) . '.php';
        return [
            'specie' => $specie,
            'path' => $classPath
        ];
    }

    /**
     * @Route("/specie/{specie}", name="viewSpecie")
     */
    public function viewSpecieAction(Request $request)
    {
        $specie = $this->cleanSpecie($request->get('specie'));

        if (!$this->isValidSpecie($specie['specie'])) {
            return new Response('Oops... That specie could\'nt be found');
        }

        $className = "\\BishBashBoshBundle\\Model\\Animals\\" . ucfirst($specie['specie']);
        $specie = new $className;

        return $this->render('BishBashBoshBundle::specie.html.twig',
            [
                'specie' => $specie,
                'species' => $this->getSpecies()
            ]
        );
    }

    /**
     * @Route("/specie/{specie}/attack/{specieToAttack}", name="attackSpecie")
     */
    public function specieAttackAction(Request $request)
    {
        $specie = $this->cleanSpecie($request->get('specie'));
        $specieToAttack = $this->cleanSpecie($request->get('specieToAttack'));

        if (!$this->isValidSpecie($specie['specie'])) {
            return new Response('Oops... That specie could\'nt be found');
        }

        if (!$this->isValidSpecie($specieToAttack['specie'])) {
            return new Response('Oops... That specieToAttack could\'nt be found');
        }

        $className = "\\BishBashBoshBundle\\Model\\Animals\\" . ucfirst($specie['specie']);
        $specie = new $className;

        $className = "\\BishBashBoshBundle\\Model\\Animals\\" . ucfirst($specieToAttack['specie']);
        $specieToAttack = new $className;

        //Actual HP reduction here
        $specieToAttack = $specie->attack($specieToAttack);

        return $this->render('BishBashBoshBundle::specie-attack.html.twig',
            [
                'specie' => $specie,
                'specieToAttack' => $specieToAttack,
                'species' => $this->getSpecies()
            ]
        );
    }
}
