<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Entity\ResultSet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Unirest;


class MovieController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if (!$request->get('movie')) {
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            ]);
        }


        $search_name = $request->get('movie');
        $headers = ['Accept' => 'application/json'];
        $query = ['query' => $search_name, 'api_key' => $this->getParameter('api_key')];
        $response = Unirest\Request::get('https://api.themoviedb.org/3/search/movie', $headers, $query);

        if( $response->body->total_results == 0) {
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            ]);
        }
        $resultSet = new ResultSet();
        $resultSet->setName($_GET['movie']);
        $resultSet->setResult($response->raw_body);
        $em = $this->getDoctrine()->getManager();
        $em->persist($resultSet);

        $resultsArray = json_decode($response->raw_body, true)['results'];

        foreach ($resultsArray as $result) {
            $movie = new Movie();
            $movie->setTitle($result['title']);
            $movie->setOverview($result['overview']);
            $movie->setReleaseDate($result['release_date']);
            $movie->setOriginalName($result['original_title']);

            $resultSet->addMovie($movie);
            $movie->setResultSet($resultSet);

            $this->getDoctrine()->getManager()->persist($movie);
            $em->flush();
        }

        return $this->render('default/index.html.twig', [
            'data' => $response->body,
            'viewDomain' => $resultSet->getMovieResults(),
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     *
     * @Route("/history", name="history")
     */
    public function historyAction()
    {
        return $this->render('default/history.html.twig', [
            'resultSets' => $this->getDoctrine()->getManager()->getRepository('AppBundle:ResultSet')->findAll(),
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);

    }

    /**
     * @Route("/history/{id}", name="historyId", requirements={"id": "\d+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function historyIdAction($id)
    {
        $search = $this->getDoctrine()->getManager()->getRepository('AppBundle:ResultSet')->find($id);
        if ($search === null) {
            throw new NotFoundHttpException("Search not found with id {$id}.");
        }
        return $this->render('default/history.html.twig', [
            'resultSets' => [$search],
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }
}

