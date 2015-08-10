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
     */
    public function listSpeciesAction(Request $request)
    {
        return $this->render('BishBashBoshBundle::species.html.twig',
            [
                'species' => ['Cheese', 'Poo', 'Monkey'],
            ]
        );
    }

    /**
     * @Route("/specie/{specie}", name="viewSpecie")
     */
    public function viewSpecieAction(Request $request)
    {
        $specie = preg_replace('/[^a-z]/', '', strtolower($request->get('specie')));
        $classPath = realpath($this->container->getParameter('kernel.root_dir') . '/..') . '/src/BishBashBoshBundle/Model/Animals/' . ucfirst($specie) . '.php';
        $validSpecie = (file_exists($classPath) && is_readable($classPath));

        if (empty($specie) || $validSpecie === false) {
            return new Response('Oops... That specie could\'nt be found');
        }

        //require_once $classPath;
        $className = "\\BishBashBoshBundle\\Model\\Animals\\" . ucfirst($specie);
        $specie = new $className;

        return $this->render('BishBashBoshBundle::specie.html.twig',
            [
                'specie' => $specie,
            ]
        );
    }
}
